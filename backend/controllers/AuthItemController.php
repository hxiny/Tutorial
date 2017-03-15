<?php

namespace backend\controllers;

use Yii;
use app\models\AuthItem;
use app\models\AuthItemSearch;
use app\models\AuthItemChild;
use app\models\Menu;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * AuthItemController implements the CRUD actions for AuthItem model.
 */
class AuthItemController extends Controller
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
     * Lists all AuthItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthItem model.
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
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthItem();
        $request = Yii::$app->request->post();
        if (isset($request['AuthItem'])) {
            $request['AuthItem']['type'] = '1';
            $request['AuthItem']['created_at'] = time();
            $request['AuthItem']['updated_at'] = time();
            if ($request['AuthItem']['rule_name'] == '') {
                $request['AuthItem']['rule_name'] = null;
            }
            if ($request['AuthItem']['data'] == '') {
                $request['AuthItem']['data'] = null;
            }
        }

        if ($model->load($request) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $request = Yii::$app->request->post();
        if (isset($request['AuthItem'])) {
            $request['AuthItem']['updated_at'] = time();
            if ($request['AuthItem']['rule_name'] == '') {
                $request['AuthItem']['rule_name'] = null;
            }
            if ($request['AuthItem']['data'] == '') {
                $request['AuthItem']['data'] = null;
            }
        }

        if ($model->load($request) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AuthItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        AuthItemChild::deleteAll(['parent' => $id]);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionManage($id)
    {
        $model = $this -> findModel($id);

        $childExist = AuthItemChild::find()->where(['parent' => $id])->andWhere(['like', 'child', 'index'])->asArray()->all();
        $childExistArr = array();
        foreach ($childExist as $val) {
            $childExistArr[] = $val['child'];
        }
        $menuExist = Menu::find()->where(['route' => $childExistArr])->asArray()->all();
        $menuExistArr = ArrayHelper::map($menuExist, 'id', 'route');
        $model['menu'] = $menuExistArr;

        $request = Yii::$app->request->post();
        if (isset($request['AuthItem'])) {
            // print_r($model['menu']);
            // print_r($request['AuthItem']['menu']);
            // die();
            $pattern = "/index/i";
            if (empty($model['menu'])) {
                $model['menu'] = array();
            }
            if (empty($request['AuthItem']['menu'])) {
                $request['AuthItem']['menu'] = array();
            }
            $deleteArray = array_diff($model['menu'], $request['AuthItem']['menu']);
            $addArray = array_diff($request['AuthItem']['menu'], $model['menu']);
            if (!empty($addArray)) {
                foreach ($addArray as $val) {
                    $str = preg_replace($pattern, '', $val);
                    $AuthItem = AuthItem::find()->where(['like', 'name', $str]) -> asArray() -> all();
                    foreach ($AuthItem as $arr) {
                        $authItemChild = new AuthItemChild();
                        $authItemChild['parent'] = $model['name'];
                        $authItemChild['child'] = $arr['name'];
                        $authItemChild->save();
                    }
                }
            }
            if (!empty($deleteArray)) {
                foreach ($deleteArray as $val) {
                    $str = preg_replace($pattern, '', $val);
                    $AuthItemChildExist = AuthItemChild::find()-> where(['parent' => $id]) ->andWhere(['like', 'child', $str])->asArray()->all(); 
                    foreach ($AuthItemChildExist as $value) {
                        AuthItemChild::deleteAll($value);
                    }
                }
            }

            $childExist = AuthItemChild::find()->where(['parent' => $id])->andWhere(['like', 'child', 'index'])->asArray()->all();
            $childExistArr = array();
            foreach ($childExist as $val) {
                $childExistArr[] = $val['child'];
            }
            $menuExist = Menu::find()->where(['route' => $childExistArr])->asArray()->all();
            $menuExistArr = ArrayHelper::map($menuExist, 'id', 'route');
            $model['menu'] = $menuExistArr;

        }

        return $this->render('manage',[
            'model' => $model,
        ]);
    }

}
