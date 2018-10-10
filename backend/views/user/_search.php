<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
                'class' => 'form-inline',
            ],
    ]); ?>

    <?// $form->field($model, 'id') ?>

    <?// $form->field($model, 'groups') ?>

    <?= $form->field($model, 'username') ?>

    <?// $form->field($model, 'auth_key') ?>

    <?// $form->field($model, 'token') ?>

    <?php // echo $form->field($model, 'password_hash') ?>

    <?php // echo $form->field($model, 'password_reset_token') ?>

    <?php  echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?
    $model->datetime_min = '2015-02-11';
    $model->datetime_max = date('Y-m-d');
    ?>
    <?php  echo $form->field($model, 'created_at')->widget(\kartik\daterange\DateRangePicker::className(), [
        'attribute'=>'datetime_range',
        'convertFormat'=>true,
        'startAttribute'=>'datetime_min',
        'endAttribute'=>'datetime_max',
        'pluginOptions'=>[
            'timePicker'=>false,
            'showDropdowns'=>true,
            'locale'=>[
                'format'=>'Y-m-d'
            ],
            'opens'=>'left',
        ]
    ])->textInput(['size' => '30']) ?>


    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'discounts') ?>

    <?php // echo $form->field($model, 'balance') ?>

    <?php // echo $form->field($model, 'ref_balance') ?>

    <?php // echo $form->field($model, 'avatar') ?>

        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Очистить', ['class' => 'btn btn-default']) ?>

    <?php ActiveForm::end(); ?>

</div>
