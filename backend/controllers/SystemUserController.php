<?php

namespace backend\controllers;

use Yii;
use app\models\SystemUser;
use app\models\SystemUserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SystemUserController implements the CRUD actions for SystemUser model.
 */
class SystemUserController extends Controller
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
     * Lists all SystemUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SystemUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SystemUser model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SystemUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SystemUser();

        $request = Yii::$app->request->post();
        $nowTime = time();

        if (isset($request['SystemUser'])) {
            if (isset($request['SystemUser']['password_hash'])) {
                $pwd = $request['SystemUser']['password_hash'];
            }else{
                $pwd = '123456';
            }
            $request['SystemUser']['password_hash'] = Yii::$app->getSecurity()->generatePasswordHash($pwd);
            $request['SystemUser']['created_at'] = $nowTime;
            $request['SystemUser']['updated_at'] = $nowTime;
            $model->load($request);
            $result = $model -> save();
            if (!$result) {
                $request['SystemUser']['password_hash'] = $pwd;
            }
        }

        if ($model->load($request) && $result) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SystemUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldPwd = $model['password_hash'];
        $model['password_hash'] ='';
        $nowTime = time();

        $request = Yii::$app->request->post();

        if (isset($request['SystemUser'])) {
            if (isset($request['SystemUser']['password_hash']) && $request['SystemUser']['password_hash'] != '') {
                $pwd = $request['SystemUser']['password_hash'];
                $request['SystemUser']['password_hash'] = Yii::$app -> getSecurity() -> generatePasswordHash($pwd);
            }else{
                $request['SystemUser']['password_hash'] = $oldPwd;
            }
            $request['SystemUser']['updated_at'] = $nowTime;
            $model->load($request);
            $result = $model->save();
            if (!$result) {
                if (isset($pwd)) {
                    $request['SystemUser']['password_hash'] = $pwd;
                }
            }
        }

        if ($model->load($request) && $result) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SystemUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SystemUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SystemUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SystemUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
