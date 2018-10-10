<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PremiumKeys */

$this->title = Yii::t('app', 'Create Premium Keys');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Premium Keys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="premium-keys-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'fh' => $fh,
        's_id' => $s_id,
    ]) ?>

</div>
