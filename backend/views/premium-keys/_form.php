<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PremiumKeys */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="premium-keys-form">

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'fh_id')->dropDownList($fh) ?>

    <?= $form->field($model, 'server_id')->dropDownList($s_id) ?>

    <?= $form->field($model, 'cookies')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pass')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
