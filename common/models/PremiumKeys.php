<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "premium_keys".
 *
 * @property int $id
 * @property int $fh_id
 * @property int $server_id
 * @property string $cookies
 * @property string $login
 * @property string $pass
 * @property string $traffic
 * @property string $locked
 *
 * @property Filehostings $fh
 * @property Servers $server
 */
class PremiumKeys extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'premium_keys';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fh_id', 'server_id'], 'required'],
            [['fh_id', 'server_id', 'traffic', 'locked'], 'integer'],
            [['cookies'], 'string'],
            [['login', 'pass'], 'string', 'max' => 255],
            [['fh_id'], 'exist', 'skipOnError' => true, 'targetClass' => Filehostings::className(), 'targetAttribute' => ['fh_id' => 'id']],
            [['server_id'], 'exist', 'skipOnError' => true, 'targetClass' => Servers::className(), 'targetAttribute' => ['server_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fh_id' => Yii::t('app', 'Fh ID'),
            'server_id' => Yii::t('app', 'Server ID'),
            'cookies' => Yii::t('app', 'Cookies'),
            'login' => Yii::t('app', 'Login'),
            'pass' => Yii::t('app', 'Pass'),
            'traffic' => Yii::t('app', 'Traffic'),
            'locked' => Yii::t('app', 'Locked'),
        ];
    }

    public function getAllFh(){
        return Filehostings::find()->asArray()->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFh()
    {
        return $this->hasOne(Filehostings::class, ['id' => 'fh_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServer()
    {
        return $this->hasOne(Servers::class, ['id' => 'server_id']);
    }
}
