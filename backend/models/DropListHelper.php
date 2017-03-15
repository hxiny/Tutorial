<?php
/**
 * Created by PhpStorm.
 * User: levi
 * Date: 2016/11/3
 * Time: 21:43
 */

namespace app\models;


use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\db\Query;

class DropListHelper
{


    public static function store_type_cell_status_dictionary_arr()
    {
        return self::dictionary_arr('store_type_cell_status');
    }
    /**
     * 查询Dictionary  map其中CODE和NAME 字段
     * @param $typeName TYPE_NAME 字段的名称
     * @return array
     */
    public static function dictionary_arr($typeName)
    {
        $types = Dictionary::find()->where(['TYPE_NAME' => $typeName])->orderBy("SORT")->all();

        $array = ArrayHelper::map($types, 'CODE', 'NAME');

        return $array;
    }
    public static function attribute($model,$attr, $arr)
    {
        $value='未知';
        if (key_exists($model->$attr, $arr)) {
            $value= $arr[$model->$attr];
        }
        return [
            'attribute' => $attr,
            'value' =>$value
        ];
    }

    /**
     * 用于drop类型的字段  结合GridView使用
     * @param $attr $属性
     * @param $arr $可选值
     * @return array
     */
    public static function column($attr, $arr)
    {
        return ['attribute' => $attr,
            'filter' => $arr,
            'content' => function ($model, $key, $index, $column) use ($attr, $arr) {
                if (key_exists($model->$attr, $arr)) {
                    return $arr[$model->$attr];
                }
                return '未知';
            }
        ];
    }

    public static function repair_project_arr()
    {
        return self::dictionary_arr("repair_project");
    }
    public static function repair_notes_status_arr()
    {
        return ['1' => '已报修', '0' => '未报修'];
    }

    public static function goods_status_arr()
    {
        return ['1' => '上架', '0' => '下架'];
    }

    public static function goods_status($status)
    {
        $array = self::goods_status_arr();
        if (key_exists($status, $array)) {
            return $array[$status];
        }
        return "未知";
    }

    public static function cell_type_str()
    {
        $cellTypes = Dictionary::find()->where(['TYPE_NAME' => 'cell_type'])->all();

        $cellArray = ArrayHelper::map($cellTypes, 'CODE', 'NAME');

        return $cellArray;
    }

    public static function get_cell_type($typeCode)
    {
        $cellArray = self::cell_type_str();

        if (key_exists($typeCode, $cellArray)) {
            return $cellArray[$typeCode];
        }

        return "未知";
    }

    public static function company_str()
    {
        $companies = CompanyInfo::find()->all();

        $companyArray = ArrayHelper::map($companies, 'ID', 'NAME');

        return $companyArray;
    }

    public static function user_auth_flow_arr()
    {
//        认证流程：0:->物业认证，1->业主认证->物业认证
        return [
            '0'=>'物业认证',
            '1'=>'业主认证',
            '2'=>'物业认证',
        ];
    }
    public static function user_auth_flow($key)
    {
        return self::user_auth_flow_arr()[$key];
    }
    /**
     * 房屋状态
     * @return array
     */
    public static function user_cell_status_arr()
    {
        //房屋状态(0:待业主审核，1:代物业审核，2:迁入，3:迁出)
//        return self::dictionary_arr('user_cell_status');
        return [
            '0'=>'待业主审核',
            '1'=>'代物业审核',
            '2'=>'迁入',
            '3'=>'迁出',
        ];
    }
    public static function user_cell_status($status)
    {
        return self::user_cell_status_arr()[$status];
    }
    public static function store_type_tr()
    {
        $storeType = TStoreType::find()->all();
        $storeTypeArray = ArrayHelper::map($storeType, 'ID', 'TYPE_NAME');
        return $storeTypeArray;
    }

    public static function get_store_type($id)
    {
        $array = self::store_type_tr();
        if (key_exists($id, $array)) {
            return $array[$id];
        }
        return "未知";
    }

    public static function store_str()
    {
        $model = TStore::find()->all();
        $array = ArrayHelper::map($model, 'ID', 'NAME');
        return $array;
    }

    public static function get_store($id)
    {
        $array = self::store_str();
        if (key_exists($id, $array)) {
            return $array[$id];
        }
        return "未知";
    }

    public static function get_company($companyId)
    {
        $companyArray = self::company_str();

        if (key_exists($companyId, $companyArray)) {
            return $companyArray[$companyId];
        }

        return "未知";
    }

    public static function boolean_str()
    {
        $booleans = Dictionary::find()->where(['TYPE_NAME' => 'boolean'])->all();

        $booleanArray = ArrayHelper::map($booleans, 'CODE', 'NAME');

        return $booleanArray;
    }

    public static function get_boolean($status)
    {
        $array = self::boolean_str();

        if (key_exists($status, $array)) {
            return $array[$status];
        }

        return "未知";
    }

    public static function cell_str()
    {
        $cells = Cells::find()->all();

        $cellArray = ArrayHelper::map($cells, 'ID', 'NAME');

        return $cellArray;
    }

    public static function get_cell($cellId)
    {
        $array = self::cell_str();

        if (key_exists($cellId, $array)) {
            return $array[$cellId];
        }
        return "未知";
    }
    public static function auth_cell_str()
    {
        $cells = Cells::find()->all();

        $cellArray = ArrayHelper::map($cells, 'ID', 'NAME');

        return ArrayHelper::filter($cellArray,Utils::authCells());
    }
    public static function build_str()
    {
        $builds = Build::find()->all();

        $buildArray = ArrayHelper::map($builds, 'ID', 'BUILD_NUM');

        return $buildArray;
    }

    public static function get_build($buildId)
    {
        $array = self::build_str();

        if (key_exists($buildId, $array)) {
            return $array[$buildId];
        }

        return "未知";
    }

    public static function house_str()
    {
        $houses = House::find()->all();

        $houseArray = ArrayHelper::map($houses, 'ID', 'HOUSE_CODE');

        return $houseArray;
    }

    public static function get_house($houseId)
    {
        $array = self::house_str();

        if (key_exists($houseId, $array)) {
            return $array[$houseId];
        }

        return "未知";
    }

    public static function bill_pay_str()
    {
        $billPayTypes = Dictionary::find()->where(['TYPE_NAME' => 'bill_pay_type'])->orderBy("SORT")->all();

        $payTypeArray = ArrayHelper::map($billPayTypes, 'CODE', 'NAME');

        return $payTypeArray;
    }

    public static function get_bill_pay($payCode)
    {
        $array = self::bill_pay_str();

        if (key_exists($payCode, $array)) {
            return $array[$payCode];
        }

        return "未知";
    }

    public static function pay_status_str()
    {
        $payStatus = Dictionary::find()->where(['TYPE_NAME' => 'pay_status'])->orderBy("SORT")->all();

        $payStatusArray = ArrayHelper::map($payStatus, 'CODE', 'NAME');

        return $payStatusArray;
    }

    public static function get_pay_status($status)
    {
        $array = self::pay_status_str();
        $status = intval($status);
        if (key_exists($status, $array)) {
            return $array[$status];
        }

        return "未知";
    }
    /**
     * 用户审核列表下来状态列表
     */
    public static function user_auth_status_str()
    {
        // 物业
        return ['0' => '未审核', '1' => '业主已审核', '2' => '通过', '3'=>'未通过'];
        // 业主
//            return ['0' => '未审核0', '1' => '通过1', '2' => '物业通过2','3'=>'未通过3'];
    }

    public static function get_user_auth_status($status)
    {
        $array = self::user_auth_status_str();

        if (key_exists($status, $array)) {
            return $array[$status];
        }

        return "未知";
    }
    public static function user_str()
    {
        $users = User::find()->where([])->all();

        $users = ArrayHelper::map($users, 'USER_ID', 'NICKNAME');

        return $users;
    }

    public static function pay_project_str()
    {
        $payProjects = Dictionary::find()->where(['TYPE_NAME' => 'pay_project'])->orderBy("SORT")->all();

        $payProjectsArray = ArrayHelper::map($payProjects, 'CODE', 'NAME');

        return $payProjectsArray;
    }

    public static function get_pay_project($billId)
    {
        $payProject = PayProject::find()->where(['BILL_ID' => $billId])->all();
        if ($payProject) {
            $array = self::pay_project_str();
            $payProjectsArray = ArrayHelper::map($payProject, 'PROJECT_ID', 'PAY_AMOUNT');
            $projectsSets = [];
            foreach ($payProjectsArray as $key => $value) {
                if (key_exists($key, $array)) {
                    $projectsSets[] = $array[$key] . ':' . $value;
                }
            }
            return implode('<br/>', $projectsSets);
        }

        return "未知";
    }

    public static function pay_type_str()
    {
        $payStatus = Dictionary::find()->where(['TYPE_NAME' => 'payment_type'])->orderBy("SORT")->all();

        $payStatusArray = ArrayHelper::map($payStatus, 'CODE', 'NAME');

        return $payStatusArray;
    }
    /*
     * 获取用户名称
     */
    public static function nickname_str()
    {
        $user = User::find()->all();

        $userArray = ArrayHelper::map($user, 'USER_ID', 'NICKNAME');

        return $userArray;
    }
    public static function get_user($userId)
    {
        $array = self::nickname_str();

        if (key_exists($userId, $array)) {
            return $array[$userId];
        }

        return "未知";
    }
    public static function house_type_str()
    {
        $houseType = Dictionary::find()->where(['TYPE_NAME' => 'HOUSE_TYPE'])->orderBy("SORT")->all();

        $houseTypeArray = ArrayHelper::map($houseType, 'CODE', 'NAME');

        return $houseTypeArray;
    }

    public static function orientation_str()
    {
        $orientation = Dictionary::find()->where(['TYPE_NAME' => 'orientation'])->orderBy("SORT")->all();

        $orientationArray = ArrayHelper::map($orientation, 'CODE', 'NAME');

        return $orientationArray;
    }

    /*
     * 获取设备审核状态
     */
    public static function device_audit_status_str()
    {
        $audit_status = Dictionary::find()->where(['TYPE_NAME' => 'audit'])->orderBy("SORT")->all();

        $auditStatusArray = ArrayHelper::map($audit_status, 'CODE', 'NAME');

        return $auditStatusArray;
    }
    /*
     * 获取设备审核状态
     */
    public static function get_device_audit_status_str($audit_status)
    {
        $auditStatusArray = self::device_audit_status_str();

        if (key_exists($audit_status, $auditStatusArray)) {
            return $auditStatusArray[$audit_status];
        }
        return "未知";
    }

    public static function identity()
    {
        $arr = Dictionary::find()->where(['TYPE_NAME' => 'house_identity'])->orderBy("SORT")->all();
        $arr = ArrayHelper::map($arr, 'CODE', 'NAME');
        return $arr;
    }


    /*
     * 获取机构名称
     */
    public static function system_organization_str()
    {
        $organization = SystemOrganization::find()->all();

        $organizationArray = ArrayHelper::map($organization, 'organization_id', 'organization_name');

        return $organizationArray;
    }

    /*
     * 获取角色名称
     */
    public static function system_role_str()
    {
        $role = SystemRole::find()->all();

        $roleArray = ArrayHelper::map($role, 'role_id', 'role_name');

        return $roleArray;
    }

    /*
     * 获取系统用户
     */
    public static function system_user_str()
    {
        $user = SystemUser::find()->all();

        $userArray = ArrayHelper::map($user, 'id', 'username');

        return $userArray;
    }

     /*
     * 获取公众号
     */
    public static function wx_client_info_str()
    {
        $wxName = WxClientInfo::find()->all();

        $wxNameArray = ArrayHelper::map($wxName, 'app_id', 'name');

        return $wxNameArray;
    }

     /*
     * 通过用户获取楼栋
     */
    public static function user_build_num_str($userId)
    {

        $query = new Query();
        $user = $query
                -> select('u.*, b.BUILD_NUM')
                -> from('t_user_cell AS u')
                -> leftJoin('t_build AS b', 'b.ID = u.BUILD_ID')
                -> where(['USER_ID' => $userId])
                -> one();
        $userBuild = $user['BUILD_NUM'];
        return $userBuild;
    }

     /*
     * 通过用户获取房屋
     */
    public static function user_house_code_str($userId)
    {

        $query = new Query();
        $user = $query
                -> select('u.*, h.HOUSE_CODE')
                -> from('t_user_cell AS u')
                -> leftJoin('t_house AS h', 'h.ID = u.HOUSE_ID')
                -> where(['USER_ID' => $userId])
                -> one();
        $userHouse = $user['HOUSE_CODE'];
        return $userHouse;
    }

    /*
     * 获取设备名称
     */
    public static function device_name_str()
    {
        $device = Device::find()->all();

        $deviceArray = ArrayHelper::map($device, 'DEVICE_ID', 'DEVICE_NAME');

        return $deviceArray;
    }

    public static function advertis_cell($ID)
    {
        $query = new Query();
        $cells = $query
                    -> select('a.*, c.NAME')
                    -> from('t_advertis_cell AS a')
                    -> leftJoin('t_cells AS c', 'c.ID = a.CELL_ID')
                    -> where(['a.ADVERTIS_ID' => $ID])
                    -> one();
        if (isset($cells['NAME'])) {
              return $cells['NAME'];   
          }else{
            return '未设置';
          }
    }

    /*
     * 获取短信模板变量
     */
    public static function sms_variable()
    {
        $formula = SmsFormulaData::find()->all();

        $formulaArray = ArrayHelper::map($formula, 'id', 'variable_name');

        return $formulaArray;
    }

    /*
     * 获取短信模板变量
     */
    public static function sms_configuration()
    {
        $sms = SystemSmsConfiguration::find()->all();

        $smsArray = ArrayHelper::map($sms, 'id', 'configuration_name');

        return $smsArray;
    }

}
