<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Профиль';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="box box-info">
                <div class="box-body box-profile">
                    <?if (empty($model->avatar)){
                        echo Html::img('/dist/img/avatar5.png', ['class' => 'profile-user-img img-responsive img-circle']);
                    }else{
                       echo Html::img($model->avatar, ['class' => 'profile-user-img img-responsive img-circle']);
                    }
                     ?>
                    <h3 class="profile-username text-center"><?= $model->username ?></h3>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Прокачано ссылок</b> <span class="pull-right">1,322 шт.</span>
                        </li>
                        <li class="list-group-item">
                            <b>Трафик</b> <span class="pull-right">543 Gb</span>
                        </li>
                        <li class="list-group-item">
                            <b>Торрентов</b> <span class="pull-right">(В перспективе)</span>
                        </li>
                        <li class="list-group-item text-center">
                                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                                <?= Html::a('Delete', $url, [
                                    'class'       => 'btn btn-danger popup-modal',
                                    'data-toggle' => 'modal',
                                    'data-target' => '#modal',
                                    'data-id'     => $model->id,
                                    'data-name'   => $model->username,
                                    'id'          => 'popupModal',
                                ]); ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Активность</a></li>
                    <li class=""><a href="#timeline" data-toggle="tab" aria-expanded="false">Переписка</a></li>
                    <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Информация о
                            пользователе</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="activity">

                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="timeline">
                        <!-- The timeline -->

                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="settings">
                            <div class="table-responsive no-padding">
                                <?= $this->render('_form', [
                                    'model' => $model,
                                ]) ?>

                            </div>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
        </div>
    </div>
</section>


