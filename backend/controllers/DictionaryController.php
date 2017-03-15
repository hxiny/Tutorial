<?php

namespace backend\controllers;

use Yii;
use app\models\Dictionary;
use app\models\DictionarySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DictionaryController implements the CRUD actions for Dictionary model.
 */
class DictionaryController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Dictionary models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DictionarySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Dictionary model.
     * @param string $TYPE_NAME
     * @param string $CODE
     * @return mixed
     */
    public function actionView($TYPE_NAME, $CODE)
    {
        return $this->render('view', [
            'model' => $this->findModel($TYPE_NAME, $CODE),
        ]);
    }

    /**
     * Creates a new Dictionary model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Dictionary();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'TYPE_NAME' => $model->TYPE_NAME, 'CODE' => $model->CODE]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Dictionary model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $TYPE_NAME
     * @param string $CODE
     * @return mixed
     */
    public function actionUpdate($TYPE_NAME, $CODE)
    {
        $model = $this->findModel($TYPE_NAME, $CODE);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'TYPE_NAME' => $model->TYPE_NAME, 'CODE' => $model->CODE]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Dictionary model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $TYPE_NAME
     * @param string $CODE
     * @return mixed
     */
    public function actionDelete($TYPE_NAME, $CODE)
    {
        $this->findModel($TYPE_NAME, $CODE)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Dictionary model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $TYPE_NAME
     * @param string $CODE
     * @return Dictionary the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($TYPE_NAME, $CODE)
    {
        if (($model = Dictionary::findOne(['TYPE_NAME' => $TYPE_NAME, 'CODE' => $CODE])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
