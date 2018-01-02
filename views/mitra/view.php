<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Mitra */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mitras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mitra-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nama',
            'jenis_kelamin',
            'tanggal_lahir',
            'propinsi',
            'kabupaten',
            'kecamatan',
            'desa',
            'no_hp',
            'pendidikan',
            'pengalaman_survei:ntext',
            'penguasaan_kendaraan_motor',
            'penguasaan_hp_android_ics_keatas',
            'penguasaan_hp_android_ics_kebawah',
            'penguasaan_hp_ios',
            'penguasaan_hp_lainnya',
            'id_user',
            'foto:ntext',
        ],
    ]) ?>

</div>
