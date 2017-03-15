<?php

namespace backend\controllers;

use Yii;
use app\models\PayTamplate;
use app\models\PayTamplateSearch;
use app\models\PayFormula;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * PayTamplateController implements the CRUD actions for PayTamplate model.
 */
class PayTamplateController extends Controller
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
     * Lists all PayTamplate models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PayTamplateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PayTamplate model.
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
     * Creates a new PayTamplate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PayTamplate();
        $request = Yii::$app->request->post();
        $formulas = PayFormula::find()->asArray()->all();
        $formulaTypes = ArrayHelper::map($formulas, 'formula_id', 'formula_name');

        if (isset($request['PayTamplate'])) {
            $request['PayTamplate']['formula_types'] = implode(',', $request['PayTamplate']['formula_types']);
        }

        if ($model->load($request) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->tamplate_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'formulaTypes' => $formulaTypes,
            ]);
        }
    }

    /**
     * Updates an existing PayTamplate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->formula_types = explode(',', $model->formula_types);

        $request = Yii::$app->request->post();
        $formulas = PayFormula::find()->asArray()->all();
        $formulaTypes = ArrayHelper::map($formulas, 'formula_id', 'formula_name');


        if (isset($request['PayTamplate'])) {
            $request['PayTamplate']['formula_types'] = implode(',', $request['PayTamplate']['formula_types']);
        }

        if ($model->load($request) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->tamplate_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'formulaTypes' => $formulaTypes,
            ]);
        }
    }

    /**
     * Deletes an existing PayTamplate model.
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
     * Finds the PayTamplate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PayTamplate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PayTamplate::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
