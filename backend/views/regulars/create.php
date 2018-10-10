<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Regulars */

$this->title = Yii::t('app', 'Create Regulars');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Regulars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regulars-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
