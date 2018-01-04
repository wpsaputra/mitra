<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use app\models\Survei;
use kartik\rating\StarRating;

$array_image_dokumen = explode(",", $model->foto); //image+dokumen
$array_image = array(); //image only

for($i=0; $i<count($array_image_dokumen); $i++){
    $value = substr($array_image_dokumen[$i], -4); 
    if($value===".jpg"||$value===".png"){
        array_push($array_image, $array_image_dokumen[$i]);
    }

}

if(count($array_image)==0){
    array_push($array_image, 'no_photo_available.jpg');
}


?>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    
                    <!-- Carousel -->
                    <div id="myCarousel<?php echo $model->id; ?>" class="carousel slide" data-ride="carousel" data-interval="false">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <!-- <li data-target="#myCarousel<?php //echo $model->id; ?>" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel<?php //echo $model->id; ?>" data-slide-to="1"></li>
                            <li data-target="#myCarousel<?php //echo $model->id; ?>" data-slide-to="2"></li> -->

                            <?php
                                for($i=0; $i<count($array_image); $i++){
                                    $carousel = '<li data-target="#myCarousel?id" data-slide-to="?i" class="?class"></li>';
                                    if($i==0){
                                        $carousel = str_replace("?id", $model->id, $carousel);
                                        $carousel = str_replace("?i", $i, $carousel);
                                        $carousel = str_replace("?class", "active", $carousel);
                                    }else{
                                        $carousel = str_replace("?id", $model->id, $carousel);
                                        $carousel = str_replace("?i", $i, $carousel);
                                        $carousel = str_replace("?class", "", $carousel);
                                    }
                                    echo $carousel;
    
                                }
            
                            ?>

                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <!-- <div class="item active">
                            <img src="http://localhost:1000/sifeni/web/uploads/1.jpg" alt="Los Angeles">
                            </div>

                            <div class="item">
                            <img src="http://localhost:1000/sifeni/web/uploads/2.jpg" alt="Chicago">
                            </div>

                            <div class="item">
                            <img src="http://localhost:1000/sifeni/web/uploads/3.jpg" alt="New York">
                            </div> -->

                            <?php
                                for($i=0; $i<count($array_image); $i++){
                                    $carousel_inner = '
                                        <div class="?class">
                                        ?src
                                        </div>
                                    ';
                                    if($i==0){
                                        $carousel_inner = str_replace("?class", 'item active', $carousel_inner);
                                        $carousel_inner = str_replace("?src", Html::img('@web/uploads/'.$array_image[$i]), $carousel_inner);
                                    }else{
                                        $carousel_inner = str_replace("?class", 'item', $carousel_inner);
                                        $carousel_inner = str_replace("?src", Html::img('@web/uploads/'.$array_image[$i]), $carousel_inner);
                                    }
                                    echo $carousel_inner;
    
                                }
            
                            ?>



                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel<?php echo $model->id; ?>" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel<?php echo $model->id; ?>" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <p>
                        <br/> 
                        
                        <?php
                            echo StarRating::widget([
                                'name' => 'rating_35',
                                'value' => $model->rating,
                                'pluginOptions' => ['displayOnly' => true]
                            ]);

                            $arr = explode(",", $model->pengalaman_survei);
                            $temp_arr = [];
        
                            foreach ($arr as $key => $value) {
                                array_push($temp_arr, Survei::findOne($value)->nama);
                            }
        
                            echo implode(",", $temp_arr); 
                            // echo $model->pengalaman_survei; 
                        ?>
                    </p>

                    <?= Html::a('View Detail', ['view', 'id' => $model->id], ['class' => 'btn btn-primary pull-right', 'style'=>"margin-left:5px"]) ?>

                    <div class="dropdown pull-right <?=($array_image_dokumen[0]=="" && count($array_image_dokumen)==1) ? 'hidden' : ''?>">
                        <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Download
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <!-- <li><a href="#">HTML</a></li>
                            <li><a href="#">CSS</a></li>
                            <li><a href="#">JavaScript</a></li> -->
                            <?php
                                for($i=0; $i<count($array_image_dokumen); $i++){
                                    $download = '
                                    <li><a href="?href" download="?download">?text</a></li>
                                    ';

                                    // $download = '
                                    // <li>?href</li>
                                    // ';

                                    $variable = substr($array_image_dokumen[$i], 10);
                                    $url = Url::to('@web/uploads/'.$array_image_dokumen[$i]);
                                    

                                    $download = str_replace("?href", $url, $download);
                                    $download = str_replace("?download", $variable, $download);
                                    $download = str_replace("?text", $variable, $download);
                                    // $download = str_replace("?href", Html::a($variable, ['@web/uploads/'.$variable], ['download' => $variable]), $download);
                                    echo $download;
    
                                }
                            ?>
                        </ul>
                    </div>


                </div>
            </div>
        </div>
