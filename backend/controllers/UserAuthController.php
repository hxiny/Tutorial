<?php

namespace backend\controllers;

use app\models\User;
use app\models\UserCell;
use Yii;
use app\models\UserAuth;
use app\models\UserAuthSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserAuthController implements the CRUD actions for UserAuth model.
 */
class UserAuthController extends Controller
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
     * Lists all UserAuth models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserAuthSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserAuth model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model=UserAuth::find()->with('user.userClient.wxInfo')->with('cell')
            ->where(['ID'=>$id])->one();
        //用户该小区所有的房屋审核信息
        $userCells=UserCell::find()->with('build.area')->with('house')->where(['USER_ID'=>$model->AUTH_USER,
            'CELL_ID'=>$model->CELL_ID])
            ->all();
        return $this->render('view', [
            'model' => $model,
            'userCells' => $userCells,
        ]);
    }

    /**
     * Creates a new UserAuth model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserAuth();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserAuth model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        // todo 读取用户详细信息
//        $searchModel = new UserAuthSearch();
//        $dataProvider = $searchModel->search(["UserAuthSearch"=>['ID'=>$id]]);
//        $model = $this->findModel($id);
        $model=UserAuth::find()->with('user')->with('cell')->where(['ID'=>$id])->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            $userCells=UserCell::find()->with('build.area')->with('house')->where(['USER_ID'=>$model->AUTH_USER,
                'CELL_ID'=>$model->CELL_ID])
                ->all();

            return $this->render('update', [
                'model' => $model,
                'userCells' => $userCells,
//                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Deletes an existing UserAuth model.
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
     * Finds the UserAuth model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return UserAuth the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
//        if (($model = UserAuth::findOne($id)) !== null) {
        if (($model = UserAuth::find()
                -> where(['ID'=>$id])
                ->one()
            ) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
