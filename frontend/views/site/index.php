<?php

/* @var $this yii\web\View */

$this->title = 'Загрузчик';
?>
<section data-ng-controller="vaCntrl" class="content">

    <!-- Default box -->
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div><h3 class="box-title">Выпрямление ссылок</h3></div>
                <div><small>Это процесс получения прямой ссылки на файл, расположенный на файлообменнике.</small></div>
            </div>
            <div class="box-body">
                <div class="text-center">В форму ниже можно вставлять одну или несколько ссылок (каждую с новой строки) на файлы для их последующего скачивания</div>
                <textarea data-ng-model="urls" data-ng-change="info()" class="form-control" rows="4" placeholder="Enter ..."></textarea>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button data-ng-click="check()" type="button" class="btn btn-block btn-primary">Отправить</button>
            </div>
            <!-- /.box-footer-->
        </div>
        <div data-ng-if="errorMessage" class="animate-if ng-cloak">
            <div class="alert alert-danger text-center">{{errorMessage}}</div>
        </div>
        <!-- /.box -->
    </div>
    <div class="col-md-4">
        <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
                <h3 class="widget-user-username">Профиль</h3>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">457.45 Gb</h5>
                            <span class="description-text">Баланс</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">45.78 Gb</h5>
                            <span class="description-text">Скачано</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                        <div class="description-block">
                            <h5 class="description-header">4</h5>
                            <span class="description-text">Рефериалов</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            </div>
                    <!-- /.col -->
        <!-- /.box -->
    </div>
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?=\Yii::t('app', 'Будет списано')?></h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" id="links_info">
                <div data-ng-if="!total_size" class="text-center animate-if nodata"><?=\Yii::t('app', 'Нет данных для отображения')?></div>
                <div class="animate-if ng-cloak" data-ng-if="total_size" id="total_size">
                    <p><?=\Yii::t('app', 'Общий размер:')?> <b>{{total_size}} Гб</b></p>
                    <p><?=\Yii::t('app', 'Цена:')?> <b>{{total_coef_size}} Гб</b></p>
                    <p><?=\Yii::t('app', 'Скидка:')?> <b>{{total_discount}} Гб</b></p>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>

</section>
