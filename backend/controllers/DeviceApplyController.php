<?php

namespace backend\controllers;

use Yii;
use app\models\DeviceApply;
use app\models\DeviceApplySearch;
use app\models\DeviceUserAuth;
use app\models\DeviceParams;
use app\models\Helper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;

/**
 * DeviceApplyController implements the CRUD actions for DeviceApply model.
 */
class DeviceApplyController extends Controller
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
     * Lists all DeviceApply models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DeviceApplySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DeviceApply model.
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
     * Creates a new DeviceApply model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DeviceApply();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing DeviceApply model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $request = Yii::$app->request->post();
        if (isset($request['DeviceApply']['AUDIT_STATUS']) && $request['DeviceApply']['AUDIT_STATUS'] == 1) {
            $user_id  = $request['DeviceApply']['USER_ID'];
            $userAuth  = DeviceUserAuth::find()->where(['USER_ID' => $user_id]) -> one() -> getAttributes();
            $auid = $userAuth['AUID'];
            $pid = $userAuth['PID'];
            $validity = $request['DeviceApply']['VALIDITY'];
            $url = Yii::$app->params['device_url'].'/mdserver/service/qryKeys';
            
            $wx_client_cells = (new Query()) -> select('app_id') -> from('wx_client_cells') -> where('cell_id='.$request['DeviceApply']['CELL_ID']) -> all();

            if (empty($wx_client_cells)) {
                Yii::$app->getSession()->setFlash('error','小区对应公众号配置未配置');
                return $this->render('update',[
                        'model' => $model,
                    ]);
            }

            $deviceParams = DeviceParams::find() ->asArray() -> where(['APP_ID' => $wx_client_cells['0']['app_id']]) ->all();

            if (empty($deviceParams)) {
                Yii::$app->getSession()->setFlash('error','对应小区门禁配置未配置');
                return $this->render('update',[
                        'model' => $model,
                    ]);
            }

            $curl_post = 'app_key='.$deviceParams['0']['APP_KEY'].'&agt_num='.$deviceParams['0']['AGT_NUM'].'pid='.$pid.'&user_id='.$auid.'&validity='.$validity;
            $result = Helper::curl_post1($url,$curl_post);
            if (isset($result->status) && $result->status == 'seccess') {
                $lock_id = $result-> msg['0'] ->lock_id ;
                DeviceUserAuth::updateAll(array('LOCK_ID' => $lock_id, 'VALIDITY' => $validity), 'USER_ID = :user_id', array(':user_id' => $user_id) );
            }else{
                $msg = $result -> msg;
            }
        }
        if ($model->load($request) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            if (isset($msg)) {
                Yii::$app->getSession()->setFlash('error', $msg);
            }
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DeviceApply model.
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
     * Finds the DeviceApply model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DeviceApply the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DeviceApply::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
