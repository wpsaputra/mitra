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
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Mitra */
/* @var $form yii\widgets\ActiveForm */

$this->registerAssetBundle(yii\web\JqueryAsset::className(), View::POS_HEAD);
$this->registerCssFile('@web/css/font-awesome/css/font-awesome.min.css' , ['position' => View::POS_HEAD]);
$this->registerCssFile('@web/css/custom.css' , ['position' => View::POS_HEAD]);

$this->registerJsFile('@web/js/dropzone.js' , ['position' => View::POS_BEGIN]);
$this->registerCssFile('@web/css/dropzone.css' , ['position' => View::POS_HEAD]);

?>

<div class="mitra-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group field-mitra-foto required">
        <label class="control-label" for="mitra-foto">Upload Template File Excel</label>
        <div class="dropzone form-group" id="dropzone">
            <div class="dz-default dz-message"><span>Drop files or click here to upload (xlsx)</span></div>
        </div>
        <div class="help-block"></div>
    </div>

    <?php ActiveForm::end(); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Status Upload</h3>
        </div>
        <div class="panel-body">
            ....
        </div>
    </div>


</div>

<script>
    // https://stackoverflow.com/questions/24859005/dropzone-js-how-to-change-file-name-before-uploading-to-folder
    // https://stackoverflow.com/questions/29910240/get-count-of-selected-files-in-dropzone
    // Dropzone

    Dropzone.autoDiscover = false;
    var fileList = new Array;
    var i = 0;

    $("div#dropzone").dropzone({ 
        url: "<?php echo Url::to(['site/uploadexcel']);?>", 
        paramName: "UploadForm[imageFile]", // The name that will be used to transfer the file
        maxFilesize: 100, // MB
        addRemoveLinks: true,
        // acceptedFiles: "image/jpeg,image/png,application/vnd.ms-excel",
        acceptedFiles: "application/vnd.ms-excel",

        init: function() {
            // Hack: Add the dropzone class to the element
            // $(this.element).addClass("dropzone");
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

                    if(fileList[f].fileName == file.name && fileList[f].uuid == file.upload.uuid)
                    // if(fileList[f].uuid == file.upload.uuid)
                    {
                        rmvFile = fileList[f].serverFileName;
                        fileList.splice(f,1);
                        i=i-1;
                    }
                }
                if (rmvFile){
                    $.ajax({
                        // url: "http://localhost/dropzone/sample/delete_temp_files.php",
                        url: "<?php echo Url::to(['site/delete']);?>",
                        type: "POST",
                        data: { "fileList" : rmvFile }
                    });
                }
                console.log(fileList);
                var result = fileList.map(function(a) {return a.serverFileName;});
                $("#mitra-foto").text(result);
            });
        },
    
    
    });

</script>