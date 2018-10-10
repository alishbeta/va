<?php

namespace common\models;

use common\libraries\Balancer;
use Yii;

/**
 * This is the model class for table "filehostings".
 *
 * @property integer $id
 * @property string $name
 * @property integer $server_id
 * @property integer $coef
 * @property string $logo
 * @property integer $discount
 *
 * @property Servers $server
 */
class Filehostings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'filehostings';
    }

    /**
     * @inheritdoc
     * @return FilehostingsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FilehostingsQuery(get_called_class());
    }

    public static function toByte($numb, $units)
    {
        switch ($units) {
            case 'Mb':
                $numb = $numb * 1024;
                break;
            case 'MB':
                $numb = $numb * 1024;
                break;
            case 'Gb':
                $numb = $numb * 1024 * 1024;
                break;
            case 'GB':
                $numb = $numb * 1024 * 1024;
                break;
        }
        return round($numb, 0);
    }

    public static function toGb($numb, $units)
    {
        switch ($units) {
            case 'Mb':
                $numb = $numb / 1024;
                break;
            case 'MB':
                $numb = $numb * 1024;
                break;
            case 'kb':
                $numb = $numb / 1024 / 1024;
                break;
            case 'KB':
                $numb = $numb / 1024 / 1024;
                break;
        }
        return round($numb, 3);
    }

    public static function uniq_id()
    {
        $chars = "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
        $max = 5;
        $size = StrLen($chars) - 1;
        $uniq_id = null;
        while ($max--) {
            $uniq_id .= $chars[rand(0, $size)];
        }
        return $uniq_id;
    }

    public static function checkSupport($urls = [])
    {
        foreach ($urls as $k => $v) {
            $host = parse_url(urldecode($v), PHP_URL_HOST);
            $hostObj = static::findOne(['name' => $host]);
            if ($hostObj->name != null) {
                $supportHosts[$host]['support'] = 'true';
                $supportHosts[$host]['coef'] = $hostObj->coef;
                $supportHosts[$host]['id'] = $hostObj->id;
                $supportHosts[$host]['discount'] = $hostObj->discount;
                $model = "\common\models\FileHostings\\" . mb_convert_case(explode('.', $hostObj->name)[0], MB_CASE_TITLE, "UTF-8");
                $supportHosts[$host]['model'] = new $model($hostObj->id, $hostObj);//todo не создавать каждуюю итерацию обект.
                $supportHosts[$host]['urls'][$k]['url'] = $supportHosts[$host]['model']->urls($v);
            } else {
                $supportHosts[$host]['support'] = 'false';
            }
        }
        return $supportHosts;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'server_id'], 'required'],
            [['server_id', 'discount'], 'integer'],
            [['coef'], 'number'],
            [['name', 'logo'], 'string', 'max' => 255],
            [['server_id'], 'exist', 'skipOnError' => true, 'targetClass' => Servers::className(), 'targetAttribute' => ['server_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'server_id' => Yii::t('app', 'Server ID'),
            'coef' => Yii::t('app', 'Coefficient'),
            'logo' => Yii::t('app', 'Logo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServer()
    {
        return $this->hasOne(Servers::class, ['id' => 'server_id']);
    }

}
