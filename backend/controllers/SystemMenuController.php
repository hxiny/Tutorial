<?php

namespace backend\controllers;

use Yii;
use app\models\SystemMenu;
use app\models\SystemMenuSearch;
use app\models\PublicModuleCell;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * SystemMenuController implements the CRUD actions for SystemMenu model.
 */
class SystemMenuController extends Controller
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
     * Lists all SystemMenu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SystemMenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SystemMenu model.
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
     * Creates a new SystemMenu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SystemMenu();
        $request = Yii::$app->request->post();
        $cells = (new Query())->select('ID,NAME')->from('t_cells')->all();
        $cellArray = ArrayHelper::map($cells, 'ID', 'NAME');

        if (isset($request['SystemMenu'])) {
            $moduleId = $request['SystemMenu']['ID'];
            foreach ($request['SystemMenu']['CELL_ID'] as $cellId) {
                $result = PublicModuleCell::find()->where(['MODULE_ID' => $moduleId, 'CELL_ID' => $cellId])->asArray()->all();
                if (empty($result)) {
                    $pwc = new PublicModuleCell();
                    $pwc['MODULE_ID']=$moduleId;
                    $pwc['CELL_ID']=$cellId;
                    $pwc['STATUS']='1';
                    $res=$pwc->save();
                }
            }
        }

        if ($model->load($request) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'cells' => $cellArray,
            ]);
        }
    }

    /**
     * Updates an existing SystemMenu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $request = Yii::$app->request->post();
        $cells = (new Query())->select('ID,NAME')->from('t_cells')->all();
        $cellArray = ArrayHelper::map($cells, 'ID', 'NAME');
        $cellExist = (new Query())->select('ID,CELL_ID')->from('t_public_module_cell')->where(['MODULE_ID'=>$id])->all();
        $cellExistArray = ArrayHelper::map($cellExist, 'ID', 'CELL_ID');
        $model->CELL_ID=$cellExistArray;   

        if (isset($request['SystemMenu'])) {
            $moduleId = $request['SystemMenu']['ID'];
            foreach ($request['SystemMenu']['CELL_ID'] as $cellId) {
                $result = PublicModuleCell::find()->where(['MODULE_ID' => $moduleId, 'CELL_ID' => $cellId])->asArray()->all();
                if (empty($result)) {
                    $pwc = new PublicModuleCell();
                    $pwc['MODULE_ID']=$moduleId;
                    $pwc['CELL_ID']=$cellId;
                    $pwc['STATUS']='1';
                    $res=$pwc->save();
                }
            }
        }     
                        
        if ($model->load($request) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'cells' => $cellArray,
            ]);
        }
    }

    /**
     * Deletes an existing SystemMenu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $res= (new PublicModuleCell())->deleteAll('MODULE_ID=:moduleId',array(':moduleId'=>$id));
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SystemMenu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SystemMenu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SystemMenu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
