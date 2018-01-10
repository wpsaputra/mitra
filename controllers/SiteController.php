<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\UploadForm;
use yii\web\UploadedFile;
use app\models\MasterKab;
use app\models\MasterKec;
use app\models\MasterDesa;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'index', 'upload', 'delete', 'contact', 'about'],
                'rules' => [
                    [
                        // 'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    
    // Custom
    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $md = $model->upload();
            if ($md) {
                // file is uploaded successfully
                return $md;
                // print_r($md);
            }
        }

        return $this->render('upload', ['model' => $model]);
    }

    public function actionUploadexcel()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $md = $model->upload();
            if ($md) {
                // file is uploaded successfully
                return $md;
                // print_r($md);
            }
        }

        return $this->render('upload', ['model' => $model]);
    }

    public function actionDelete()
    {
        $ds = DIRECTORY_SEPARATOR;  // Store directory separator (DIRECTORY_SEPARATOR) to a simple variable. This is just a personal preference as we hate to type long variable name.
        $storeFolder = 'uploads'; 
        
        $fileList = $_POST['fileList'];
        // $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;
        $targetPath = $storeFolder . $ds;
        
        
        if(isset($fileList)){
            unlink($targetPath.$fileList);
        }
    }

    public function beforeAction($action) { $this->enableCsrfValidation = false; return parent::beforeAction($action); }

    public function actionGet()
    {
    	$request = Yii::$app->request;
    	$obj = $request->post('obj');
    	$value = $request->post('value');
    	switch ($obj) {
    		case 'mitra-kabupaten':
                $data = MasterKab::find()->where(['id_prop' => $value])->all();
                $tagOptions = ['prompt' => "Pilih Kabupaten"];
                return Html::renderSelectOptions([], ArrayHelper::map($data, 'id_kab', 'nm_kab'), $tagOptions);
    			break;
    		case 'mitra-kecamatan':
                $data = MasterKec::find()->where(['id_kab' => $value])->all();
                $tagOptions = ['prompt' => "Pilih Kecamatan"];
                return Html::renderSelectOptions([], ArrayHelper::map($data, 'id_kec', 'nm_kec'), $tagOptions);
    			break;
    		case 'mitra-desa':
                $data = MasterDesa::find()->where(['id_kec' => $value])->all();
                $tagOptions = ['prompt' => "Pilih Desa"];
                return Html::renderSelectOptions([], ArrayHelper::map($data, 'id_desa', 'nm_desa'), $tagOptions);
    			break;
    	}
    	$tagOptions = ['prompt' => "=== Select ==="];
        // return Html::renderSelectOptions([], ArrayHelper::map($data, 'id', 'name'), $tagOptions);
        // return $obj;
    }
}
