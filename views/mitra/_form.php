<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Mitra */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mitra-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenis_kelamin')->textInput() ?>

    <?= $form->field($model, 'tanggal_lahir')->textInput() ?>

    <?= $form->field($model, 'propinsi')->textInput() ?>

    <?= $form->field($model, 'kabupaten')->textInput() ?>

    <?= $form->field($model, 'kecamatan')->textInput() ?>

    <?= $form->field($model, 'no_hp')->textInput() ?>

    <?= $form->field($model, 'pendidikan')->textInput() ?>

    <?= $form->field($model, 'pengalaman_survei')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'penguasaan_kendaraan_motor')->textInput() ?>

    <?= $form->field($model, 'penguasaan_hp_android_ics_keatas')->textInput() ?>

    <?= $form->field($model, 'penguasaan_hp_android_ics_kebawah')->textInput() ?>

    <?= $form->field($model, 'penguasaan_hp_ios')->textInput() ?>

    <?= $form->field($model, 'penguasaan_hp_lainnya')->textInput() ?>

    <?= $form->field($model, 'id_user')->textInput() ?>

    <?= $form->field($model, 'foto')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
