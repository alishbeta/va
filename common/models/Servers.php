<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "servers".
 *
 * @property integer $id
 * @property string $ip
 * @property string $name
 * @property string $hoster
 *
 * @property Filehostings[] $filehostings
 */
class Servers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ip', 'name', 'hoster'], 'required'],
            [['ip', 'name', 'hoster'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ip' => Yii::t('app', 'Ip'),
            'name' => Yii::t('app', 'Name'),
            'hoster' => Yii::t('app', 'Hoster'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilehostings()
    {
        return $this->hasMany(Filehostings::className(), ['server_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ServersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ServersQuery(get_called_class());
    }
}
