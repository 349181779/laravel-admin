<?php

// +----------------------------------------------------------------------
// | date: 2015-09-14
// +----------------------------------------------------------------------
// | MergeModel.php: 组合数据模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Admin;

use App\Model\Admin\Goods\Brand\BrandInfoModel;
use App\Model\Admin\Goods\Brand\GoodsBrandsModel;
use App\Model\Admin\Goods\Shop\ShopUserInfoModel;
use DB;
use \Session;
use App\Library\Image;

class MergeModel extends BaseModel
{

    private static $all_city;//全部城市
    private static $all_is_speed;//是否是下午茶或者蛋糕
    private static $freight_type;//是否免邮
    private static $is_check_email;//用户邮箱是否通过验证
    private static $is_check_mobile;//用户手机是否通过验证
    private static $pay_source;//支付方式
    private static $goods_brand_state;//商品品牌状态
    private static $state;//状态[可复用在任何只有开启和关闭的模块]
    private static $goods_brands;//全部商品品牌

    /**
     * 获取全部状态
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAllState()
    {
        if (empty(self::$state)) {
            self::$state = [
                1 => trans('response.on'),
                2 => trans('response.off'),
            ];
        }
        return self::$state;
    }

   /**
     * 组合状态
     *
     * @param $sex
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeStatus($status)
    {
        if (empty($status)) {
            return false;
        }
        $all_state = self::getAllState();

        if (array_key_exists($status, $all_state)) {
            return $all_state[$status];
        }
    }

    /**
     * 组合状态（select表单格式）
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeStateForSelect()
    {
        $all_state   = self::getAllState();
        $data        = [];

        if (!empty($all_state)) {
            foreach ($all_state as $key => $state) {
                $data[] = [
                    'id'    => $key,
                    'name'  => $state,
                ];
            }
        }
        return $data;
    }


    /**
     * 组合是否默认
     *
     * @param $sex
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeIsDefault($is_default)
    {
        if (empty($is_default)) {
            return false;
        }

        switch ($is_default) {
            case 1:
                return trans('response.is_default');
            default:
                return trans('response.not_is_default');
        }
    }

    /**
     * 获取是否是下午茶或者蛋糕
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function getAllIsSpeed()
    {
        if (empty(self::$all_is_speed)) {
            self::$all_is_speed = [
                1 => trans('response.is_speed_1'),
                2 => trans('response.is_speed_2'),
            ];
        }
        return self::$all_is_speed;
    }

    /**
     * 组合是否是下午茶或蛋糕
     *
     * @param $is_speed
     * @return string
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeIsSpeed($is_speed)
    {
        if (empty($is_speed)) {
            return false;
        }

        //获取蛋糕或者下午茶
        $all_is_speed = self::getAllIsSpeed();

        if(array_key_exists($is_speed, $all_is_speed)){
            return $all_is_speed[$is_speed];
        }
    }

    /**
     * 组合是否是下午茶或蛋糕（select表单格式）
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeIsSpeedForSelect()
    {
        //获取蛋糕或者下午茶
        $all_is_speed   = self::getAllIsSpeed();
        $data           = [];

        if (!empty($all_is_speed)) {
            foreach ($all_is_speed as $key => $is_speed) {
                $data[] = [
                    'id'    => $key,
                    'name'  => $is_speed,
                ];
            }
        }
        return $data;
    }

    /**
     * 获取是否免邮类型
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function getAllFreightType()
    {
        if (empty(self::$freight_type)){
            self::$freight_type = [
                1 => trans('response.is_freight_1'),
                2 => trans('response.is_freight_2'),
            ];
        }
        return self::$freight_type;
    }

    /**
     * 组合是否免邮
     *
     * @param $is_freight
     * @return string
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeIsFreight($is_freight)
    {
        if (empty($is_freight)) {
            return false;
        }

        //获取是否免邮类型
        $all_Freight_type = self::getAllFreightType();

        if (array_key_exists($is_freight, $all_Freight_type)) {
            return $all_Freight_type[$is_freight];
        }
    }

    /**
     * 组合是否免邮(select)
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeIsFreightForSelect()
    {
        //获取是否免邮类型
        $all_freight_type   = self::getAllFreightType();
        $data               = [];

        if (!empty($all_freight_type)) {
            foreach ($all_freight_type as $key => $freight_type) {
                $data[] = [
                    'id'    => $key,
                    'name'  => $freight_type,
                ];
            }
        }
        return $data;
    }


    /**
     * 组合用户信息
     *
     * @param $user_id
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeUser($user_id)
    {
        if (empty($user_id)) {
            return $user_id;
        }
        $loginname =  DB::table('user_info')->where('id', '=', $user_id)->pluck('loginname');

        if(empty($loginname)){
            return trans('response.empty');
        }

        return $loginname;
    }

    /**
     * 组合是否急速配送
     *
     * @param $is_speed
     * @return string
     * @Author: linye <linye102@163.com>
     */
    public static function mergeIsHighSpeed($is_speed)
    {
        if (empty($is_speed)) {
            return $is_speed;
        }

        switch ($is_speed) {
            case 1:
                return trans('response.is_high_speed_1');
            case 2:
                return trans('response.is_high_speed_2');
        }
    }

    /**
     * 组合是否默认
     *
     * @param $is_state
     * @return string
     * @Author: linye <linye102@163.com>
     */
    public static function mergeIsState($is_state)
    {
        if (empty($is_state)) {
            return $is_state;
        }

        switch ($is_state) {
            case 1:
                return trans('response.is_state_1');
            case 2:
                return trans('response.is_state_2');
        }
    }

    /**
     * 组合账户明细状态
     *
     * @param $state
     * @return string
     * @Author: linye <linye102@163.com>
     */
    public static function mergeBillState($state)
    {
        if (empty($state)) {
            return $state;
        }

        switch ($state) {
            case 1:
                return trans('response.bill_state_1');
            case 2:
                return trans('response.bill_state_2');
            case 3:
                return trans('response.bill_state_3');
        }
    }

    /**
     * 获得全部城市
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAllCity()
    {
        if (empty(self::$all_city)) {
            self::$all_city = config('config.city_ids');
        }
        return self::$all_city;
    }


    /**
     * 组合城市
     *
     * @param $city_id
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeCity($city_id)
    {
        if (empty($city_id)) {
            return false;
        }

        //获得全部城市
        $all_city = self::getAllCity();

        if (array_key_exists($city_id, $all_city)) {
            return $all_city[$city_id];
        }
        return false;
    }


    /**
     * 获得全部城市（生成select数据格式）
     *
     * @return array
     */
    public static function getAllCityForSelect()
    {
        //获取全部城市
        $all_city   = self::getAllCity();
        $data       = [];

        if (!empty($all_city)) {
            foreach ($all_city as $key => $city) {
                $data[] = [
                    'id'    => $key,
                    'name'  => $city,
                ];
            }
        }
        return $data;
    }

    /**
     * 获得全部配送员站点（生成select数据格式）
     *
     * @return array
     */
    public static function getAllDeliveryStationSelect()
    {
        //获取全部城市
        $all_station   = StationModel::select('id', 'station_name')->get();
        $data          = [];

        if (!empty($all_station)) {
            foreach ($all_station as $staion) {
                $data[] = [
                    'id'    => $staion->id,
                    'name'  => $staion->station_name,
                ];
            }
        }
        return $data;
    }

    /**
     * 通过站点id获得全部配送员站点
     *
     * @return array
     */
    public static function getDeliveryStationById($id)
    {
        //获取全部城市
        $station_name   = DB::table('sys_station')->
                         where('id', '=', $id)->
                         pluck('station_name');

        return $station_name;
    }

    /**
     * 获得配送员姓名
     *
     * @return array
     */
    public static function getDeliveryUserName($delivery_id)
    {
        $delivery_name   = DB::table('delivery_user_info')->where('id', '=', $delivery_id)->pluck('name');

        if (empty($delivery_name)) {
            return $delivery_id;
        }
        return $delivery_name;
    }

    /**
     * 操作人员列表
     *
     * @author zhuweijian<zhueweijian@louxia100.com>
     */
    public static function adminLogAdminName()
    {
        $roles = AdminInfoModel::multiwhere(['state'=>1])->lists('admin_name','id') ;
        if (!empty($roles)) {
            $data = [];
            foreach ($roles as $k =>$v) {
                $data[] = [
                    'id'    => $k,
                    'name'  => $v,
                ];
            }
        }
        return $data;
    }

    /**
     * 获取全部支付类型
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function getAllPaySource()
    {
        if (empty(self::$pay_source)) {
            self::$pay_source = [
                1 => trans('response.pay_source_1'),
                2 => trans('response.pay_source_2'),
                3 => trans('response.pay_source_3'),
                4 => trans('response.pay_source_4'),
                5 => trans('response.pay_source_5'),
                6 => trans('response.pay_source_6'),
                7 => trans('response.pay_source_7'),
            ];
        }
        return self::$pay_source;
    }



    /**
     * 组合支付方式
     *
     * @param $data
     * @return mixed
     * @Author: linye <linye102@163.com>
     */
    public static function mergeUserpaySource($source)
    {
        if(empty($source)){
            return $source;
        }

        //获取全部支付类型
        $all_pay_source = self::getAllPaySource();

        if (array_key_exists($source, $all_pay_source)) {
            return $all_pay_source[$source];
        }
    }

    /**
     * 组合支付类型 【select】
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergePaySourceForSelect()
    {
        //获取全部支付类型
        $all_pay_source = self::getAllPaySource();
        $data           = [];

        if (!empty($all_pay_source)) {
            foreach ($all_pay_source as $k => $pay_source) {
                $data[] = [
                    'id'    => $k,
                    'name'  => $pay_source,
                ];
            }
        }

        return $data;
    }

    /**
     * 组合会员邮箱是否已经验证
     *
     * @param $data
     * @return mixed
     * @Author: linye <linye102@163.com>
     */
    private static function MergeIsCheckUserEmail()
    {
        if (empty(self::$is_check_email)) {
            self::$is_check_email = [
                1 => trans('response.is_check_user_email_1'),
                2 => trans('response.is_check_user_email_2'),
            ];
        }
        return self::$is_check_email;

    }

    /**
     * 组合会员邮箱是否已经验证（select表单格式）
     *
     * @return array
     * @author linye <linye102@163.com>
     */
    public static function mergeIsCheckUserEmailForSelect()
    {
        //获取验证是否通过
        $all_is_check_email   = self::MergeIsCheckUserEmail();
        $data                 = [];

        if (!empty($all_is_check_email)) {
            foreach ($all_is_check_email as $key => $is_check_email) {
                $data[] = [
                    'id'    => $key,
                    'name'  => $is_check_email,
                ];
            }
        }
        return $data;
    }

    /**
     * 组合会员手机是否已经验证
     *
     * @param $data
     * @return mixed
     * @Author: linye <linye102@163.com>
     */
    private static function MergeIsCheckUserMobile()
    {
        if (empty(self::$is_check_mobile)) {
            self::$is_check_mobile = [
                1 => trans('response.is_check_user_mobile_1'),
                2 => trans('response.is_check_user_mobile_2'),
            ];
        }
        return self::$is_check_mobile;

    }

    /**
     * 组合会员邮箱是否已经验证（select表单格式）
     *
     * @return array
     * @author linye <linye102@163.com>
     */
    public static function mergeIsCheckUserMobileForSelect()
    {
        //获取验证是否通过
        $all_is_check_mobile   = self::MergeIsCheckUserMobile();
        $data                  = [];

        if (!empty($all_is_check_mobile)) {
            foreach ($all_is_check_mobile as $key => $is_check_mobile) {
                $data[] = [
                    'id'    => $key,
                    'name'  => $is_check_mobile,
                ];
            }
        }
        return $data;
    }

    /**
     * 组合列表页图片
     *
     * @param $image_name
     * @param int $source
     * @param int $image_type
     * @return string
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeImage($image_name, $source = 1, $image_type = 1)
    {
        return '<img src="'.Image::getImageRealPath($image_name,$source, $image_type).'" style="width:100px;height:100px;" data-src="'.$image_name.'" title="'.$image_name.'" />';
    }

    /**
     * 全部品牌 select
     *
     * @author linye <linye102@163.com>
     */
    public static function getAllGoodsBrandsSelect(){

        $all_goods_brands = BrandInfoModel::select('id', 'brand_name')->where('state', '=', '1')->get();
        $data             = [];

        if (!empty($all_goods_brands)) {
            foreach ($all_goods_brands as $brands) {
                $data[] = [
                    'id'    => $brands->id,
                    'name'  => $brands->brand_name,
                ];
            }
        }
        return $data;
    }

    /**
     * 全部门店 select
     *
     * @author linye <linye102@163.com>
     */
    public static function getAllShopSelect(){

        $all_shop = DB::table('lx_shop')->select('id', 'shop_name')->where('state', '=', '1')->get();
        $data             = [];

        if (!empty($all_shop)) {
            foreach ($all_shop as $shops) {
                $data[] = [
                    'id'    => $shops->id,
                    'name'  => $shops->shop_name,
                ];
            }
        }
        return $data;
    }

}

