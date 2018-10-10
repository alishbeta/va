<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 09.04.2017
 * Time: 20:59
 */

namespace common\models\FileHostings;

use common\libraries\Balancer;
use common\libraries\VaErrorException;
use common\models\Filehostings;
use common\models\Links;
use common\models\PremiumKeys;
use common\models\Regulars;
use common\models\Servers;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\httpclient\Client;
use yii\httpclient\Exception;


class Turbobit
{
    public $baseUrl = 'https://turbobit.net/';
    public $regulars;
    public $login;
    public $premiumObj;
    public $hostObj;

    public function __construct($id, $hostObj)
    {
        $data = Regulars::find(["filehosting" => $id])->asArray()->select(['value', 'type'])->all();
        $this->regulars = ArrayHelper::map($data, 'type', 'value');
        $this->hostObj = $hostObj;
        $premiumId = Balancer::init($this->hostObj->id);
        $this->premiumObj = PremiumKeys::findOne($premiumId);
    }

    public static function urls($url)
    {
        $url = explode('/', $url)[3];
        if (!strpos($url, '.html'))
            $url .= '.html';
        return $url;
    }

    public function isLogin()
    {
        if (!empty($this->premiumObj->cookies)) {
            $page = $this->getPage($this->baseUrl, [
                ['name' => 'user_lang', 'value' => 'en'],
                ['name' => 'kohanasession', 'value' => $this->premiumObj->cookies]
            ]);
            if (strpos($page, 'icon-user'))
                return true;
            if (!$this->getAutologin())//todo Блокировка примака
                return false;
            return true;
        } else {
            if (!$this->getAutologin())//todo Блокировка примака
                return false;
            return true;
        }
    }


    public function getPage($url, $cookies = [])
    {
        //$data = $this->initRequest($url);

        $data = \Yii::$app->cache->getOrSet($url, function () use ($url, $cookies) {
            try {
                $client = new Client(['baseUrl' => $this->baseUrl]);
                $resp = $client->createRequest()
                    ->setCookies($cookies)
                    ->setUrl($url)
                    ->setOptions([
                        'proxy' => 'tcp://' . $this->premiumObj->server->ip . ':3129', //todo брать прокси с базы
                        'timeout' => 5,
                    ])
                    ->send();
                return $resp->content;
            } catch (Exception $e) {
                throw new VaErrorException(\Yii::t('app', 'Не удается установить соединение с сервером.'), $e);
            }

        }, 60);
        return $data;
    }

    public function getAutologin()
    {
        try {
            $client = new Client(['baseUrl' => $this->baseUrl]);
            $respo = $client->createRequest()
                ->setMethod('POST')
                ->setUrl('user/login')
                ->setData(['user[login]' => $this->premiumObj->login, 'user[pass]' => $this->premiumObj->pass])
                ->setOptions([
                    'proxy' => 'tcp://159.69.14.96:3129',//todo брать прокси с базы
                    'timeout' => 5,
                    'maxRedirects' => 0,
                ])
                ->send();
            $this->premiumObj->cookies = $respo->getCookies()->getValue('kohanasession');
            $this->premiumObj->save();

            if ($respo->getCookies()->getValue('user_isloggedin') != 1)
                return false;
            return true;
        } catch (Exception $e) {
            throw new VaErrorException(\Yii::t('app', 'Не удается установить соединение с сервером.'), $e);
        }
    }

    public function isPremium()
    {
        try {
            $data = \Yii::$app->cache->getOrSet($this->baseUrl, function () {
                $client = new Client(['baseUrl' => $this->baseUrl]);
                $resp = $client->createRequest()
                    ->setMethod('POST')
                    ->setData(['user[login]' => $this->premiumObj->login, 'user[pass]' => $this->premiumObj->pass])
                    ->setOptions([
                        'proxy' => 'tcp://159.69.14.96:3129',//todo брать прокси с базы
                        'timeout' => 5,
                    ])
                    ->send();
                return $resp->content;
            }, 60);
            if (strpos($data, 'banturbo'))//todo Блокировка примака
                return false;
            return true;
        } catch (Exception $e) {
            throw new VaErrorException(\Yii::t('app', 'Не удается установить соединение с сервером.'), $e);
        }
    }

    public function getFileInfo($url, $coef)
    {
        $page = $this->getPage($url, [
            ['name' => 'user_lang', 'value' => 'en'],
            ['name' => 'kohanasession', 'value' => $this->premiumObj->cookies]
        ]);

        preg_match('#' . $this->regulars['file_size'] . '#', $page, $out);
        preg_match('#' . $this->regulars['file_name'] . '#', $page, $out2);

        if (!empty($out2)) {
            $numb = preg_replace('#,#', '.', $out[2]);
            $byte_size = Filehostings::toByte($numb, $out[3]);
            $size = Filehostings::toGb($numb, $out[3]);

            $return = [
                'byte_size' => $byte_size,
                'size' => $size,
                'coef_size' => $size * $coef,
                'name' => $out2[1],
            ];
        } else {
            $return = 'deleted';
        }
        return $return;
    }

    public function getFileLinks($url, $file_size, $file_name)
    {
        $page = $this->getPage($url, [
            ['name' => 'user_lang', 'value' => 'en'],
            ['name' => 'kohanasession', 'value' => $this->premiumObj->cookies]
        ]);
        $file_block = substr($page, strpos($page, 'class=\'premium-link-block\''),
            2000);
        if (strpos($file_block, 'premium-link-block') === false)
            return 'deleted';
        preg_match_all('#href=\'(http://(new.)*turbobit.net//download/redirect/\S*)\'>#', $file_block,
            $out3);
        $data = [
            'user_id' => \Yii::$app->user->identity->getId(),
            'server_id' => $this->premiumObj->server_id,
            'filehosting_id' => $this->premiumObj->fh_id,
            'size' => $file_size,
            'f_name' => $file_name,
            'url' => $url,
        ];
        foreach ($out3[1] as $link) {
            if ($data['direct_link'] = $this->getHeders($link)) {
                $data['uid'] = Filehostings::uniq_id();
                $data['m_uid'] = Filehostings::uniq_id();
                (new Links())->addLink($data);
                $server = Servers::findOne($this->premiumObj->server_id);
                $links[] = 'http://' . $server->ip . '/' . $data['uid'] . '/' . $data['m_uid'] . '/' . $file_name;
            }
        }
        if (!empty($links))//todo Выдать ошибку при отсутсвие ссылок.
            User::reduceBalance($file_size, $this->hostObj->coef, $this->discounts());
        return $links;
    }

    public function getHeders($url)
    {
        $url = preg_replace('#http#', 'https', $url);
        $client = new Client(['baseUrl' => $url]);
        $resp = $client->createRequest()
            ->setOptions([
                'proxy' => 'tcp://159.69.14.96:3129',//todo брать прокси с базы
                'timeout' => 5,
                'followLocation' => 0,
            ])
            ->send();
        if (!$resp->getHeaders()->get('Location'))
            return false;
        return $resp->getHeaders()->get('Location');
    }

    public function getDiscounts($coef_size)
    {
        $data =  ($this->hostObj->discount != 0) ? $coef_size - ($coef_size * $this->hostObj->discount / 100) : 0;
        return $data;
    }
}




























