<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property integer $group_id
 * @property string $username
 * @property string $auth_key
 * @property string $token
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property float $discounts
 * @property double $balance
 * @property double $ref_balance
 * @property string $avatar
 * @property string $password write-only password
 */
class User extends \yii\db\ActiveRecord
{
    public $password;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'required'],
            ['password', 'string', 'min' => 6],
            [['group_id', 'status', 'created_at', 'updated_at', 'ref_balance'], 'integer'],
            [['discounts', 'balance'], 'number'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'avatar'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['token'], 'string', 'max' => 50],
            [['username'], 'unique'],
            ['email', 'unique'],
            ['email', 'trim'],
            ['email', 'email'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'group_id' => 'Группа',
            'username' => 'Имя: ',
            'auth_key' => 'Auth Key',
            'token' => Yii::t('app', 'Token'),
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Почта: ',
            'status' => 'Status',
            'created_at' => 'Зарегистрирован: ',
            'updated_at' => Yii::t('app', 'Updated At'),
            'discounts' => 'Скидка',
            'balance' => 'Баланс, Gb',
            'ref_balance' => 'Реф. баланс, $',
            'avatar' => 'Avatar',
        ];
    }

    /**
     * @inheritdoc
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $this->username = $this->username;
        $this->email = $this->email;
        $this->setPassword($this->password);
        $this->generateAuthKey();

        return $this->save() ? $this : null;
    }
}
