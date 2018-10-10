<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "regulars".
 *
 * @property integer $id
 * @property string $type
 * @property integer $filehosting
 * @property string $value
 */
class Regulars extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'regulars';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'filehosting', 'value'], 'required'],
            [['filehosting'], 'integer'],
            [['value'], 'string'],
            [['type'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'filehosting' => Yii::t('app', 'Filehosting'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    public function getFileHostings()
    {
        return Filehostings::find()->asArray()->all();
    }

    /**
     * @inheritdoc
     * @return RegularsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RegularsQuery(get_called_class());
    }
}
