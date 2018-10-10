<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \common\models\Regulars;

/* @var $this yii\web\View */
/* @var $model common\models\Regulars */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="regulars-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?
    $data = (new Regulars())->getFileHostings();
    $items = \yii\helpers\ArrayHelper::map($data, 'id', 'name');
    echo $form->field($model, 'filehosting')->dropDownList($items) ?>

    <?= $form->field($model, 'value')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
