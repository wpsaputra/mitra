<?php

/* @var $this yii\web\View */
// use miloschuman\highcharts\HighchartsAsset;
use miloschuman\highcharts\Highcharts;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\User;

// HighchartsAsset::register($this)->withScripts(['highstock', 'modules/exporting', 'modules/drilldown']);
$this->title = 'My Yii Application';
echo Highcharts::widget([
    'options' => [
        'chart' => ['type' => 'bar'],
        'title' => ['text' => 'Jumlah Mitra'],
        'xAxis' => [
            'categories' => array_values(ArrayHelper::map(User::find()->where("level=2")->all(), 'id', 'alias'))
        ],
        'yAxis' => [
            'title' => ['text' => 'Mitra']
        ],
        'series' => [
            ['name' => 'Laki-Laki', 'data' => [1, 0, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]],
            ['name' => 'Perempuan', 'data' => [5, 7, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]]
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

