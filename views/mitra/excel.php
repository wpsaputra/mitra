<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\Mitra */

$this->title = 'Excel Mitra';
// $this->params['breadcrumbs'][] = ['label' => 'Mitras', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;

?>
<div class="mitra-create">
    <div class="alert alert-warning alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <p><strong>Warning!</strong> Menu ini berguna untuk mengupdate mitra via excel, berikut merupakan tata cara penggunaan :</p> 
        <p>1. Download template excel terlebih dahulu kemudian isi lalu upload.</p>
        <p>2. Pastikan excel sudah terisi sesuai contoh template.</p>
        <p>3. Data mitra juga perlu diupdate untuk memasukan foto ke dalam database</p> 
    </div>
    <!-- <h2><?= Html::encode($this->title) ?></h2> -->

    <div class="row">
        <div class="col-md-12">
            <a href="<?php echo Url::to('@web/uploads/template_mitra.xlsx');?>" download="template_mitra.xlsx" class="btn btn-primary pull-right">Download Template Excel</a>
        </div>
    </div>

    <?= $this->render('_form_excel', [
        'model' => $model,
    ]) ?>

</div>
