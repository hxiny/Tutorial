<?php

namespace backend\controllers;

use app\models\Helper;
use Yii;
use app\models\Device;
use app\models\DeviceSearch;
use app\models\Cells;
use app\models\DeviceParams;
use app\models\WxClientInfo;
use app\models\Region;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;

/**
 * DeviceController implements the CRUD actions for Device model.
 */
class DeviceController extends Controller
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
     * Lists all Device models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DeviceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Device model.
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
     * Creates a new Device model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Device();
        Helper::setCreateTimeAndCreateUser($model);
        Helper::setUpdateTimeAndUpdateUser($model);
        $model->ID = Helper::createID();
        $request = Yii::$app->request->post();
        if (isset($request['Device']['CELL_ID'])) {
            $provinceName = '';
            $cityName = '';
            $countyName = '';

            if (isset($request['Device']['provinces']) && $request['Device']['provinces']) {
                $provinceId = $request['Device']['provinces'];
                $region = Region::find()->where(['region_code'=>$provinceId])->asArray()->all();
                $provinceName = $region['0']['region_name'];
            }

            if (isset($request['Device']['citys']) && $request['Device']['citys']) {
                $cityId = $request['Device']['citys'];
                $region = Region::find()->where(['region_code'=>$cityId])->asArray()->all();
                $cityName = $region['0']['region_name'];
            }

            if (isset($request['Device']['countys']) && $request['Device']['countys']) {
                $countyId = $request['Device']['countys'];
                $region = Region::find()->where(['region_code'=>$countyId])->asArray()->all();
                $countyName = $region['0']['region_name'];
            }

            $request['Device']['ADDRESS'] = $provinceName.$cityName.$countyName;

            $id = $request['Device']['CELL_ID'];

            $serialNumber = $request['Device']['SERIAL_NUMBER'];
            $snResult = Device::find()->asArray()->where(['SERIAL_NUMBER'=>$serialNumber])->all();
            if (isset($snResult) && !empty($snResult)) {
                Yii::$app->getSession()->setFlash('error','串号已存在');
                $model->load($request);
                return $this->render('create',[
                        'model' => $model,
                    ]);
            }


            $wx_client_cells = (new Query()) -> select('app_id') -> from('wx_client_cells') -> where('cell_id='.$request['Device']['CELL_ID']) -> all();

            $wx_client_info = WxClientInfo::find() ->asArray()-> where(['app_id' => $wx_client_cells['0']['app_id']])->all();

            if (empty($wx_client_cells)) {
                Yii::$app->getSession()->setFlash('error','小区对应公众号配置未配置');
                $model->load($request);
                return $this->render('create',[
                        'model' => $model,
                    ]);
            }

            $deviceParams = DeviceParams::find() ->asArray() -> where(['APP_ID' => $wx_client_cells['0']['app_id']]) ->all();
            if (empty($deviceParams)) {
                Yii::$app->getSession()->setFlash('error','对应小区门禁配置未配置');
                $model->load($request);
                return $this->render('create',[
                        'model' => $model,
                    ]);
            }

            $address = $request['Device']['ADDRESS'];
            $cellName = Cells::find()->where(['ID' => $id]) -> one() ->getAttributes();


            $url = Yii::$app->params['device_url'].'/mdserver/service/addCommunity';
            $curlPost = 'app_key='.$deviceParams['0']['APP_KEY'].'&agt_num='.$deviceParams['0']['AGT_NUM'].'&depart_name='.$cellName['NAME'].'&city_code='.$address;
            $file_contents = Helper::curl_post1($url,$curlPost);
            if (isset($file_contents->status) && $file_contents->status == 'success') {
                $str = $file_contents->data->createsysdate;
                $createsysdate = date('Y-m-d H:i:s', substr($str,0,10));
                $request['Device']['DEPARTID'] = $file_contents->data->departid;
                $request['Device']['CREATESYSDATE'] = $createsysdate;
                $departid = $file_contents->data->departid; 
            }else{
                $msg = $file_contents->msg;
                if (isset($msg->city_code)) {
                    $msg = '安装地址格式错误';
                }
            }
        }
        if (isset($departid) && $departid) {
            $url = Yii::$app->params['device_url'].'/mdserver/service/installLock';
            $pid = $request['Device']['SERIAL_NUMBER'];
            $install_lock_name = $request['Device']['DEVICE_NAME'];
            $install_address = $request['Device']['ADDRESS'];
            $curlPost = 'app_key='.$deviceParams['0']['APP_KEY'].'&agt_num='.$deviceParams['0']['AGT_NUM'].'&pid='.$pid.'&departid='.$departid.'&install_lock_name='.$install_lock_name.'&install_address='.$install_address;
            $file_contents = Helper::curl_post1($url,$curlPost);

            $get_access_url = Yii::$app->params['get_access_url'].'?grant_type=client_credential&appid='.$wx_client_info['0']['app_id'].'&secret='.$wx_client_info['0']['ap_secret'];
            $access_result = json_decode(file_get_contents($get_access_url));
            if (isset($access_result->access_token) && $access_result->access_token) {
                $wx_url_syn = Yii::$app->params['wx_url'].'/pservice/syncDeviceService.aspx';
                $wx_url_syn_data = 'agt_num='.$deviceParams['0']['AGT_NUM'].'&app_key='.$deviceParams['0']['APP_KEY'].'&gid='.$deviceParams['0']['GID'].'&pid='.$pid.'&access_token='.$access_result->access_token;
                $wx_syn_result = Helper::curl_post1($wx_url_syn,$wx_url_syn_data);
                if (isset($wx_syn_result->status)) {
                    $status22 = $wx_syn_result->status;
                    if ($wx_syn_result->status != 'success') {
                        Yii::$app->getSession()->setFlash('error',$wx_syn_result->msg);
                        return $this->render('create',[
                                'model' => $model,
                            ]);
                    }else{
                        $request['Device']['DEVICE_ID'] = $wx_syn_result->device_id;
                    }
                }else{
                    Yii::$app->getSession()->setFlash('error','公众号配置同步失败');
                    $model->load($request);
                    return $this->render('create',[
                        'model' => $model,
                    ]);
                }

            }else{
                Yii::$app->getSession()->setFlash('error','获取access_token失败');
                $model->load($request);
                return $this->render('create',[
                        'model' => $model,
                    ]);
            }

            if (isset($file_contents->status) && $file_contents->status == 'success') {
                $model->load($request);
                $res = $model->save();
            }else{
                $msg = $file_contents->msg;
            }  

        }
        if (isset($res) && $res) {
            Yii::$app->getSession()->getFlash('success','添加成功');
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            if (isset($msg)) {
                Yii::$app->getSession()->setFlash('error', $msg);
            }
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Device model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        Helper::setCreateTimeAndCreateUser($model);
        Helper::setUpdateTimeAndUpdateUser($model);
        $model->ID = Helper::createID();
        $request = Yii::$app->request->post();
        if (isset($request['Device']['CELL_ID'])) {

            $id = $request['Device']['CELL_ID'];

            $wx_client_cells = (new Query()) -> select('app_id') -> from('wx_client_cells') -> where('cell_id='.$request['Device']['CELL_ID']) -> all();

            $wx_client_info = WxClientInfo::find() ->asArray()-> where(['app_id' => $wx_client_cells['0']['app_id']])->all();

            if (empty($wx_client_cells)) {
                Yii::$app->getSession()->setFlash('error','小区对应公众号配置未配置');
                $model->load($request);
                return $this->render('update',[
                        'model' => $model,
                    ]);
            }

            $deviceParams = DeviceParams::find() ->asArray() -> where(['APP_ID' => $wx_client_cells['0']['app_id']]) ->all();
            if (empty($deviceParams)) {
                Yii::$app->getSession()->setFlash('error','对应小区门禁配置未配置');
                $model->load($request);
                return $this->render('update',[
                        'model' => $model,
                    ]);
            }

            $address = $request['Device']['ADDRESS'];
            $cellName = Cells::find()->where(['ID' => $id]) -> one() ->getAttributes();


            $url = Yii::$app->params['device_url'].'/mdserver/service/addCommunity';
            $curlPost = 'app_key='.$deviceParams['0']['APP_KEY'].'&agt_num='.$deviceParams['0']['AGT_NUM'].'&depart_name='.$cellName['NAME'].'&city_code='.$address;
            $file_contents = Helper::curl_post1($url,$curlPost);
            if (isset($file_contents->status) && $file_contents->status == 'success') {
                $str = $file_contents->data->createsysdate;
                $createsysdate = date('Y-m-d H:i:s', substr($str,0,10));
                $request['Device']['DEPARTID'] = $file_contents->data->departid;
                $request['Device']['CREATESYSDATE'] = $createsysdate;
                $departid = $file_contents->data->departid; 
            }else{
                $msg = $file_contents->msg;
                if (isset($msg->city_code)) {
                    $msg = '安装地址格式错误';
                }
            }
        }
        if (isset($departid) && $departid) {
            $url = Yii::$app->params['device_url'].'/mdserver/service/installLock';
            $pid = $request['Device']['SERIAL_NUMBER'];
            $install_lock_name = $request['Device']['DEVICE_NAME'];
            $install_address = $request['Device']['ADDRESS'];
            $curlPost = 'app_key='.$deviceParams['0']['APP_KEY'].'&agt_num='.$deviceParams['0']['AGT_NUM'].'&pid='.$pid.'&departid='.$departid.'&install_lock_name='.$install_lock_name.'&install_address='.$install_address;
            $file_contents = Helper::curl_post1($url,$curlPost);

            $get_access_url = Yii::$app->params['get_access_url'].'?grant_type=client_credential&appid='.$wx_client_info['0']['app_id'].'&secret='.$wx_client_info['0']['ap_secret'];
            $access_result = json_decode(file_get_contents($get_access_url));
            if (isset($access_result->access_token) && $access_result->access_token) {
                $wx_url_syn = Yii::$app->params['wx_url'].'/pservice/syncDeviceService.aspx';
                $wx_url_syn_data = 'agt_num='.$deviceParams['0']['AGT_NUM'].'&app_key='.$deviceParams['0']['APP_KEY'].'&gid='.$deviceParams['0']['GID'].'&pid='.$pid.'&access_token='.$access_result->access_token;
                $wx_syn_result = Helper::curl_post1($wx_url_syn,$wx_url_syn_data);
                if (isset($wx_syn_result->status)) {
                    $status22 = $wx_syn_result->status;
                    if ($wx_syn_result->status != 'success') {
                        Yii::$app->getSession()->setFlash('error',$wx_syn_result->msg);
                        return $this->render('update',[
                                'model' => $model,
                            ]);
                    }else{
                        $request['Device']['DEVICE_ID'] = $wx_syn_result->device_id;
                    }
                }else{
                    Yii::$app->getSession()->setFlash('error','公众号配置同步失败');
                    $model->load($request);
                    return $this->render('update',[
                        'model' => $model,
                    ]);
                }

            }else{
                Yii::$app->getSession()->setFlash('error','获取access_token失败');
                $model->load($request);
                return $this->render('update',[
                        'model' => $model,
                    ]);
            }

            if (isset($file_contents->status) && $file_contents->status == 'success') {
                $model->load($request);
                $res = $model->save();
            }else{
                $msg = $file_contents->msg;
            }  

        }
        if (isset($res) && $res) {
            Yii::$app->getSession()->getFlash('success','添加成功');
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            if (isset($msg)) {
                Yii::$app->getSession()->setFlash('error', $msg);
            }
            return $this->render('update', [
                'model' => $model,
            ]);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Device model.
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
     * Finds the Device model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Device the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Device::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
