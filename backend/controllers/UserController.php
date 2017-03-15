<?php

namespace backend\controllers;

use app\models\Helper;
use app\models\UserAuth;
use app\models\UserCell;
use app\models\Utils;
use app\models\WxUserInfo;
use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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

    public function actionBindWx($id)
    {
//        $this->findModel($id);
        $model = new WxUserInfo();

        return $this->render('wxBindForm', [
            'model' => $model,
        ]);
    }

    public function actionUserAuth($id)
    {
        $userAuth = UserAuth::findOne(['AUTH_USER' => $id]);
        if (isset($userAuth)) {
            $this->redirect(['user-auth/update', 'id' => $userAuth->ID]);
        } else {
            $this->redirect(['user/Index', 'from' =>1]);
        }
    }

    public function actionCellIn($id)
    {
        $this->redirect(['user-cell/create', 'userId' => $id]);
    }
    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex($from=0)
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'from'=>$from
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        Helper::setCreateTimeAndCreateUser($model);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->USER_ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->USER_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::find()->with('userClient.wxInfo')

                ->with('userCells.cell', 'userCells.house', 'userCells.build')
                ->where(['USER_ID' => $id])->one()) !==
            null
        ) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
