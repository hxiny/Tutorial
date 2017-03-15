<?php

namespace backend\controllers;

use app\models\Helper;
use app\models\User;
use app\models\UserSearch;
use Seld\JsonLint\JsonParser;
use Symfony\Component\Console\Descriptor\JsonDescriptor;
use Yii;
use app\models\Cells;
use app\models\Build;
use app\models\House;
use app\models\Device;
use app\models\UserCell;
use app\models\DeviceUserAuth;
use app\models\Region;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\db\Query;

/**
 * LocationController implements the CRUD actions for Cells model.
 */
class LocationController extends Controller
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
                ],
            ],
        ];
    }

    /**
     * Lists all cells
     * @return mixed
     */
    public function actionCells()
    {
        $cells = Cells::find()->all();
        $cellArray = ArrayHelper::map($cells, 'ID', 'NAME');
        return json_encode($cellArray);
    }

    /**
     * Lists builds
     * @param string $cellId
     * @return mixed
     */
    public function actionBuilds($cellId)
    {
        if ($cellId) {
            $builds = Build::find()->where(['CELL_ID' => $cellId])->all();
        } else {
            $builds = Build::find()->all();
        }
        $buildArray = ArrayHelper::map($builds, 'ID', 'BUILD_NUM');
        return json_encode($buildArray);
    }

    /**
     * Lists houses
     * @param string $buildId
     * @return mixed
     */
    public function actionHouses($buildId)
    {
        $houses = House::find()->where(['BUILD_ID' => $buildId])->all();
        $houseArray = ArrayHelper::map($houses, 'ID', 'HOUSE_CODE');
        return json_encode($houseArray);
    }

    public function actionDevices($cellId)
    {
        if ($cellId) {
            $devices = Device::find()->where(['CELL_ID' => $cellId])->all();
        } else {
            $devices = Device::find()->all();
        }
        $deviceArray = ArrayHelper::map($devices, 'ID', 'DEVICE_NAME');
        return json_encode($deviceArray);
    }

    public function actionHouseusers($houseId)
    {
        if ($houseId) {
            $users = UserCell::find()->joinWith('user')->where(['HOUSE_ID' => $houseId])->asArray()->all();
        } else {
            $users = UserCell::find()->all();
        }
        $userCell = array();
        foreach ($users as $val) {
            $userCell[$val['USER_ID']] = $val['user']['NICKNAME'];
        }
        return json_encode($userCell);
    }


    public function actionAppid($companyId)
    {
        if ($companyId) {
            $cells = (new Query())
                ->select('c.*,w.app_id')
                ->from('t_cells AS c')
                ->leftJoin('wx_client_cells AS w', 'c.ID = w.cell_id')
                ->where('c.PROPERTY_ID=' . $companyId)
                ->all();
            $appidArray = ArrayHelper::map($cells, 'app_id', 'NAME');
            return json_encode($appidArray);
        }
    }

    public function actionCitys($id)
    {
        if ($id) {
            $citys = Region::find()->where(['father_id' => $id])->asArray()->all();
        } else {
            $citys = Region::find()->all();
        }
        $options = '';
        foreach ($citys as $value) {
            $options .= '<option value=' . $value['region_code'] . '>' . $value['region_name'] . '</option>';
        }
        return $options;
    }

    public function actionCountys($id)
    {
        if ($id) {
            $countys = Region::find()->where(['father_id' => $id])->asArray()->all();
        } else {
            $countys = Region::find()->all();
        }
        $options = '';
        foreach ($countys as $value) {
            $options .= '<option value=' . $value['region_code'] . '>' . $value['region_name'] . '</option>';
        }
        return $options;
    }

    public function actionUsers($name, $phone)
    {
        $search = new UserSearch();
        $data = $search->search([
            'UserSearch' => [
                'NICKNAME' => $name,
                'PHONE' => $phone,
            ]
        ]);
        $ret = [];
        $all = $data->query->all();
        foreach ($all as $item) {
            $ret[] = $item->toArray();
        }
        return json_encode($ret);
    }
}

