<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Mitra */

$this->title = 'Update Mitra: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Mitras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mitra-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
