<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MitraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mitra-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'jenis_kelamin') ?>

    <?= $form->field($model, 'tanggal_lahir') ?>

    <?= $form->field($model, 'propinsi') ?>

    <?php // echo $form->field($model, 'kabupaten') ?>

    <?php // echo $form->field($model, 'kecamatan') ?>

    <?php // echo $form->field($model, 'no_hp') ?>

    <?php // echo $form->field($model, 'pendidikan') ?>

    <?php // echo $form->field($model, 'pengalaman_survei') ?>

    <?php // echo $form->field($model, 'penguasaan_kendaraan_motor') ?>

    <?php // echo $form->field($model, 'penguasaan_hp_android_ics_keatas') ?>

    <?php // echo $form->field($model, 'penguasaan_hp_android_ics_kebawah') ?>

    <?php // echo $form->field($model, 'penguasaan_hp_ios') ?>

    <?php // echo $form->field($model, 'penguasaan_hp_lainnya') ?>

    <?php // echo $form->field($model, 'id_user') ?>

    <?php // echo $form->field($model, 'foto') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
