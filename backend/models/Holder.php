<?php
/**
 * Created by PhpStorm.
 * User: yorun
 * Date: 2016/12/24
 * Time: 15:26
 */

namespace app\models;


use yii\base\Model;

class Holder extends Model
{

    public $delete_ids;

    public function rules()
    {
        return [
            [['delete_ids'], 'string', 'max' => 1000],
        ];
    }

    public function getBatchDeleteIds()
    {
        return explode(',',$this->delete_ids);
    }
}