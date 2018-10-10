<?php

namespace app\modules\core\controllers;


use common\models\Filehostings;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;


class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => [ 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['post'],
                ],
            ],
        ];
    }


    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {

        if (\Yii::$app->user->identity->balance <= -5)
            return $this->renderPartial('error_str', ['exception' => \Yii::t('app', 'Не достаточно трафика для генерации ссылок.')]);

        $urls = explode(chr(10), \Yii::$app->request->post()['urls']);

        $supportHostings = Filehostings::checkSupport($urls);

        foreach ($supportHostings as &$v) {
            if ($v['support'] == 'true') {
                if ($v['model']->isLogin() && $v['model']->isPremium()) {
                    foreach ($v['urls'] as &$vv) {
                        $vv['info'] = $v['model']->getFileInfo($vv['url'], $v['coef']);
                        if ($vv['info'] != 'deleted' && \Yii::$app->request->post()['do'] != 'info')
                            $vv['direct_links'] = $v['model']->getFileLinks($vv['url'], $vv['info']['byte_size'], $vv['info']['name']);
                        $supportHostings['total_size'] += $vv['info']['size'];
                        $supportHostings['total_coef_size'] += $vv['info']['coef_size'];
                        $supportHostings['total_discount'] += $v['model']->getDiscounts($vv['info']['coef_size']);
                    }
                    ArrayHelper::remove($v, 'model');
                }else{
                    $v['support'] = 'false';
                    ArrayHelper::remove($v, 'model');
                    $v['error'] = \Yii::t('app', 'Не удается сгененрировать ссылку с данного ФО.');
                }
            }
        }

        //print_r($supportHostings);

        if (\Yii::$app->user->identity->balance < $supportHostings['total_size'])
            return ['error' => true, 'exception' => \Yii::t('app', 'Не достаточно трафика для генерации ссылок.')];


        return  $supportHostings;

    }

    public function actionError()
    {
        $exception = \Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->renderPartial('error', ['exception' => $exception]);
        }
    }

}
