<?php

namespace backend\controllers;

use Yii;
use app\models\WxClientInfo;
use app\models\WxClientInfoSearch;
use app\models\WxClientCells;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * WxClientInfoController implements the CRUD actions for WxClientInfo model.
 */
class WxClientInfoController extends Controller
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
     * Lists all WxClientInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WxClientInfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WxClientInfo model.
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
     * Creates a new WxClientInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new WxClientInfo();

        $request = Yii::$app->request->post();
        if (isset($request['WxClientInfo'])) {
            $model -> load($request);
            $result = $model -> save();
            if ($result) {
                if (!empty($request['WxClientInfo']['cell_id'])) {
                    foreach ($request['WxClientInfo']['cell_id'] as $value) {
                        $WxClientCellsExist = WxClientCells::find() -> where(['cell_id' => $value, 'app_id' => $request['WxClientInfo']['app_id']]) -> asArray() -> all();
                        if (empty($WxClientCellsExist)) {
                             $WxClientCells = new WxClientCells();
                             $WxClientCells->cell_id = $value;
                             $WxClientCells->app_id = $request['WxClientInfo']['app_id'];
                             $WxClientCells->create_date = date('Y-m-d H:i:s');
                             $WxClientCells -> save();
                         } 
                    }
                }
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
     * Updates an existing WxClientInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $WxClientCells = WxClientCells::find()->where(['app_id' => $model->app_id]) -> asArray() -> all();
        $cellsArray = ArrayHelper::map($WxClientCells, 'id', 'cell_id');
        $model->cell_id = $cellsArray;
        $request = Yii::$app->request->post();
        if (isset($request['WxClientInfo'])) {
            $model->update_date = date('Y-m-d H:i:s');
            $model->load($request);
            $result = $model->save();
            if ($result) {
                if (!empty($request['WxClientInfo']['cell_id'])) {
                    if (empty($cellsArray)) {
                        foreach ($request['WxClientInfo']['cell_id'] as $val) {
                            $WxCells = new WxClientCells();
                            $WxCells['app_id'] = $request['WxClientInfo']['app_id'];
                            $WxCells['cell_id'] = $val;
                            $WxCells['create_date'] = date('Y-m-d H:i:s');
                            $WxCells ->save();
                        }
                    }else{
                        $addWxCells = array_diff($request['WxClientInfo']['cell_id'], $cellsArray);
                        $deleteWxCells = array_diff($cellsArray, $request['WxClientInfo']['cell_id']);
                        if (!empty($addWxCells)) {
                            foreach ($addWxCells as $val) {
                                $WxCells = new WxClientCells();
                                $WxCells['app_id'] = $request['WxClientInfo']['app_id'];
                                $WxCells['cell_id'] = $val;
                                $WxCells['create_date'] = date('Y-m-d H:i:s');
                                $WxCells ->save();
                            }
                        }
                        if (!empty($deleteWxCells)) {
                            foreach ($deleteWxCells as $val) {
                                WxClientCells::deleteAll('app_id=:appId and cell_id=:cellId', [':appId'=>$request['WxClientInfo']['app_id'], ':cellId'=>$val]);
                            }
                        }
                    }
                }else{
                    if (!empty($cellsArray)) {
                        foreach ($cellsArray as $val) {
                            WxClientCells::deleteAll('app_id=:appId and cell_id=:cellId', [':appId'=>$request['WxClientInfo']['app_id'], ':cellId'=>$val]);
                        }
                    }
                }
            }
            //print_r($request);die();
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
     * Deletes an existing WxClientInfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

        $model = $this->findModel($id);
        $WxClientCells = WxClientCells::find()->where(['app_id' => $model->app_id]) -> asArray() -> all();
        $deleteWxCells = ArrayHelper::map($WxClientCells, 'id', 'cell_id');
        if(!empty($deleteWxCells)){
            foreach ($deleteWxCells as $val) {
                WxClientCells::deleteAll('app_id=:appId and cell_id=:cellId', [':appId'=>$model['app_id'], ':cellId'=>$val]);
            }
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the WxClientInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WxClientInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WxClientInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
