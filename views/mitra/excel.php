<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Mitra */

$this->title = 'Excel Mitra';
$this->params['breadcrumbs'][] = ['label' => 'Mitras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="mitra-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-12">
            <input type="button" id="button" value="Download Template Excel" class="btn btn-primary pull-right">
        </div>
    </div>

    <?= $this->render('_form_excel', [
        'model' => $model,
    ]) ?>

</div>
