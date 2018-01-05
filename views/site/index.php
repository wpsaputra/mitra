<?php

/* @var $this yii\web\View */
// use miloschuman\highcharts\HighchartsAsset;
use miloschuman\highcharts\Highcharts;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\User;

// HighchartsAsset::register($this)->withScripts(['highstock', 'modules/exporting', 'modules/drilldown']);
$this->title = 'MITRA';

$sql_jumlah_laki = "SELECT `id_user`, COUNT(`id`) AS `Jumlah Mitra` FROM `mitra` WHERE `jenis_kelamin`=1 GROUP BY `id_user`";
$sql_jumlah_perempuan = "SELECT `id_user`, COUNT(`id`) AS `Jumlah Mitra` FROM `mitra` WHERE `jenis_kelamin`=2 GROUP BY `id_user`";

$result_jumlah_laki = Yii::$app->getDb()->createCommand($sql_jumlah_laki)->queryAll();
$result_jumlah_perempuan = Yii::$app->getDb()->createCommand($sql_jumlah_perempuan)->queryAll();

// $result_jumlah_laki = call_user_func_array('array_merge', $result_jumlah_laki);

$array_bps = ArrayHelper::map(User::find()->where("level=2")->all(), 'id', 'alias');
$array_bps_laki = $array_bps;
$array_bps_perempuan = $array_bps;

// Zero init
foreach ($array_bps_laki as $key => $value) {
    $array_bps_laki[$key] = 0;
    $array_bps_perempuan[$key] = 0;
}

foreach ($result_jumlah_laki as $key => $value) {
    $array_bps_laki[$value["id_user"]] = (float)$value["Jumlah Mitra"];
}

foreach ($result_jumlah_perempuan as $key => $value) {
    $array_bps_perempuan[$value["id_user"]] = (float)$value["Jumlah Mitra"];
}

// print_r($result_jumlah_laki);
// print_r($result_jumlah_perempuan);
// print_r($array_bps_laki);
// print_r($array_bps_perempuan);


// print_r(array_values($array_bps));
// print_r(array_values($array_bps_laki));

echo Highcharts::widget([
    'options' => [
        'chart' => ['type' => 'bar'],
        'title' => ['text' => 'Jumlah Mitra'],
        'xAxis' => [
            'categories' => array_values($array_bps)
        ],
        'yAxis' => [
            'title' => ['text' => 'Mitra']
        ],
        'series' => [
            // ['name' => 'Laki-Laki', 'data' => [1, 0, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]],
            ['name' => 'Laki-Laki', 'data' => array_values($array_bps_laki)],
            // ['name' => 'Perempuan', 'data' => [5, 7, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]]
            ['name' => 'Perempuan', 'data' => array_values($array_bps_perempuan)]
        ]
    ]
 ]);
?>
<div class="site-index">
    <div class="body-content">
    <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">
                    Selamat Datang di Database MITRA
                </h3>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-check"></i> Daftar Mitra</h4>
                    </div>
                    <div class="panel-body">
                        <p>Menu ini berguna untuk melihat daftar tabel mitra yang sudah dientri. Klik tombol lanjut di bawah untuk masuk ke dalam menu.</p>
                        <a href="<?php echo Url::to(['mitra/index']);?>" class="btn btn-default">Lanjut</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-gift"></i> Entri Mitra</h4>
                    </div>
                    <div class="panel-body">
                        <p>Menu ini berguna untuk mengentri daftar Mitra di dalam aplikasi. Klik tombol lanjut di bawah untuk masuk ke dalam menu.</p>
                        <a href="<?php echo Url::to(['mitra/create']);?>" class="btn btn-default">Lanjut</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-check"></i> Galeri</h4>
                    </div>
                    <div class="panel-body">
                        <p>Menu ini berguna untuk melihat daftar foto, rating, serta pengalaman mitra. Klik tombol lanjut di bawah untuk masuk ke dalam menu.</p>
                        <a href="<?php echo Url::to(['mitra/list']);?>" class="btn btn-default">Lanjut</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

