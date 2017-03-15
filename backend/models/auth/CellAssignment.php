<?php
/**
 * Created by PhpStorm.
 * User: yorun
 * Date: 2017/1/18
 * Time: 14:00
 */

namespace app\models\auth;


use app\models\AuthAssignmentCell;
use app\models\Cells;
use app\models\DropListHelper;
use backend\controllers\AuthAssignmentCellController;
use mdm\admin\components\Helper;
use mdm\admin\models\Assignment;
use Yii;

class CellAssignment extends Assignment
{
    public function assign($cellId, $items)
    {
        $success = 0;
        foreach ($items as $name) {
            try {
                $authAssignmentCell = new AuthAssignmentCell();
                $authAssignmentCell->cell_id = $cellId;
                $authAssignmentCell->item_name = $name;
                $authAssignmentCell->user_id = $this->id;
                if ($authAssignmentCell->save()) {
                    $success++;
                }
            } catch (\Exception $exc) {
                Yii::error($exc->getMessage(), __METHOD__);
            }
        }
        Helper::invalidate();
        return $success;
    }
    public function revoke($cellId,$items)
    {
        $success = 0;
        foreach ($items as $name) {
            try {
                AuthAssignmentCell::find()->where(['item_name' => $name])->one()->delete();
                $success++;
            } catch (\Exception $exc) {
                Yii::error($exc->getMessage(), __METHOD__);
            }
        }
        Helper::invalidate();
        return $success;
    }
    public function getItems()
    {
        $cells = Cells::find()->all();
        $manager = Yii::$app->getAuthManager();
        $avaliable = [];
        $array_keys = array_keys($manager->getRoles());
        foreach ($array_keys as $name) {
            $avaliable[$name] = 'role';
        }

        foreach (array_keys($manager->getPermissions()) as $name) {
            if ($name[0] != '/') {
                $avaliable[$name] = 'permission';
            }
        }
        $ret = [];
        foreach ($cells as $cell) {
            $assigned = [];
            $cellAvaliable = $avaliable;
            $assignment = AuthAssignmentCell::find()->where(['user_id' => $this->id, 'cell_id' => $cell->ID])->all();
            foreach ($assignment as $item) {
                $assigned[$item->item_name] = $avaliable[$item->item_name];
                unset($cellAvaliable[$item->item_name]);
            }
            $ret[$cell['ID']] = [
                'avaliable' => $cellAvaliable,
                'assigned' => $assigned
            ];
        }
//        var_dump($ret);
        return $ret;
    }
}