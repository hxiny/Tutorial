<?php
/**
 * Created by PhpStorm.
 * User: yorun
 * Date: 2017/2/26
 * Time: 19:39
 */

namespace app\models;


use yii\db\ActiveQuery;
use yii\db\Query;

/**
 * @property ActiveQuery query
 */
class RelateDeleter
{
    /**
     * @param ActiveQuery $query
     * @return RelateDeleter
     */
    public static function delete(ActiveQuery $query)
    {
        $rd = new RelateDeleter();
        $rd->query = $query;
        return $rd;
    }

    /**
     * @param $with
     * @return RelateDeleter
     */
    public function with($with)
    {
        $this->query->with($with);
        return $this;
    }

}