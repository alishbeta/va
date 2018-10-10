<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PremiumKeysSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="premium-keys-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fh_id') ?>

    <?= $form->field($model, 'server_id') ?>

    <?= $form->field($model, 'cookies') ?>

    <?= $form->field($model, 'login') ?>

    <?php // echo $form->field($model, 'pass') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
