<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\web\View;
use yii\helpers\Url;

AppAsset::register($this);
Yii::$app->view->title = 'SiFeni'; 
// Yii::$app->view->title = Yii::$app->user->identity->level; 
$this->registerCssFile('@web/css/custom_login.css' , ['position' => View::POS_END]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="shortcut icon" type="image/png" href="<?php echo Url::to('@web/css/favicon.ico');?>"/>
    <?php $this->head() ?>
</head>
<body>
<!-- <body class="color-grey"> -->
<!-- <body class="imx"> -->
<?php $this->beginBody() ?>

<div class="wrap">
        <div class="outer-container">
            <div class="inner-container">
                <div class="centered-content" style="width: 350px">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php echo $content; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>




</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
