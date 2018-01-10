<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{

    public $imageFile;
    
        public function rules()
        {
            return [
                [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, xlsx, xls'],
            ];
        }
        
        public function upload()
        {
            if ($this->validate()) {
                $date = new \DateTime();
                $date = $date->getTimestamp();

                $this->imageFile->saveAs('uploads/' . $date .  $this->imageFile->baseName . '.' . $this->imageFile->extension);
                return $date .  $this->imageFile->baseName . '.' . $this->imageFile->extension;
                // return true;
            } else {
                return false;
            }
        }
}