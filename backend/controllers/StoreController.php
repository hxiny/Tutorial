<?php

namespace backend\controllers;

use app\models\Cells;
use app\models\Helper;
use app\models\Holder;
use app\models\TStoreCell;
use app\models\TStoreGoods;
use app\models\TStoreGoodsSearch;
use app\models\TStoreType;
use app\models\TStoreTypeCell;
use app\models\TStoreTypeSearch;
use app\models\Utils;
use Yii;
use app\models\TStore;
use app\models\TStoreSearch;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TStoreController implements the CRUD actions for TStore model.
 * 商家管理
 *  -商家分类
 *  -商家信息
 *  -商品管理
 */
class StoreController extends Controller
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
     * Lists all TStore models.
     * @return mixed
     */
    public function actionStore()
    {
        $searchModel = new TStoreSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $holder = new Holder();
        if ($holder->load(Yii::$app->request->post())) {
            $searchModel->batchDelete($holder->getBatchDeleteIds());
        }
        return $this->render('store', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'holder' => $holder
        ]);
    }

    /**
     * Displays a single TStore model.
     * @param string $id
     * @return mixed
     */
    public function actionStoreView($id)
    {
        return $this->render('storeView', [
            'model' => $this->findStoreModel($id),
        ]);
    }

    /**
     * Creates a new TStore model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionStoreCreate()
    {
        $model = new TStore();
        $cell = new Cells();
        Helper::setCreateTimeAndCreateUser($model);
        Helper::setUpdateTimeAndUpdateUser($model);
        $model->ID = Helper::createID();
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $cell->load(Yii::$app->request->post()) && $cell->validate(['ID'])) {
            if (!Utils::upload($model, 'PIC_URL')) {
                goto a;
            }
            $storeCell = new TStoreCell();
            $storeCell->CELL_ID = $cell->ID;
            $storeCell->STORE_ID = $model->ID;
            $storeCell->ID = Helper::createID();
            if ($model->save() && $storeCell->save()) {
                return $this->redirect(['store-view', 'id' => $model->ID]);
            }
            goto a;
        } else {
            a:
            return $this->render('storeCreate', [
                'model' => $model,
                'cell' => $cell,
            ]);
        }
    }

    /**
     * Updates an existing TStore model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionStoreUpdate($id)
    {
        $model = $this->findStoreModel($id);
        $cell = new Cells();
        Helper::setUpdateTimeAndUpdateUser($model);
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $cell->load(Yii::$app->request->post()) && $cell->validate(['ID'])) {
            //todo 目前小区不是多选
            if (!Utils::upload($model, 'PIC_URL')) {
                goto a;
            }
            TStoreCell::deleteAll(['STORE_ID' => $model->ID]);
            $storeCell = new TStoreCell();
            $storeCell->CELL_ID = $cell->ID;
            $storeCell->STORE_ID = $model->ID;
            $storeCell->ID = Helper::createID();
            if ($model->save() && $storeCell->save()) {
                return $this->redirect(['store-view', 'id' => $model->ID]);
            }
            goto a;
        } else {
            a:
            return $this->render('storeUpdate', [
                'model' => $model,
                'cell' => $cell,
            ]);
        }

    }

    /**
     * Deletes an existing TStore model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionStoreDelete($id)
    {
        TStore::linkDelete($id);
        return $this->redirect(['store']);
    }

    /**
     * Finds the TStore model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TStore the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findStoreModel($id)
    {
        $model = TStoreSearch::find()->alias('s')->
        select('s.*,c.NAME as CELL_NAME')
            ->leftJoin('t_store_cell as sc', 's.ID=sc.STORE_ID')
            ->leftJoin('t_cells as c', 'c.ID=sc.CELL_ID')
            ->where(['s.ID' => $id])->one();
        if ($model !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    //--------------------------------
    /**
     * Lists all TStoreType models.
     * @return mixed
     */
    public function actionStoreType()
    {
        $searchModel = new TStoreTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('storeType', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TStoreType model.
     * @param string $id
     * @return mixed
     */
    public function actionStoreTypeView($id)
    {
        $storeTypeCell = TStoreTypeCell::findOne(['STORE_TYPE_ID' => $id]);
        if (!isset($storeTypeCell)) {
            $storeTypeCell = new TStoreTypeCell();
        }
        $model = $this->findStoreTypeModel($id);
        return $this->render('storeTypeView', [
            'model' => $model,
            'storeTypeCell' => $storeTypeCell,
        ]);
    }

    /**
     * Creates a new TStoreType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionStoreTypeCreate()
    {
        $model = new TStoreType();
        $model->ID = Helper::createID();
        $storeTypeCell = new TStoreTypeCell();
        $storeTypeCell->ID = Helper::createID();
        $storeTypeCell->STORE_TYPE_ID = $model->ID;
        if ($model->load(Yii::$app->request->post()) && $storeTypeCell->load(Yii::$app->request->post())
            && Helper::doTransaction(function () use ($model, $storeTypeCell) {
                return $model->save() && $storeTypeCell->save();
            })
        ) {
            return $this->redirect(['store-type-view', 'id' => $model->ID]);
        } else {
            return $this->render('storeTypeCreate', [
                'model' => $model,
                'storeTypeCell' => $storeTypeCell,
            ]);
        }
    }

    /**
     * Updates an existing TStoreType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionStoreTypeUpdate($id)
    {
        $model = $this->findStoreTypeModel($id);
        $storeTypeCell = TStoreTypeCell::findOne(['STORE_TYPE_ID' => $id]);
        if (!isset($storeTypeCell)) {
            $storeTypeCell = new TStoreTypeCell();
        }
        if ($model->load(Yii::$app->request->post()) && $storeTypeCell->load(Yii::$app->request->post())
            && Helper::doTransaction(function () use ($model, $storeTypeCell) {
                return $model->save() && $storeTypeCell->save();
            })
        ) {
            return $this->redirect(['store-type-view', 'id' => $model->ID]);
        } else {
            return $this->render('storeTypeUpdate', [
                'model' => $model,
                'storeTypeCell' => $storeTypeCell,
            ]);
        }
    }

    /**
     * Deletes an existing TStoreType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionStoreTypeDelete($id)
    {
        TStoreType::linkDelete($id);
        return $this->redirect(['store-type']);
    }

    /**
     * Finds the TStoreType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TStoreType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findStoreTypeModel($id)
    {
        if (($model = TStoreType::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    //-------------------------------------------------------------------------------------

    /**
     * Lists all TStoreGoods models.
     * @return mixed
     */
    public function actionStoreGoods()
    {
        $searchModel = new TStoreGoodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('storeGoods', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TStoreGoods model.
     * @param string $id
     * @return mixed
     */
    public function actionStoreGoodsView($id)
    {
        $TStoreGoods = $this->findStoreGoodsModel($id);
        return $this->render('storeGoodsView', [
            'model' => $TStoreGoods,
        ]);
    }

    /**
     * Creates a new TStoreGoods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionStoreGoodsCreate()
    {
        $model = new TStoreGoods();
        $model->ID = Helper::createID();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['store-goods-view', 'id' => $model->ID]);
        } else {
            return $this->render('storeGoodsCreate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TStoreGoods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionStoreGoodsUpdate($id)
    {
        $model = $this->findStoreGoodsModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['store-goods-view', 'id' => $model->ID]);
        } else {
            return $this->render('storeGoodsUpdate', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TStoreGoods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionStoreGoodsDelete($id)
    {
        $this->findStoreGoodsModel($id)->delete();
        return $this->redirect(['store-goods']);
    }

    /**
     * Finds the TStoreGoods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TStoreGoods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findStoreGoodsModel($id)
    {
        if (($model = TStoreGoods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
