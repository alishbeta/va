<?php

namespace common\models;

use common\libraries\VaErrorException;
use Yii;

/**
 * This is the model class for table "links".
 *
 * @property int $id
 * @property int $user_id
 * @property int $server_id
 * @property int $filehosting_id
 * @property string $url
 * @property string $direct_link
 * @property string $uid
 * @property string $m_uid
 * @property string $f_name
 * @property int $size
 * @property int $active
 *
 * @property Servers $server
 * @property User $user
 * @property Filehostings $filehosting
 */
class Links extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'links';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'server_id', 'filehosting_id'], 'required'],
            [['user_id', 'server_id', 'filehosting_id', 'size', 'active'], 'integer'],
            [['url', 'f_name', 'direct_link'], 'string'],
            [['uid', 'm_uid'], 'string', 'max' => 5],
            [['server_id'], 'exist', 'skipOnError' => true, 'targetClass' => Servers::class, 'targetAttribute' => ['server_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['filehosting_id'], 'exist', 'skipOnError' => true, 'targetClass' => Filehostings::class, 'targetAttribute' => ['filehosting_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'server_id' => Yii::t('app', 'Server ID'),
            'filehosting_id' => Yii::t('app', 'Filehosting ID'),
            'url' => Yii::t('app', 'Link'),
            'direct_link' => Yii::t('app', 'Direct Link'),
            'uid' => Yii::t('app', 'Uid'),
            'm_uid' => Yii::t('app', 'M Uid'),
            'f_name' => Yii::t('app', 'F Name'),
            'size' => Yii::t('app', 'Size'),
            'active' => Yii::t('app', 'Active'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServer()
    {
        return $this->hasOne(Servers::class, ['id' => 'server_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilehosting()
    {
        return $this->hasOne(Filehostings::class, ['id' => 'filehosting_id']);
    }

    public function addLink($data){
        $this->attributes = $data;
        $this->save();
    }

    /**
     * {@inheritdoc}
     * @return LinksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LinksQuery(get_called_class());
    }
}
