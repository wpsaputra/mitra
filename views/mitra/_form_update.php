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
use yii\helpers\Url;
use app\models\Survei;
use borales\extensions\phoneInput\PhoneInput;
use libphonenumber\PhoneNumberUtil;
use libphonenumber\PhoneNumberFormat;
use yii\base\UserException;
use kartik\rating\StarRating;

/* @var $this yii\web\View */
/* @var $model app\models\Mitra */
/* @var $form yii\widgets\ActiveForm */

$this->registerAssetBundle(yii\web\JqueryAsset::className(), View::POS_HEAD);
$this->registerCssFile('@web/css/font-awesome/css/font-awesome.min.css' , ['position' => View::POS_HEAD]);
$this->registerCssFile('@web/css/custom.css' , ['position' => View::POS_HEAD]);

$this->registerJsFile('@web/js/dropzone.js' , ['position' => View::POS_BEGIN]);
$this->registerCssFile('@web/css/dropzone.css' , ['position' => View::POS_HEAD]);

// http://lab-informatika.com/script/26/yii-2-dependent-dropdown
$js = '$(".dependent-input").on("change", function() {
	var value = $(this).val(),
		obj = $(this).attr("id"),
		next = $(this).attr("data-next");
	$.ajax({
		url: "' . Yii::$app->urlManager->createUrl('site/get') . '",
		data: {value: value, obj: next},
		type: "POST",
		success: function(data) {
			$("#" + next).html(data);
		}
	});
});';
// $this->registerJs($js, ['position' => View::POS_HEAD]);
$this->registerJs($js);

// https://bootsnipp.com/snippets/AXVrV

?>

<div class="mitra-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true, 'style'=>'text-transform: uppercase']) ?>

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
        [
            'prompt'=>'Pilih Propinsi',
            // 'id' => 'propinsi',
            'class' => 'dependent-input form-control',
            'data-next' => 'mitra-kabupaten'
        ]
    )?>

    <!-- <?= $form->field($model, 'kabupaten')->textInput() ?> -->
    <?= $form->field($model, 'kabupaten')->dropDownList(
        ArrayHelper::map(MasterKab::find()->all(),'id_kab','nm_kab'),
        [
            'prompt'=>'Pilih Kabupaten',
            'class' => 'dependent-input form-control',
            'data-next' => 'mitra-kecamatan'
        ]
    )?>

    <!-- <?= $form->field($model, 'kecamatan')->textInput() ?> -->
    <?= $form->field($model, 'kecamatan')->dropDownList(
        ArrayHelper::map(MasterKec::find()->all(),'id_kec','nm_kec'),
        [
            'prompt'=>'Pilih Kecamatan',
            'class' => 'dependent-input form-control',
            'data-next' => 'mitra-desa'
        ]
    )?>

    <!-- <?= $form->field($model, 'desa')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'desa')->dropDownList(
        ArrayHelper::map(MasterDesa::find()->all(),'id_desa','nm_desa'),
        ['prompt'=>'Pilih Desa']
    )?>

    <!-- <?= $form->field($model, 'no_hp')->textInput() ?> -->
    <?= $form->field($model, 'no_hp')->widget(PhoneInput::className(), [
        'jsOptions' => [
            'allowExtensions' => true,
            'onlyCountries' => ['id'],
            'nationalMode' => false,
        ],
        'class' => 'form-control',
    ]); ?>

    <!-- <?= $form->field($model, 'pendidikan')->textInput() ?> -->
    <?= $form->field($model, 'pendidikan')->dropDownList(
        ArrayHelper::map(Pendidikan::find()->all(),'id','nama'),
        ['prompt'=>'Pilih Pendidikan']
    )?>

    <div style="display: none">
        <?= $form->field($model, 'pengalaman_survei')->textarea(['rows' => 6]) ?>
    </div>

    <div class="form-group field-mitra-pengalaman_survei required">
        <label class="control-label" for="mitra-pengalaman_survei">Pengalaman Survei</label>
        <!-- <textarea id="mitra-pengalaman_survei" class="form-control" name="Mitra[pengalaman_survei]" rows="6" aria-required="true">gdgdg</textarea> -->
        <div id="list-survei">
            <div class="form-group">
                <div class="input-group">
                    <select class="form-control surveilist" id="excalibur" name="educationDate[]" onchange="list_survei();">
                        <option value="">Pilih Survei</option>
                        <?php
                            $arr = ArrayHelper::map(Survei::find()->all(), 'id', 'nama');
                            foreach($arr as $key => $item){
                                echo '<option value="'.$key.'">'.$item.'</option>';
                            }
                        
                        ?>
                    </select>
                    <div class="input-group-btn">
                        <button class="btn btn-success" type="button" onclick="education_fields();"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="help-block"></div>
    </div>


    <!-- <?= $form->field($model, 'penguasaan_kendaraan_motor')->textInput() ?> -->
    <div class="form-group field-mitra-penguasaan_kendaraan_motor required">
        <label class="control-label" for="mitra-penguasaan_kendaraan_motor">Penguasaan Kendaraan Motor</label>
        <!-- <input id="mitra-penguasaan_kendaraan_motor" class="form-control" name="Mitra[penguasaan_kendaraan_motor]" aria-required="true" type="text"> -->
        <div class="input-group spinner" style="width:100%">
            <input id="mitra-penguasaan_kendaraan_motor" class="form-control" name="Mitra[penguasaan_kendaraan_motor]" aria-required="true" 
                type="text" value="<?=($model->penguasaan_kendaraan_motor) ? $model->penguasaan_kendaraan_motor : 0?>" min="0" max="5">
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
            <input id="mitra-penguasaan_hp_android_ics_keatas" class="form-control" name="Mitra[penguasaan_hp_android_ics_keatas]" aria-required="true" aria-required="true" 
                type="text" value="<?=($model->penguasaan_hp_android_ics_keatas) ? $model->penguasaan_hp_android_ics_keatas : 0?>" min="0" max="5">
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
            <input id="mitra-penguasaan_hp_android_ics_kebawah" class="form-control" name="Mitra[penguasaan_hp_android_ics_kebawah]" aria-required="true" 
                type="text" value="<?=($model->penguasaan_hp_android_ics_kebawah) ? $model->penguasaan_hp_android_ics_kebawah : 0?>" min="0" max="5">
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
            <input id="mitra-penguasaan_hp_ios" class="form-control" name="Mitra[penguasaan_hp_ios]" aria-required="true" 
                type="text" value="<?=($model->penguasaan_hp_ios) ? $model->penguasaan_hp_ios : 0?>" min="0" max="5">
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
            <input id="mitra-penguasaan_hp_lainnya" class="form-control" name="Mitra[penguasaan_hp_lainnya]" aria-required="true" 
                type="text" value="<?=($model->penguasaan_hp_lainnya) ? $model->penguasaan_hp_lainnya : 0?>" min="0" max="5">
            <div class="input-group-btn-vertical">
            <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
            <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
            </div>
        </div>

        <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'id_user')->textInput() ?>
    
    <div style="display: none">
        <?= $form->field($model, 'foto')->textarea(['rows' => 6]) ?>
    </div>

    <div class="form-group field-mitra-foto required">
        <label class="control-label" for="mitra-foto">Upload Foto</label>
        <div class="dropzone form-group" id="dropzone">
            <div class="dz-default dz-message"><span>Drop files or click here to upload (jpg, jpeg, png)</span></div>
        </div>
        <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'rating')->widget(StarRating::classname(), [
        'pluginOptions' => ['size'=>'sm']
    ]);?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    // Penguasaan kendaraan
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

    // https://stackoverflow.com/questions/24859005/dropzone-js-how-to-change-file-name-before-uploading-to-folder
    // https://stackoverflow.com/questions/29910240/get-count-of-selected-files-in-dropzone
    // Dropzone

    Dropzone.autoDiscover = false;
    var fileList = new Array;
    var i = 0;

    $("div#dropzone").dropzone({ 
        url: "<?php echo Url::to(['site/upload']);?>", 
        paramName: "UploadForm[imageFile]", // The name that will be used to transfer the file
        maxFilesize: 100, // MB
        addRemoveLinks: true,
        acceptedFiles: "image/jpeg,image/png",

        init: function() {
            // Hack: Add the dropzone class to the element
            // $(this.element).addClass("dropzone");
            
            // var mockFile = { name: "myimage.jpg", size: 12345, type: 'image/jpeg' };       
            
            // this.options.addedfile.call(this, mockFile);
            // this.options.thumbnail.call(this, mockFile, "http://localhost:1000/sifeni/web/uploads/1.jpg");
            // mockFile.previewElement.classList.add('dz-success');
            // mockFile.previewElement.classList.add('dz-complete');

            // this.emit("addedfile", mockFile);
            // this.emit("thumbnail", mockFile, "http://localhost:1000/sifeni/web/uploads/1511784770image_1.jpg");

            // var img = new Image();
            // img.src =  'http://localhost:1000/sifeni/web/uploads/1511784770image_1.jpg';
            // img.height = 300;
            // img.width = 300;

            // this.createThumbnailFromUrl(mockFile, 'http://localhost:1000/sifeni/web/uploads/1511784770image_1.jpg');

            var fileserver = $("#mitra-foto").text();
            if(fileserver==""){
                fileserver = new Array;
            }else{
                fileserver = fileserver.split(",");
            }

            for(f=0;f<fileserver.length;f++){
                let mockFile = {
                    name: fileserver[f],
                    size: 12345,
                    dataURL: '<?php echo Url::to('@web/uploads/')?>'+fileserver[f],
                };
                console.log("Mock FILE"+mockFile);


                let xdr = this;
                
                this.files.push(mockFile);
                this.emit('addedfile', mockFile);
                this.createThumbnailFromUrl(
                    mockFile,
                    this.options.thumbnailWidth,
                    this.options.thumbnailHeight,
                    this.options.thumbnailMethod,
                    true,
                    function(thumbnail) {
                        xdr.emit('thumbnail', mockFile, thumbnail);
                        xdr.emit('complete', mockFile);
                    }
                );
                // this.emit('success', mockFile);
                // console.log("file"+file);

                fileServer = {"serverFileName" : fileserver[f], "fileName" : fileserver[f],"fileId" : i, "uuid" : i};
                fileList[i] = fileServer;
                i++;

            }

            this.on("success", function(file, serverFileName) {
                fileList[i] = {"serverFileName" : serverFileName, "fileName" : file.name,"fileId" : i, "uuid" : file.upload.uuid};
                console.log(fileList);
                console.log(file);
                console.log(file.upload.uuid);
                i++;

                var result = fileList.map(function(a) {return a.serverFileName;});
                $("#mitra-foto").text(result);

            });

            this.on("removedfile", function(file) {
                var rmvFile = "";
                for(f=0;f<fileList.length;f++){

                    // if(fileList[f].fileName == file.name && fileList[f].uuid == file.upload.uuid)
                    if(fileList[f].fileName == file.name)
                    {
                        rmvFile = fileList[f].serverFileName;
                        fileList.splice(f,1);
                        i=i-1;
                    }
                }
                if (rmvFile){
                    $.ajax({
                        // url: "http://localhost/dropzone/sample/delete_temp_files.php",
                        // disable delete
                        // url: "<?php //echo Url::to(['site/delete']);?>",
                        // type: "POST",
                        // data: { "fileList" : rmvFile }
                    });
                }
                console.log(fileList);
                var result = fileList.map(function(a) {return a.serverFileName;});
                $("#mitra-foto").text(result);
            });
        },
    
    
    });

    // bootsnip survei list
    var room = 1;
    function education_fields() {
        room++;
        // var objTo = document.getElementById('education_fields')
        var objTo = document.getElementById('list-survei')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "form-group removeclass"+room);
        var rdiv = 'removeclass'+room;
        divtest.innerHTML = '<div class="input-group"><select onchange="list_survei();" class="form-control surveilist" id="educationDate" name="educationDate[]"><option value="">Pilih Survei</option><?php
                            $arr = ArrayHelper::map(Survei::find()->all(), 'id', 'nama');
                            foreach($arr as $key => $item){
                                echo '<option value="'.$key.'">'.$item.'</option>';
                            }
                        
                        ?></select><div class="input-group-btn"><button class="btn btn-danger" type="button" onclick="remove_education_fields('+ room +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div>';
        
        objTo.appendChild(divtest)
    }
    
    // On Change Update Survei List
    function list_survei(){
        var selectedValues = $(".surveilist").map(function(){
            return this.value;
        }).get().filter(Boolean);

        var uniqueNames = [];
        $.each(selectedValues, function(i, el){
            if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
        });

        selectedValues = uniqueNames.join(',');

        // console.log(selectedValues);
        $("#mitra-pengalaman_survei").val(selectedValues);

    }

    function remove_education_fields(rid) {
        $('.removeclass'+rid).remove();
        list_survei();
    }

    // Update fill value
    function update_fields(value) {
        room++;
        // var objTo = document.getElementById('education_fields')
        var objTo = document.getElementById('list-survei')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "form-group removeclass"+room);
        var rdiv = 'removeclass'+room;
        divtest.innerHTML = '<div class="input-group"><select onchange="list_survei();" class="form-control surveilist" id="educationDate" name="educationDate[]"><option value="">Pilih Survei</option><?php
                            $arr = ArrayHelper::map(Survei::find()->all(), 'id', 'nama');
                            foreach($arr as $key => $item){
                                // if($key==value){
                                //     echo '<option value="'.$key.'" selected="selected">'.$item.'</option>';
                                // }else{
                                //     echo '<option value="'.$key.'">'.$item.'</option>';
                                // }
                                echo '<option value="'.$key.'">'.$item.'</option>';
                            }
                        
                        ?></select><div class="input-group-btn"><button class="btn btn-danger" type="button" onclick="remove_education_fields('+ room +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div>';
        
        objTo.appendChild(divtest)
        // return divtest;
        return divtest.childNodes[0].childNodes[0];
    }


    var srv = $("#mitra-pengalaman_survei").text();
    if(srv==""){
        srv = new Array;
    }else{
        srv = srv.split(",");
    }

    for(f=0;f<srv.length;f++){
        if(f==0){
            $("#excalibur").val(srv[f])
        }else{
            var divtest = update_fields(srv[f]);
            divtest.selectedIndex = srv[f];
        }
        // console.log(divtest.childNodes[0].childNodes[0]);
    }

</script>