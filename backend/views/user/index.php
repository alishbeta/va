<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
    <div class="box box-success">
        <div class="box-header with-border ">
            <h3 class="box-title">Поиск</h3>
        </div>
        <div class="box-body">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
    </div>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Зарегестрированые пользователи</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <?= Html::a('Создать', ['create'], [
                            'class' => 'btn btn-success popup-modal-1',
                            'data-toggle' => 'modal',
                            'data-target' => '#modal',
                            'data-id' => '',
                            'data-title' => 'Регистрация нового пользователя',
                            'id' => 'popupModal',]) ?>
                    </p>
                    <div class="table-responsive no-padding">
                        <?php Pjax::begin(); ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            //'filterModel' => $searchModel,
                            'tableOptions' => ['class' => 'table table-bordered table-hover'],
                            'columns' => [
                                'id',
                                'group_id',
                                'username',
                                // 'auth_key',
                                // 'token',
                                // 'password_hash',
                                // 'password_reset_token',
                                'email:email',
                                // 'status',
                                'created_at:datetime',
                                // 'updated_at',
                                'discounts',
                                'balance',
                                'ref_balance',
                                // 'avatar',

                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'header' => 'Действия',
                                    'headerOptions' => ['width' => '80'],
                                    'template' => '{view} {update} {delete}{link}',
                                    'buttons' => [
                                        'delete' => function ($url, $model) {
                                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                                'class' => 'popup-modal',
                                                'data-toggle' => 'modal',
                                                'data-target' => '#modal',
                                                'data-id' => $model->id,
                                                'data-name' => $model->username,
                                                'id' => 'popupModal',
                                            ]);
                                        }
                                    ],
                                ],
                            ],
                        ]); ?>
                        <?php Pjax::end(); ?>
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </div>
    </div>
</section>
