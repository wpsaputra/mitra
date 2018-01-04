<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\JenisKelamin;
use app\models\MasterProp;
use app\models\MasterKab;
use app\models\MasterKec;
use app\models\MasterDesa;
use app\models\Pendidikan;
use app\models\User;
use app\models\Survei;

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
            // 'nama',
            [
                'attribute' => 'nama',
                'value' => function($model){
                    return strtoupper($model->nama);
                }
            ],
            // 'jenis_kelamin',
            [
                'attribute' => 'jenis_kelamin',
                'value' => function($model){
                    return JenisKelamin::findOne($model->jenis_kelamin)->nama;
                    
                }
            ],
            'tanggal_lahir',
            [
                'attribute' => 'propinsi',
                'value' => function($model){
                    return MasterProp::findOne($model->propinsi)->nm_prop;
                    
                }
            ],
            // 'kabupaten',
            [
                'attribute' => 'kabupaten',
                'value' => function($model){
                    return MasterKab::findOne($model->kabupaten)->nm_kab;
                    
                }
            ],
            // 'kecamatan',
            [
                'attribute' => 'kecamatan',
                'value' => function($model){
                    return MasterKec::findOne($model->kecamatan)->nm_kec;
                    
                }
            ],
            // 'desa',
            [
                'attribute' => 'desa',
                'value' => function($model){
                    return MasterDesa::findOne($model->desa)->nm_desa;
                    
                }
            ],
            'no_hp',
            // 'pendidikan',
            [
                'attribute' => 'pendidikan',
                'value' => function($model){
                    return Pendidikan::findOne($model->pendidikan)->nama;
                    
                }
            ],
            // 'pengalaman_survei:ntext',
            [
                'attribute' => 'pengalaman_survei',
                'value' => function($model){
                    $arr = explode(",", $model->pengalaman_survei);
                    $temp_arr = [];

                    foreach ($arr as $key => $value) {
                        array_push($temp_arr, Survei::findOne($value)->nama);
                    }
                    return implode(",", $temp_arr);
                }
            ],

            'penguasaan_kendaraan_motor',
            'penguasaan_hp_android_ics_keatas',
            'penguasaan_hp_android_ics_kebawah',
            'penguasaan_hp_ios',
            'penguasaan_hp_lainnya',
            // 'id_user',
            [
                'attribute' => 'id_user',
                'value' => function($model){
                    return User::findOne($model->id_user)->username;
                }
            ],
            'foto:ntext',
            'rating',
        ],
    ]) ?>

</div>
