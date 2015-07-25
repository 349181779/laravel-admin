<?php

// +----------------------------------------------------------------------
// | date: 2015-07-22
// +----------------------------------------------------------------------
// | AppModel.php: 后端App模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Admin;

use App\Model\Admin\BaseModel;

class AppModel extends BaseModel {

    protected $table    = 'app';//定义表名
    protected $guarded  = ['id'];//阻挡所有属性被批量赋值

    /**
     * 组合数据
     *
     * @param $roles
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeData($data){
        if(!empty($data)){
            foreach($data as &$v){
                //组合状态
                $v->status = self::mergeStatus($v->status);
                //组合操作
                $v->handle  = '<a href="'.url('admin/site/edit', [$v->id]).'" target="_blank" >编辑</a>';
            }
        }
        return $data;
    }

}
