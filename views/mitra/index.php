<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MitraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mitras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mitra-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Mitra', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nama',
            'jenis_kelamin',
            'tanggal_lahir',
            'propinsi',
            //'kabupaten',
            //'kecamatan',
            //'desa',
            //'no_hp',
            //'pendidikan',
            //'pengalaman_survei:ntext',
            //'penguasaan_kendaraan_motor',
            //'penguasaan_hp_android_ics_keatas',
            //'penguasaan_hp_android_ics_kebawah',
            //'penguasaan_hp_ios',
            //'penguasaan_hp_lainnya',
            //'id_user',
            //'foto:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
