<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use app\models\JenisKelamin;
use app\models\MasterKec;
use app\models\Survei;
use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MitraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mitras';
$this->params['breadcrumbs'][] = $this->title;

$request = Yii::$app->request;
$perpage = $request->get('per-page', 0);
?>
<div class="mitra-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <form name="pageselect">
        <div class="row" style="margin-bottom: 5px;">
            <div class="col-sm-3">
                <select name="menu" class="form-control" onChange="window.document.location.href=this.options[this.selectedIndex].value;" value="GO">
                    <option <?php echo ($perpage==5)? 'selected' : 'value'; ?>="<?php echo Url::to(['mitra/index', 'per-page' => 5]);?>">Tampilkan 5 Baris</option>
                    <option <?php echo ($perpage==10)? 'selected' : 'value'; ?>="<?php echo Url::to(['mitra/index', 'per-page' => 10]);?>">Tampilkan 10 Baris</option>
                    <option <?php echo ($perpage==0)? 'selected' : 'value'; ?>="<?php echo Url::to(['mitra/index']);?>">Tampilkan Semua</option>
                </select>
            </div>
        </div>
    </form>

    <p>
        <?= Html::a('Create Mitra', ['create'], ['class' => 'btn btn-success pull-right', 'style'=>'margin-bottom:5px;']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
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
            // 'propinsi',
            //'kabupaten',
            // 'kecamatan',
            [
                'attribute' => 'kecamatan',
                'value' => function($model){
                    return MasterKec::findOne($model->kecamatan)->nm_kec;
                }
            ],
            //'desa',
            //'no_hp',
            //'pendidikan',
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
            //'penguasaan_kendaraan_motor',
            //'penguasaan_hp_android_ics_keatas',
            //'penguasaan_hp_android_ics_kebawah',
            //'penguasaan_hp_ios',
            //'penguasaan_hp_lainnya',
            // 'id_user',
            [
                'attribute' => 'id_user',
                'value' => function($model){
                    return User::findOne($model->id_user)->username;
                }
            ],
            //'foto:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<script type="text/javascript">
    $("#button").click(function(){
        $(".table").table2excel({
            // exclude CSS class
            exclude: ".filters",
            name: "sheet 1",
            filename: "Export Fenomena" //do not include extension
        }); 
    });
</script>