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

        public function uploadExcel(){
            $fileName = $this->upload();

            if($fileName){
                // https://stackoverflow.com/questions/32221000/phpexcel-convert-xls-to-csv-with-special-characters
                $reader = \PHPExcel_IOFactory::createReader('Excel5');
                $reader->setReadDataOnly(false);
                $path = 'uploads/'.$fileName;
                $excel = $reader->load($path);
    
                $writer = \PHPExcel_IOFactory::createWriter($excel, 'CSV');
                $writer->setUseBOM(true);
                $writer->save($path.".csv");

                // \Yii::$app->db->createCommand('LOAD DATA INFILE :path
				// 	INTO TABLE `mitra`
				// 	FIELDS TERMINATED BY \',\'
				// 	ENCLOSED BY \'"\'
				// 	LINES TERMINATED BY \'\n\'
                //     IGNORE 1 LINES;')->bindValues([':path'=>\Yii::$app->basePath."/web/uploads/".$fileName.".csv"])->execute();

                ini_set('max_execution_time', 300);
                $row = 1;
                $dokumen = 'mitra';
				if (($handle = fopen(\Yii::$app->basePath."/web/uploads/".$fileName.".csv", "r")) !== FALSE) {
					while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {
                        $num = count($data);
                        
                        $row++;
                        if($row==2){
                            continue;
                        }

                        $arr_value = array();
                        $cmd = "REPLACE INTO ".$dokumen." VALUES (";
                        for ($c=0; $c < $num; $c++) {
                            if($c==$num-1){
                                $cmd = $cmd.":data".$c;
                            }else{
                                $cmd = $cmd.":data".$c.", ";
                            }
                            $arr_value[":data".$c] = $data[$c];
                        }
                        $cmd = $cmd.")";
                        \Yii::$app->db->createCommand($cmd)->bindValues($arr_value)->execute();
					}
					fclose($handle);
				}
                
                unlink($path);
                unlink($path.".csv");
    
            }
            return $fileName;
            
        }
}