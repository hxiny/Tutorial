<?php

namespace backend\controllers;

use Yii;
use app\models\DeviceUserAuth;
use app\models\DeviceUserAuthSearch;
use app\models\DeviceParams;
use app\models\DropListHelper;
use app\models\User;
use app\models\Device;
use app\models\Helper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;

/**
 * DeviceUserAuthSearchController implements the CRUD actions for DeviceUserAuth model.
 */
class DeviceUserAuthSearchController extends Controller
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
     * Lists all DeviceUserAuth models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DeviceUserAuthSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DeviceUserAuth model.
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
     * Creates a new DeviceUserAuth model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DeviceUserAuth();

        $allCells = DropListHelper::cell_str();

        $request = Yii::$app->request->post();

        if (isset($request['DeviceUserAuth']['USER_ID']) && !empty($request['DeviceUserAuth']['USER_ID']) && isset($request['DeviceUserAuth']['DEVICE_NAME']) && isset($request['DeviceUserAuth']['VALIDITY'] )) {

            foreach ($request['DeviceUserAuth']['USER_ID'] as $val) {

                foreach ($request['DeviceUserAuth']['DEVICE_NAME'] as $deviceName) {
                    $userAuthData = DeviceUserAuth::find()->where(['DEVICE_NAME'=>$deviceName, 'USER_ID'=>$val])->asArray()->all();
                    if (!empty($userAuthData)) {
                        $DeviceUserAuth = DeviceUserAuth::find()-> where(['DEVICE_NAME'=>$deviceName, 'USER_ID'=>$val]) ->one();
                    }else{
                        $DeviceUserAuth = new DeviceUserAuth();
                    }

                    $DeviceUserAuth['CELL_ID'] = $request['CELLS']['CELL_ID'];
                    $DeviceUserAuth['VALIDITY'] = $request['DeviceUserAuth']['VALIDITY'];
                    $DeviceUserAuth['IS_BINDINGS_MD'] = $request['DeviceUserAuth']['IS_BINDINGS_MD'];
                    $DeviceUserAuth['IS_BINDINGS_WECHAT'] = $request['DeviceUserAuth']['IS_BINDINGS_WECHAT'];
                    $DeviceUserAuth['KEY_TYPE'] = $request['DeviceUserAuth']['KEY_TYPE'];
                    $DeviceUserAuth['DEVICE_NAME'] = $deviceName;
                    $DeviceUserAuth['PID'] = '';
                    $DeviceUserAuth['USER_ID'] = '';
                    $DeviceUserAuth['AUID'] = '';
                    $devices = Device::find() -> where(['DEVICE_NAME' => $deviceName]) -> one() ->getAttributes();
                    $pid = $devices['SERIAL_NUMBER'];
                    $DeviceUserAuth['PID'] = $devices['SERIAL_NUMBER'];
                    $validity = $request['DeviceUserAuth']['VALIDITY'];
                    $deviceUrl = Yii::$app->params['device_url'].'/mdserver/service/qryKeys';
                    $wxUrl = Yii::$app->params['wx_url'].'/pservice/qryAllKeysService.aspx';
                    
                    $wx_client_cells = (new Query()) -> select('app_id') -> from('wx_client_cells') -> where('cell_id='.$request['CELLS']['CELL_ID']) -> all();

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

                    $users = User::find() -> where(['USER_ID' => $val]) -> one() ->getAttributes();
                    $auid = $users['PHONE'];
                    $DeviceUserAuth['USER_ID'] = $val;
                    $DeviceUserAuth['AUID'] = $auid;
                    $curl_post = 'app_key='.$deviceParams['0']['APP_KEY'].'&agt_num='.$deviceParams['0']['AGT_NUM'].'&pid='.$pid.'&user_id='.$auid.'&validity='.$validity;
                    $result = Helper::curl_post1($deviceUrl,$curl_post);
                    $status = $result -> status;
                    if (isset($status) && $status == 'success') {
                        $DeviceUserAuth['LOCK_ID'] = $result -> msg['0'] -> lock_id;
                        $post_data = 'app_key='.$deviceParams['0']['APP_KEY'].'&agt_num='.$deviceParams['0']['AGT_NUM'].'&gid='.$deviceParams['0']['GID'].'&openid='.$deviceParams['0']['APP_ID'].'&mtype=1&auid='.$auid;
                        $result2 = Helper::curl_post1($wxUrl,$post_data);
                        $status = $result2 -> status;
                        if (isset($status) && $status == 'success') {
                            $DeviceUserAuth['KSID'] = $result2 -> msg['0'] -> ksid;
                            $DeviceUserAuth['DEVICE_ID'] = $result2 -> msg['0'] -> device_id;


                            $res = $DeviceUserAuth -> save();
                             //var_dump($DeviceUserAuth->getErrors());
                        }
                    }else{
                        $msg = $result -> msg;
                    }
                }

            }
        }

        if (isset($res) && $res) {
            Yii::$app->getSession()->getFlash('success','添加成功');
            return $this->redirect(['view', 'id' => $DeviceUserAuth->ID]);
        } else {
            if (isset($msg)) {
                Yii::$app -> getSession() -> setFlash('error', $msg);
            }
            return $this->render('create', [
                'model' => $model,
                'cells' => $allCells
            ]);
        }
    }

    /**
     * Updates an existing DeviceUserAuth model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $request = Yii::$app->request->post();

        $modelArr = DeviceUserAuth::find($id)->asArray()->one();
        $users = User::find()->asArray()->where(['USER_ID' => $modelArr['USER_ID']])->one();
        $nickName = $users['NICKNAME'];


        if (isset($request['DeviceUserAuth']['VALIDITY'] )) {

                $pid = $modelArr['PID'];
                $validity = $request['DeviceUserAuth']['VALIDITY'];
                $deviceUrl = Yii::$app->params['device_url'].'/mdserver/service/qryKeys';
                $wxUrl = Yii::$app->params['wx_url'].'/pservice/qryAllKeysService.aspx';
                $deviceParams = DeviceParams::find() -> one() ->getAttributes();

                $auid = $modelArr['AUID'];
                $curl_post = 'app_key='.$deviceParams['APP_KEY'].'&agt_num='.$deviceParams['AGT_NUM'].'&pid='.$pid.'&user_id='.$auid.'&validity='.$validity;
                $result = Helper::curl_post1($deviceUrl,$curl_post);
                $status = $result -> status;
                if (isset($status) && $status == 'success') {
                    $request['DeviceUserAuth']['LOCK_ID'] = $result -> msg['0'] -> lock_id;
                    $post_data = 'app_key='.$deviceParams['APP_KEY'].'&agt_num='.$deviceParams['AGT_NUM'].'&gid='.$deviceParams['GID'].'&openid='.$deviceParams['APP_ID'].'&mtype=1&auid='.$auid;
                    $result2 = Helper::curl_post1($wxUrl,$post_data);
                    $status = $result2 -> status;
                    if (isset($status) && $status == 'success') {
                        $request['DeviceUserAuth']['KSID'] = $result2 -> msg['0'] -> ksid;
                        $res = DeviceUserAuth::updateAll($request['DeviceUserAuth'],'ID=:ID',[':ID' => $id]) ;
                    }
                }else{
                    $msg = $result -> msg;
                }
        }

        if (isset($res) && $res) {
            Yii::$app->getSession()->getFlash('success','修改成功');
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            if (isset($msg)) {
                Yii::$app -> getSession() -> setFlash('error', $msg);
            }
            return $this->render('update', [
                'model' => $model,
                'nickName' => $nickName,
            ]);
        }

    }

    /**
     * Deletes an existing DeviceUserAuth model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DeviceUserAuth model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return DeviceUserAuth the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DeviceUserAuth::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
