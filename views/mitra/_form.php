<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\JenisKelamin;
use app\models\MasterProp;
use app\models\MasterKab;
use app\models\MasterKec;
use app\models\MasterDesa;
use app\models\Pendidikan;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\Mitra */
/* @var $form yii\widgets\ActiveForm */

$this->registerAssetBundle(yii\web\JqueryAsset::className(), View::POS_HEAD);
$this->registerCssFile('@web/css/font-awesome/css/font-awesome.min.css' , ['position' => View::POS_HEAD]);
$this->registerCssFile('@web/css/custom.css' , ['position' => View::POS_HEAD]);

?>

<div class="mitra-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'jenis_kelamin')->textInput() ?> -->
    <?= $form->field($model, 'jenis_kelamin')->dropDownList(
        ArrayHelper::map(JenisKelamin::find()->all(),'id','nama'),
        ['prompt'=>'Pilih Jenis Kelamin']
    )?> 

    <!-- <?= $form->field($model, 'tanggal_lahir')->textInput() ?> -->
    <?= $form->field($model, 'tanggal_lahir')->widget(\yii\jui\DatePicker::classname(), [
        //'language' => 'ru',
        // 'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control']
    ]) ?>

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

    <!-- <?= $form->field($model, 'desa')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'desa')->dropDownList(
        ArrayHelper::map(MasterDesa::find()->all(),'id_desa','nm_desa'),
        ['prompt'=>'Pilih Desa']
    )?>

    <?= $form->field($model, 'no_hp')->textInput() ?>

    <!-- <?= $form->field($model, 'pendidikan')->textInput() ?> -->
    <?= $form->field($model, 'pendidikan')->dropDownList(
        ArrayHelper::map(Pendidikan::find()->all(),'id','nama'),
        ['prompt'=>'Pilih Pendidikan']
    )?>

    <?= $form->field($model, 'pengalaman_survei')->textarea(['rows' => 6]) ?>

    <div class="form-group field-mitra-penguasaan_kendaraan_motor required">
        <label class="control-label" for="mitra-penguasaan_kendaraan_motor">Penguasaan Kendaraan Motor</label>
        <!-- <input id="mitra-penguasaan_kendaraan_motor" class="form-control" name="Mitra[penguasaan_kendaraan_motor]" aria-required="true" type="text"> -->
        <div class="input-group spinner" style="width:100%">
            <input id="mitra-penguasaan_kendaraan_motor" class="form-control" name="Mitra[penguasaan_kendaraan_motor]" aria-required="true" type="text" value="0" min="0" max="5">
            <div class="input-group-btn-vertical">
            <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
            <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
            </div>
        </div>
        <div class="help-block"></div>
    </div>


    <!-- <?= $form->field($model, 'penguasaan_hp_android_ics_keatas')->textInput() ?> -->
    <div class="form-group field-mitra-penguasaan_hp_android_ics_keatas required">
        <label class="control-label" for="mitra-penguasaan_hp_android_ics_keatas">Penguasaan Hp Android Ics Keatas</label>
        <!-- <input id="mitra-penguasaan_hp_android_ics_keatas" class="form-control" name="Mitra[penguasaan_hp_android_ics_keatas]" aria-required="true" aria-required="true" type="text"> -->
        <div class="input-group spinner" style="width:100%">
            <input id="mitra-penguasaan_hp_android_ics_keatas" class="form-control" name="Mitra[penguasaan_hp_android_ics_keatas]" aria-required="true" aria-required="true" type="text" value="0" min="0" max="5">
            <div class="input-group-btn-vertical">
            <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
            <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
            </div>
        </div>
        <div class="help-block"></div>
    </div>

    <!-- <?= $form->field($model, 'penguasaan_hp_android_ics_kebawah')->textInput() ?> -->
    <div class="form-group field-mitra-penguasaan_hp_android_ics_kebawah required">
        <label class="control-label" for="mitra-penguasaan_hp_android_ics_kebawah">Penguasaan Hp Android Ics Kebawah</label>
        <!-- <input id="mitra-penguasaan_hp_android_ics_kebawah" class="form-control" name="Mitra[penguasaan_hp_android_ics_kebawah]" aria-required="true" type="text"> -->
        <div class="input-group spinner" style="width:100%">
            <input id="mitra-penguasaan_hp_android_ics_kebawah" class="form-control" name="Mitra[penguasaan_hp_android_ics_kebawah]" aria-required="true" type="text" value="0" min="0" max="5">
            <div class="input-group-btn-vertical">
            <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
            <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
            </div>
        </div>
        <div class="help-block"></div>
    </div>

    <!-- <?= $form->field($model, 'penguasaan_hp_ios')->textInput() ?> -->
    <div class="form-group field-mitra-penguasaan_hp_ios required">
        <label class="control-label" for="mitra-penguasaan_hp_ios">Penguasaan Hp Ios</label>
        <!-- <input id="mitra-penguasaan_hp_ios" class="form-control" name="Mitra[penguasaan_hp_ios]" aria-required="true" type="text"> -->
        <div class="input-group spinner" style="width:100%">
            <input id="mitra-penguasaan_hp_ios" class="form-control" name="Mitra[penguasaan_hp_ios]" aria-required="true" type="text" value="0" min="0" max="5">
            <div class="input-group-btn-vertical">
            <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
            <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
            </div>
        </div>

        <div class="help-block"></div>
    </div>

    <!-- <?= $form->field($model, 'penguasaan_hp_lainnya')->textInput() ?> -->
    <div class="form-group field-mitra-penguasaan_hp_lainnya required">
        <label class="control-label" for="mitra-penguasaan_hp_lainnya">Penguasaan Hp Lainnya</label>
        <!-- <input id="mitra-penguasaan_hp_lainnya" class="form-control" name="Mitra[penguasaan_hp_lainnya]" aria-required="true" type="text"> -->
        <div class="input-group spinner" style="width:100%">
            <input id="mitra-penguasaan_hp_lainnya" class="form-control" name="Mitra[penguasaan_hp_lainnya]" aria-required="true" type="text" value="0" min="0" max="5">
            <div class="input-group-btn-vertical">
            <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
            <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
            </div>
        </div>

        <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'id_user')->textInput() ?>

    <?= $form->field($model, 'foto')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<!-- <i class="fa fa-camera-retro fa-5x"></i> fa-5x -->
<!-- <div class="col-md-4"> -->

  <!-- <div class="input-group spinner">
    <input type="text" class="form-control" value="1" min="0" max="5">
    <div class="input-group-btn-vertical">
      <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
      <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
    </div>
  </div>
  <p class="help-block">Min 0 - Max 5.</p> -->
  
<!-- </div> -->

<script>
    $(function(){

    $('.spinner .btn:first-of-type').on('click', function() {
      var btn = $(this);
      var input = btn.closest('.spinner').find('input');
      if (input.attr('max') == undefined || parseInt(input.val()) < parseInt(input.attr('max'))) {    
        input.val(parseInt(input.val(), 10) + 1);
      } else {
        btn.next("disabled", true);
      }
    });
    $('.spinner .btn:last-of-type').on('click', function() {
      var btn = $(this);
      var input = btn.closest('.spinner').find('input');
      if (input.attr('min') == undefined || parseInt(input.val()) > parseInt(input.attr('min'))) {    
        input.val(parseInt(input.val(), 10) - 1);
      } else {
        btn.prev("disabled", true);
      }
    });

})
</script>