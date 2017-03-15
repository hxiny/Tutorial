<?php

namespace backend\controllers;

use app\models\Helper;
use Yii;
use app\models\OwnerBill;
use app\models\PayRecord;
use app\models\PayProject;
use app\models\DropListHelper;
use app\models\Deposit;
use app\models\BillSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * CheckoutController implements the CRUD actions for Cells model.
 */
class CheckoutController extends Controller
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
     * Lists all bills 
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BillSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'projectArray' => DropListHelper::pay_project_str()
        ]);
    }

    /**
     * Displays a single Cells model.
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
     * Creates a new Cells model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OwnerBill();
        $payProjectModel = new PayProject();
        $allCells = DropListHelper::auth_cell_str();

        if ($model->load(Yii::$app->request->post()) && $payProjectModel->load(Yii::$app->request->post()) ) {
            $curLoginUserName = Yii::$app->user->identity->username;
            $curTime = Helper::get_cur_time_format();
            $model->CREATE_TIME = $curTime;
            $model->BILL_ID = $this->makeBillId();
            $model->PAY_STATUS = OwnerBill::PAY_STATUS_WAIT_PAID;
            $payProjects = Yii::$app->request->post()['PayProject'];
            $projectsIds = $payProjects['PROJECT_ID'];
            $projectsAmountArr = $payProjects['PAY_AMOUNT'];
            $totalAmount = 0;
            foreach ($projectsIds as $key => $value) {
                if ($value) {
                    $projectModel = new PayProject();
                    $projectModel->PROJECT_ID = $value;
                    $projectModel->PAY_AMOUNT = floatval($projectsAmountArr[$key]);
                    $totalAmount += $projectsAmountArr[$key];
                    $projectModel->BILL_ID = $model->BILL_ID;
                    $projectModel->save();
                }
            }
            $model->PAY_AMOUNT = $totalAmount;
            $model->save();
            //$payProjectModel->PAY_AMOUNT = floatval($model->PAY_AMOUNT);
            //$payProjectModel->BILL_ID = $model->BILL_ID;
            //$payProjectModel->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'payProjectModel' => $payProjectModel,
                'cells' => $allCells 
            ]);
        }
    }

    /**
     * Updates an existing Cells model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $curLoginUserName = Yii::$app->user->identity->username;
        $curTime = Helper::get_cur_time_format();

        $allCells = DropListHelper::cell_str();

        $model = $this->findModel($id);
        $payProjectModel = new PayProject();
        $projectsArr = PayProject::find()->where(['BILL_ID' => $id])->all();
        $projectsArr = ArrayHelper::map($projectsArr, 'PROJECT_ID', 'PAY_AMOUNT');

        if ($model->load(Yii::$app->request->post()) && $payProjectModel->load(Yii::$app->request->post()) ) {
            $model->save();
            $payProjectModel->PAY_AMOUNT = floatval($model->PAY_AMOUNT);
            $payProjectModel->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'payProjectModel' => $payProjectModel,
                'payProjectsArr' => $projectsArr,
                'cells' => $allCells
            ]);
        }
    }

    /**
     * Deletes an existing Cells model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->STATUS = 1;
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * 预存款
     *
     * @return mixed
     */
    public function actionDeposit()
    {
        $model = new Deposit();
        $allCells = DropListHelper::cell_str();

        if ($model->load(Yii::$app->request->post())) {
            $curLoginUserName = Yii::$app->user->identity->username;
            $curTime = Helper::get_cur_time_format();
            $deposit = Deposit::find()->where(['USER_ID' => $model->USER_ID])->one();
            $model->UPDATE_TIME = $curTime;
            $model->UPDATE_USER = $curLoginUserName;
            if ($deposit) {
                $deposit->AMOUNT += $model->AMOUNT;
                $deposit->save();
            } else {
                $model->CREATE_TIME = $curTime;
                $model->CREATE_USER = $curLoginUserName;
                $model->save();
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('deposit', [
                'model' => $model,
                'cells' => $allCells
            ]);
        }
    }

    /**
     * 收款 
     *
     * @return mixed
     */
    public function actionPay($billid)
    {
        $model = new PayRecord();
        $bill = $this->findModel($billid);
        $model->BILL_ID = $billid;
        $depositAmount = 0;
        $deposit = Deposit::find()->where(['USER_ID' => $bill->PAY_ACCOUNT])->one();
        if ($deposit) {
            $depositAmount = ArrayHelper::getValue($deposit, 'AMOUNT');
        }
        if ($model->load(Yii::$app->request->post())) {
            $curLoginUserName = Yii::$app->user->identity->username;
            $curTime = Helper::get_cur_time_format();
            $bill->PAY_STATUS = OwnerBill::PAY_STATUS_HAS_PAID;
            $bill->save();
            $model->PAY_TIME = $curTime;
            $model->PAY_USER = $bill->PAY_USER;
            $model->save();
            if ($deposit) {
                $deposit->AMOUNT = $depositAmount > $bill->PAY_AMOUNT ? $depositAmount - $bill->PAY_AMOUNT : 0;
                $deposit->UPDATE_USER = $curLoginUserName;
                $deposit->UPDATE_TIME = $curTime;
                $deposit->save();
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('pay', [
                'model' => $model,
                'billModel' => $bill,
                'depositAmount' => $depositAmount
            ]);
        }
    }

    /**
     * Finds the Bill model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return House the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OwnerBill::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * 生成账单编号
     */
    protected function makeBillId()
    {
        return 'LHS_' . date('ymd').substr(time(),-5).substr(microtime(),2,5);
    }
}
