<?php

namespace app\controllers;

use Yii;
use app\models\Mitra;
use app\models\MitraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\HttpException;
use yii\data\ActiveDataProvider;

/**
 * MitraController implements the CRUD actions for Mitra model.
 */
class MitraController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete', 'list'],
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Mitra models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MitraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if(Yii::$app->user->identity->level!=1){
            $dataProvider->query->where('id_user = '.Yii::$app->user->identity->getId());
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mitra model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if(Yii::$app->user->identity->level!=1){
            if($model->id_user!=Yii::$app->user->identity->getId()){
                throw new HttpException(403, "You are not allowed to perform this action");
            }
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Mitra model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mitra();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Mitra model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if(Yii::$app->user->identity->level!=1){
            if($model->id_user!=Yii::$app->user->identity->getId()){
                throw new HttpException(403, "You are not allowed to perform this action");
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Mitra model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Mitra model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mitra the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mitra::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionList()
    {
        if(Yii::$app->user->identity->level==1){
            $dataProvider = new ActiveDataProvider([
                // 'query' => Fenomena::find()->where(['isVerified'=>1]),
                'query' => Mitra::find(),
                'pagination' => [
                    'pageSize' => 9,
                ],
            ]);
        }else{
            $dataProvider = new ActiveDataProvider([
                'query' => Mitra::find()->where(['id_user'=>Yii::$app->user->identity->getId()]),
                // 'query' => Mitra::find(),
                'pagination' => [
                    'pageSize' => 9,
                ],
            ]);
        }

        
        return $this->render('list', [
            'dataProvider' => $dataProvider,
            
        ]);
    }
}
