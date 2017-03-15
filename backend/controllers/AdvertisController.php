<?php

namespace backend\controllers;

use Yii;
use app\models\Advertis;
use app\models\AdvertisSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;

/**
 * AdvertisController implements the CRUD actions for Advertis model.
 */
class AdvertisController extends Controller
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
     * Lists all Advertis models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdvertisSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Advertis model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Advertis model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Advertis();
        $request = Yii::$app->request->post();
        if (isset($request['Advertis'])) {
            $model->load($request);
            $result = $model->save();
            if ($result && isset($request['Advertis']['CELL_ID'])) {
                $res = Yii::$app->db->createCommand()->insert('t_advertis_cell', [
                    'ADVERTIS_ID' => $model->ID,
                    'CELL_ID' => $request['Advertis']['CELL_ID'],
                    'STATUS' => $request['Advertis']['STATUS'],
                ])->execute();
            }
        }

        if ($model->load($request) && $model->save()) {
            \app\models\SystemLog::saveLog('广告管理',Yii::$app->controller->action->id/*,$model->primaryKey*/);

            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Advertis model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $request = Yii::$app->request->post();
        $cells = (new Query())
                    -> select('CELL_ID')
                    -> from('t_advertis_cell')
                    -> where(['ADVERTIS_ID' => $id])
                    -> one();
        $model->CELL_ID = $cells['CELL_ID'];
        if (isset($request['Advertis'])) {
            if ($request['Advertis']['CELL_ID'] != null && $model->CELL_ID == null) {
                $res = Yii::$app->db->createCommand()->insert('t_advertis_cell', [
                    'ADVERTIS_ID' => $model->ID,
                    'CELL_ID' => $request['Advertis']['CELL_ID'],
                    'STATUS' => $request['Advertis']['STATUS'],
                ])->execute();
            }else if ($request['Advertis']['CELL_ID'] != null && $model->CELL_ID != null && $request['Advertis']['CELL_ID'] != $model->CELL_ID) {
                $res = Yii::$app->db->createCommand()->update('t_advertis_cell', 
                    [
                    'CELL_ID' => $request['Advertis']['CELL_ID'],
                    ],
                    'ADVERTIS_ID='.$id
                )->execute();
            }
        }

        if ($model->load($request) && $model->save()) {
            \app\models\SystemLog::saveLog('广告管理',Yii::$app->controller->action->id);
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Advertis model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->db->createCommand()->delete('t_advertis_cell', 'ADVERTIS_ID='.$id)->execute();

        \app\models\SystemLog::saveLog('广告管理',Yii::$app->controller->action->id);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Advertis model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Advertis the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Advertis::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
