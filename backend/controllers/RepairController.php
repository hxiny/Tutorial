<?php

namespace backend\controllers;

use app\models\Helper;
use app\models\TRepairAudit;
use app\models\TRepairAuditSearch;
use app\models\TRepairEvidence;
use app\models\TRepairEvidenceSearch;
use app\models\TRepairWorkNotes;
use app\models\TRepairWorkNotesSearch;
use app\models\User;
use Yii;
use app\models\TRepairNotes;
use app\models\TRepairNotesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TRepairNotesController implements the CRUD actions for TRepairNotes model.
 */
class RepairController extends Controller
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
    public function actionIndex()
    {
        $searchModel = new TRepairNotesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('notes', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Lists all TRepairNotes models.
     * @return mixed
     */
    public function actionNotes()
    {
        $searchModel = new TRepairNotesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('notes', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TRepairNotes model.
     * @param string $id
     * @return mixed
     */
    public function actionNotesView($id)
    {
        $mode = $this->findNotesModel($id);

        return $this->render('notesView', [
            'model' =>$mode,
        ]);
    }

    /**
     * Creates a new TRepairNotes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionNotesCreate()
    {
        $model = new TRepairNotes();
        Helper::setCreateTimeAndCreateUser($model);
        Helper::setUpdateTimeAndUpdateUser($model);
        $model->ID = Helper::createID();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['notes-view', 'id' => $model->ID]);
        } else {
            return $this->render('notesCreate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TRepairNotes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionNotesUpdate($id)
    {
        $model = $this->findNotesModel($id);
        Helper::setUpdateTimeAndUpdateUser($model);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        } else {
            return $this->render('notesUpdate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TRepairNotes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionNotesDelete($id)
    {
        $this->findNotesModel($id)->delete();

        return $this->redirect(['notes']);
    }

    /**
     * Finds the TRepairNotes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TRepairNotes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findNotesModel($id)
    {
        if (($model = TRepairNotes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    //--------------------------------------------------------
    /**
     * Lists all TRepairAudit models.
     * @return mixed
     */
    public function actionAudit()
    {
        $searchModel = new TRepairAuditSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('audit', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TRepairAudit model.
     * @param string $id
     * @return mixed
     */
    public function actionAuditView($id)
    {
        return $this->render('auditView', [
            'model' => $this->findAuditModel($id),
        ]);
    }

    /**
     * Creates a new TRepairAudit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAuditCreate()
    {
        $model = new TRepairAudit();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['audit-view', 'id' => $model->ID]);
        } else {
            return $this->render('auditCreate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TRepairAudit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionAuditUpdate($id)
    {
        $model = $this->findAuditModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['audit-view', 'id' => $model->ID]);
        } else {
            return $this->render('auditUpdate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TRepairAudit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionAuditDelete($id)
    {
        $this->findAuditModel($id)->delete();

        return $this->redirect(['audit']);
    }

    /**
     * Finds the TRepairAudit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TRepairAudit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findAuditModel($id)
    {
        if (($model = TRepairAudit::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /*
     * -------------------------------------------------------------------
     */

    /**
     * Lists all TRepairEvidence models.
     * @return mixed
     */
    public function actionEvidence()
    {
        $searchModel = new TRepairEvidenceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('evidence', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TRepairEvidence model.
     * @param string $id
     * @return mixed
     */
    public function actionEvidenceView($id)
    {
        return $this->render('evidenceView', [
            'model' => $this->findEvidenceModel($id),
        ]);
    }

    /**
     * Creates a new TRepairEvidence model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionEvidenceCreate()
    {
        $model = new TRepairEvidence();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['evidence-view', 'id' => $model->ID]);
        } else {
            return $this->render('evidenceCreate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TRepairEvidence model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionEvidenceUpdate($id)
    {
        $model = $this->findEvidenceModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['evidence-view', 'id' => $model->ID]);
        } else {
            return $this->render('evidenceUpdate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TRepairEvidence model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionEvidenceDelete($id)
    {
        $this->findEvidenceModel($id)->delete();

        return $this->redirect(['evidence']);
    }

    /**
     * Finds the TRepairEvidence model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TRepairEvidence the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findEvidenceModel($id)
    {
        if (($model = TRepairEvidence::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /*
     * ------------------------------------
     */

    /**
     * Lists all TRepairWorkNotes models.
     * @return mixed
     */
    public function actionWork()
    {
        $searchModel = new TRepairWorkNotesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('work', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TRepairWorkNotes model.
     * @param string $id
     * @return mixed
     */
    public function actionWorkView($id)
    {
        return $this->render('workView', [
            'model' => $this->findWorkModel($id),
        ]);
    }

    /**
     * Creates a new TRepairWorkNotes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionWorkCreate()
    {
        $model = new TRepairWorkNotes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['work-view', 'id' => $model->ID]);
        } else {
            return $this->render('workCreate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TRepairWorkNotes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionWorkUpdate($id)
    {
        $model = $this->findWorkModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['work-view', 'id' => $model->ID]);
        } else {
            return $this->render('workUpdate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TRepairWorkNotes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionWorkDelete($id)
    {
        $this->findWorkModel($id)->delete();

        return $this->redirect(['work']);
    }

    /**
     * Finds the TRepairWorkNotes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TRepairWorkNotes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findWorkModel($id)
    {
        if (($model = TRepairWorkNotes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
