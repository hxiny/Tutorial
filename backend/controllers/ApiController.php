<?php
/**
 * Created by PhpStorm.
 * User: levi
 * Date: 2016/11/2
 * Time: 20:49
 */

namespace backend\controllers;


use app\models\Build;
use app\models\Helper;
use app\models\House;
use app\models\Park;
use app\models\ParkLink;
use app\models\User;
use app\models\UserAuth;
use app\models\UserCell;
use Yii;
use yii\base\Controller;
use yii\base\Exception;
use yii\helpers\Url;

class ApiController extends Controller
{

    public function actionTest()
    {
//        $this->daoru();
//        $this->daoruDianMian();
//        $this->daoruXiaoqu("user3.txt");
//        $this->daoruXiaoqu("user2.txt");
//        $this->daoruXiaoqu("user1.txt");
    }

    private function daoruDianMian()
    {
        $str = file_get_contents("dianmian.txt");
        $lines = explode("\r\n", $str);

        $success = 0;
        $fail = 0;
        foreach ($lines as $line) {
            try {
                $items = explode("\t", $line);
                $zhuanghao = trim($items[0]);
                if (count($items) < 2) {
                    goto a;
                }
                $fanghao = trim($items[1]);
                if (count($items) < 3) {
                    goto a;
                }
                $goufangren = trim($items[2]);
                if (!isset($goufangren)||''==$goufangren) {
                    continue;
                }
                if (count($items) < 8) {
                    goto a;
                }
                $taoNeiMianji = trim($items[7]);
            } catch (\Exception $e) {
                echo 'fail<br>';
                continue;
            }

            a:
            $build = Build::findOne(['CELL_ID' => 5, 'BUILD_NUM' => $zhuanghao]);
            if (!isset($build)) {
                echo $zhuanghao . "<br>";
                continue;
            }
            $user = User::findOne(['NICKNAME' => $goufangren]);
            if (!isset($user)) {
                $user = new User();
            }
            $user->USER_ID = Helper::getNonceStr();
            $user->NICKNAME = isset($goufangren) ? $goufangren : '未知';
            $user->PHONE = isset($dianhua) ? $dianhua : '';
            $user->REMARK = isset($beiZhu) ? $beiZhu : '';
            $user->PASSWORD = '123456';
            $userSave = $user->save();

            $house = new House();
            $house->BUILD_ID = $build->ID;
            $house->HOUSE_CODE = $fanghao;
            $house->STOREY = substr($fanghao, 0, -2);
            $house->HOUSE_TYPE = '20000';
            $house->HOUSE_AREA = $taoNeiMianji;
            $house->TOTAL_STOREY = $build->STOREY_NUM;
            Helper::setCreateTimeAndCreateUser($house);
            Helper::setUpdateTimeAndUpdateUser($house);
            $houseSave = $house->save();

            $house = House::findOne(['BUILD_ID' => $build->ID, 'HOUSE_CODE' => $fanghao]);

            $userCell = new UserCell();
            $userCell->ID = Helper::getNonceStr();
            $userCell->USER_ID = $user->USER_ID;
            $userCell->CELL_ID = $build->CELL_ID;
            $userCell->BUILD_ID = $build->ID;//#2
            $userCell->HOUSE_ID = $house->ID;
            $userCell->STATUS = '0';
            $userCellSave = $userCell->save();

            if ($userCellSave && $houseSave && $userSave&&$this->addUserAuth($user,$build)) {
                $success++;
            } else {
                $fail++;
            }
        }
        echo $success . "<br>";
        echo $fail;

    }

    private function daoru()
    {

        $str = file_get_contents("biesu.txt");
        $lines = explode("\r\n", $str);

        $success = 0;
        $fail = 0;
        foreach ($lines as $line) {
            try {
                $items = explode("\t", $line);
                $zhuanghao = trim($items[0]);
                if (count($items) < 2) {
                    goto a;
                }
                $fanghao = trim($items[1]);
                if (count($items) < 3) {
                    goto a;
                }
                $goufangren = trim($items[2]);
                if (!isset($goufangren)||''==$goufangren) {
                    continue;
                }
                if (count($items) < 4) {
                    goto a;
                }
                $taoNeiMianji = trim($items[3]);
                if (count($items) < 5) {
                    goto a;
                }
                $cheKuMianJi = trim($items[4]);
                if (count($items) < 6) {
                    goto a;
                }
                $jianZhuMianJi = trim($items[5]);

                if (count($items) < 11) {
                    goto a;
                }
                $beiZhu = trim($items[10]);
                if (count($items) < 12) {
                    goto a;
                }
                $dianhuaStr = trim($items[11]);
                preg_match("/\d{11}/", $dianhuaStr, $dianhua);
                if (count($dianhua) > 0) {
                    $dianhua = $dianhua[0];
                } else {
                    $dianhua = '';
                }
            } catch (\Exception $e) {
                echo 'fail<br>';
                continue;
            }


            a:
            $build = Build::findOne(['CELL_ID' => 5, 'BUILD_NUM' => $zhuanghao]);
            if (!isset($build)) {
                echo $zhuanghao . "<br>";
                continue;
            }
            $user = User::findOne(['NICKNAME' => $goufangren]);
            if (!isset($user)) {
                $user = new User();
            }
            $user->USER_ID = Helper::getNonceStr();
            $user->NICKNAME = isset($goufangren) ? $goufangren : '未知';
            $user->PHONE = isset($dianhua) ? $dianhua : '';
            $user->REMARK = isset($beiZhu) ? $beiZhu : '';
            $user->PASSWORD = '123456';

            $userSave = $user->save();

            $house = new House();
            $house->BUILD_ID = $build->ID;
            $house->HOUSE_CODE = $fanghao;
            $house->STOREY = substr($fanghao, 0, -2);
            $house->HOUSE_TYPE = '20000';
            $house->HOUSE_AREA = $taoNeiMianji;
            $house->TOTAL_STOREY = $build->STOREY_NUM;
            Helper::setCreateTimeAndCreateUser($house);
            Helper::setUpdateTimeAndUpdateUser($house);
            $houseSave = $house->save();

            $house = House::findOne(['BUILD_ID' => $build->ID, 'HOUSE_CODE' => $fanghao]);

            $userCell = new UserCell();
            $userCell->ID = Helper::getNonceStr();
            $userCell->USER_ID = $user->USER_ID;
            $userCell->CELL_ID = $build->CELL_ID;
            $userCell->BUILD_ID = $build->ID;//#2
            $userCell->HOUSE_ID = $house->ID;
            $userCell->STATUS = '0';
            $userCellSave = $userCell->save();

            $park = new Park();
            $park->ID = Helper::getNonceStr();
            $park->CELL_ID = $build->CELL_ID;
            $park->PARK_AREA = $cheKuMianJi;
            $park->MANAGE_USER = $user->USER_ID;
            $parkSave = $park->save();

            $parkLink = new ParkLink();
            $parkLink->ID = Helper::getNonceStr();
            $parkLink->PARK_ID = $park->ID;
            $parkLink->LINK_MAN = $user->USER_ID;
            $parkLink->LINK_PHONE = $user->PHONE;
            $parkLink->CELL_ID = $build->CELL_ID;
            $parkLink->BUILD_ID = $build->ID;
            $parkLink->HOUSE_ID = $house->ID;
            $parkLinkSave = $parkLink->save();

            if ($userCellSave && $houseSave && $userSave && $parkSave && $parkLinkSave&&$this->addUserAuth($user,$build)) {
                $success++;
            } else {
                $fail++;
            }
        }
        echo $success . "<br>";
        echo $fail;
    }

    private function daoruXiaoqu($file)
    {

        $str = file_get_contents($file);
        $lines = explode("\r\n", $str);

        $success = 0;
        $fail = 0;
        foreach ($lines as $line) {
            try {
                $items = explode("\t", $line);
                $zhuanghao = trim($items[0]);
                if (count($items) < 2) {
                    goto a;
                }
                $fanghao = trim($items[1]);
                if (count($items) < 3) {
                    goto a;
                }
                $goufangren = trim($items[2]);
                if (!isset($goufangren)||''==$goufangren) {
                    continue;
                }
                if (count($items) < 4) {
                    goto a;
                }
                $dianhuaStr = trim($items[3]);
                preg_match("/\d{11}/", $dianhuaStr, $dianhua);
                if (count($dianhua) > 0) {
                    $dianhua = $dianhua[0];
                } else {
                    $dianhua = '';
                }
                if (count($items) < 5) {
                    goto a;
                }
                $beizhu = trim($items[4]);
            } catch (\Exception $e) {
                echo 'fail<br>';
                continue;
            }


            a:
            $build = Build::findOne(['CELL_ID' => 5, 'BUILD_NUM' => $zhuanghao]);
            if (!isset($build)) {
                echo $zhuanghao . "<br>";
                continue;
            }
            $user = User::findOne(['NICKNAME' => $goufangren]);
            if (!isset($user)) {
                $user = new User();
            }
            $user->USER_ID = Helper::getNonceStr();
            $user->NICKNAME = isset($goufangren) ? $goufangren : '未知';
            $user->PHONE = isset($dianhua) ? $dianhua : '';
            $user->REMARK = isset($beizhu) ? $beizhu : '';
            $user->PASSWORD = '123456';

            $userSave = $user->save();

            $house = new House();
            $house->BUILD_ID = $build->ID;
            $house->HOUSE_CODE = $fanghao;
            $house->STOREY = substr($fanghao, 0, -2);
            $house->HOUSE_TYPE = '20000';
            $house->HOUSE_AREA = '未知';
            $house->TOTAL_STOREY = $build->STOREY_NUM;
            Helper::setCreateTimeAndCreateUser($house);
            Helper::setUpdateTimeAndUpdateUser($house);
            $houseSave = $house->save();

            $house = House::findOne(['BUILD_ID' => $build->ID, 'HOUSE_CODE' => $fanghao]);

            $userCell = new UserCell();
            $userCell->ID = Helper::getNonceStr();
            $userCell->USER_ID = $user->USER_ID;
            $userCell->CELL_ID = $build->CELL_ID;
            $userCell->BUILD_ID = $build->ID;//#2
            $userCell->HOUSE_ID = $house->ID;
            $userCell->STATUS = '0';
            $userCellSave = $userCell->save();

            if ($userCellSave && $houseSave && $userSave&&$this->addUserAuth($user,$build)) {
                $success++;
            } else {
                $fail++;
            }
        }
        echo $success . "<br>";
        echo $fail;
    }

    private function addUserAuth($user,$build)
    {
        $userAuth = new UserAuth();
        $userAuth->ID = Helper::getNonceStr();
        $userAuth->AUTH_USER = $user->USER_ID;
        $userAuth->CELL_ID = $build->CELL_ID;
        $userAuth->USER_NAME = $user->NICKNAME;
        $userAuth->AUTH_FLOW = '0';
        return $userAuth->save();
    }


}