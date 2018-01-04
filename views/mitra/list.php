<?php
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use app\models\Mitra;
// use app\models\Fenomena;

$dataProvider = new ActiveDataProvider([
    // 'query' => Fenomena::find()->where(['isVerified'=>1]),
    'query' => Mitra::find(),
    'pagination' => [
        'pageSize' => 9,
    ],
]);
?>

<div class="post">
    <!-- <div class="alert alert-warning alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Warning!</strong> Fenomena yang ditampilkan hanya fenomena yang sudah diapprove admin.
    </div> -->

    <div class="row">
        <?php
        echo ListView::widget([
            'dataProvider' => $dataProvider,
            'summary'=>'', 
            'itemView' => '_post',
            'pager' => [
                // Customzing options for pager container tag
                'options' => [
                    'tag' => 'div',
                    'class' => 'pagination col-md-12',
                    // 'style' => 'position:absolute;bottom:0;',
                    'id' => 'pager-container',
                ],
                
            ],



        ]);
        ?>
    </div>
</div>


