<?php
namespace app\models\auth;

use app\models\AuthAssignmentCell;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\rbac\Item;

/**
 * Created by PhpStorm.
 * User: yorun
 * Date: 2017/1/18
 * Time: 10:26
 */
class DbManager extends \yii\rbac\DbManager
{

    public function getRolesByUser($userId)
    {
        if (!isset($userId) || $userId === '') {
            return [];
        }
        $query = (new Query)->select('a.cell_id, b.*')
            ->from(['a' => $this->assignmentTable, 'b' => $this->itemTable])
            ->where('{{a}}.[[item_name]]={{b}}.[[name]]')
            ->andWhere(['a.user_id' => (string)$userId])
            ->andWhere(['b.type' => Item::TYPE_ROLE]);
        $roles = [];
        foreach ($query->all($this->db) as $row) {
//            $roles[$row['name']] = $this->populateItem($row);
//            $roles['cell_id'] =$row['cell_id'] ;
            $roles[] = [
                $row['name'] => $this->populateItem($row),
                'cell_id' => $row['cell_id'],
            ];
        }
        return $roles;
    }
}