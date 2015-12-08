<?php

// +----------------------------------------------------------------------
// | date: 2015-09-14
// +----------------------------------------------------------------------
// | MergeModel.php: 组合数据模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Admin;

class MergeModel extends BaseModel
{
    private     static $pay_source  = null;//支付方式
    protected   static $bed_type    = null;//床类型
    protected   static $all_state   = null;//状态

    /**
     * 获得全部状态
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAllStatus()
    {
        if (empty(self::$all_state)) {
            self::$all_state = [
                1 => trans('response.on'),
                2 => trans('response.off'),
            ];
        }
        return self::$all_state;
    }


    /**
     * 组合当前状态
     *
     * @param $status
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeStatus($status)
    {
        if (empty($status)) {
            return false;
        }
        //获取全部状态
        $all_status = static::getAllStatus();

        if (array_key_exists($status, $all_status)) {
            return $all_status[$status];
        }
    }

    /**
     * 组合状态(select)
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeStatusForSelect()
    {
        //获取全部状态
        $all_status         = static::getAllStatus();
        $data               = [];

        if (!empty($all_status)) {
            foreach ($all_status as $key => $status) {
                $data[] = [
                    'id'    => $key,
                    'name'  => $status,
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
            ];
        }
        return self::$pay_source;
    }

    /**
     * 组合支付方式
     *
     * @param $data
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
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
     * 获得全部使用状态
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAllUseState()
    {
        if (empty(self::$all_state)) {
            self::$all_state = [
                1 => trans('response.use'),
                2 => trans('response.not_use'),
            ];
        }
        return self::$all_state;
    }

}

