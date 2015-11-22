<?php

// +----------------------------------------------------------------------
// | date: 2015-09-21
// +----------------------------------------------------------------------
// | AdminLimitModel.php: 后台角色模型
// +----------------------------------------------------------------------
// | Author: zhuweijian <zhuweijain@louxia100.com>
// +----------------------------------------------------------------------

namespace App\Model\Admin\Admin;

use \DB;

class AdminLimitModel extends BaseModel {

    protected $table    = 'admin_limit';//定义表名
    protected $guarded  = ['id'];//阻挡所有属性被批量赋值

    /**
     * 搜索
     *
     * @param $map
     * @param $sort
     * @param $order
     * @param $offset
     * @return mixed
     * Author: zhuweijian <zhuweijain@louxia100.com>
     */
    protected static function search($map, $sort, $order, $limit, $offset)
    {

        return [
            'data' =>   self::mergeData(
                self::multiwhere($map)->
                orderBy($sort, $order)->
                skip($offset)->
                take($limit)->
                get()
            ),
            'count' =>  self::multiwhere($map)->count(),
        ];
    }


    /**
     * 组合数据
     *
     * @param $data
     * @return mixed
     * @Author: zhuweijian <zhuweijain@louxia100.com>
     */
    public static function mergeData($data)
    {
        if (!empty($data)) {
            foreach ($data as &$v) {
                //组合操作
                $v->handle      = '<a href="'.createUrl('Admin\Admin\AdminFunctionController@getLimitFunc',['limit_id' => $v->id]).'"  >配置权限</a>';
                $v->handle      .= '<span>|</span>';
                $v->handle      .= '<a href="'.createUrl('Admin\Admin\AdminMenuController@getLimitMenu',['limit_id' => $v->id]).'"  >配置菜单</a>';
                $v->handle      .= '<span>|</span>';
                $v->handle      .= '<a href="'.createUrl('Admin\Admin\AdminInfoController@getIndex',['id' => $v->id]).'" >查看成员</a>';
                $v->handle      .= '<span>|</span>';
                $v->handle      .= '<a href="'.createUrl('Admin\Admin\AdminLimitController@getEdit',['id' => $v->id]).'"  >修改</a>';
            }
        }
        return $data;
    }

}

