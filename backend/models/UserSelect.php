<?php
/**
 * Created by PhpStorm.
 * User: yorun
 * Date: 2017/2/22
 * Time: 20:52
 */

namespace app\models;


use yii\base\Model;

class UserSelect extends Model
{

    public $NAME;
    public $PHONE;

    public function rules()
    {
        return [
            [['NAME', 'PHONE'] ,'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'NAME' => '姓名',
            'PHONE' => '手机',

        ]; // TODO: Change the autogenerated stub
    }

}