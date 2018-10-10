<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html"><b>Vip</b>Account</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Залогинся бро...</p>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            ]); ?>

        <div class="form-group has-feedback">
            <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'placeholder' => 'Почта']) ->label(false); ?>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
            <?= $form->field($model, 'password')->passwordInput()->textInput(['placeholder' => 'Пароль'])->label(false); ?>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>

        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe')->checkbox()->label('Запомнить') ?>
            </div>
            <div class="col-xs-4">
                <?= Html::submitButton('Логин', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
    <!-- /.login-box-body -->
</div>

