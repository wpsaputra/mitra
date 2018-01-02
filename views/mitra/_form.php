<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\JenisKelamin;
use yii\helpers\ArrayHelper;
use app\models\MasterProp;
use app\models\MasterKab;
use app\models\MasterKec;

/* @var $this yii\web\View */
/* @var $model app\models\Mitra */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mitra-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'jenis_kelamin')->textInput() ?> -->
    <?= $form->field($model, 'jenis_kelamin')->dropDownList(
        ArrayHelper::map(JenisKelamin::find()->all(),'id','nama'),
        ['prompt'=>'Pilih Jenis Kelamin']
    )?> 

    <?= $form->field($model, 'tanggal_lahir')->textInput() ?>

    <!-- <?= $form->field($model, 'propinsi')->textInput() ?> -->
    <?= $form->field($model, 'propinsi')->dropDownList(
        ArrayHelper::map(MasterProp::find()->all(),'id_prop','nm_prop'),
        ['prompt'=>'Pilih Propinsi']
    )?>

    <!-- <?= $form->field($model, 'kabupaten')->textInput() ?> -->
    <?= $form->field($model, 'kabupaten')->dropDownList(
        ArrayHelper::map(MasterKab::find()->all(),'id_kab','nm_kab'),
        ['prompt'=>'Pilih Kabupaten']
    )?>

    <!-- <?= $form->field($model, 'kecamatan')->textInput() ?> -->
    <?= $form->field($model, 'kecamatan')->dropDownList(
        ArrayHelper::map(MasterKec::find()->all(),'id_kec','nm_kec'),
        ['prompt'=>'Pilih Kecamatan']
    )?>

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
