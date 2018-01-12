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
                // ini_set('memory_limit', '1024M'); // or you could use 1G


                $path = 'uploads/'.$fileName;
                $inputFileType = \PHPExcel_IOFactory::identify($path);

                // $reader = \PHPExcel_IOFactory::createReader('Excel5');
                $reader = \PHPExcel_IOFactory::createReaderForFile($path);
                $reader->setReadDataOnly(false);
                $excel = $reader->load($path);
    
                $writer = \PHPExcel_IOFactory::createWriter($excel, 'CSV');
                $writer->setUseBOM(true);
                $writer->save($path.".csv");

                $this->importCSV2($fileName);
                
                
                unlink($path);
                unlink($path.".csv");


            }
            return $fileName;
            
        }

        public function importCSV($fileName){
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

        }

        public function importCSV2($fileName){
            // \Yii::$app->db->createCommand('LOAD DATA INFILE :path
			// 	TABLE `mitra`
			// 	TERMINATED BY \',\'
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
                        // skip col name excel
                        continue;
                    }

                    $arr_value = array();
                    $cmd = "REPLACE INTO ".$dokumen." VALUES (";
                    for ($c=0; $c < $num; $c++) {
                        if($c==11||$c==12){
                            // skip col 11 & 12
                            continue;
                        }

                        if($c==$num-1){
                            $cmd = $cmd.":data".$c;
                        }else{
                            $cmd = $cmd.":data".$c.", ";
                        }
                        $arr_value[":data".$c] = $data[$c];
                    }
                    $cmd = $cmd.")";
                    // replace value
                    $arr_value[":data2"] = JenisKelamin::find()->where(["nama"=>$data[2]])->one()->id;
                    $arr_value[":data4"] = MasterProp::find()->where(["nm_prop"=>$data[4]])->one()->id_prop;
                    $arr_value[":data5"] = MasterKab::find()->where(["nm_kab"=>$data[5]])->one()->id_kab;
                    $arr_value[":data6"] = MasterKec::find()->where(["nm_kec"=>$data[6]])->one()->id_kec;
                    $arr_value[":data7"] = MasterDesa::find()->where(["nm_desa"=>$data[7]])->one()->id_desa;
                    $arr_value[":data9"] = Pendidikan::find()->where(["nama"=>$data[9]])->one()->id;
                    $arr_value[":data18"] = \Yii::$app->user->id;

                    $survei = "";
                    if(strlen($data[10])>0){
                        $temp = Survei::find()->where(["nama"=>$data[10]])->one()->id;
                        $survei = $temp;
                    }

                    if(strlen($data[11])>0){
                        $temp = Survei::find()->where(["nama"=>$data[11]])->one()->id;
                        $survei = $survei.",".$temp;
                    }

                    if(strlen($data[12])>0){
                        $temp = Survei::find()->where(["nama"=>$data[12]])->one()->id;
                        $survei = $survei.",".$temp;
                    }

                    $arr_value[":data10"] = $survei;

                    \Yii::$app->db->createCommand($cmd)->bindValues($arr_value)->execute();
				}
				fclose($handle);
			}

        }
}