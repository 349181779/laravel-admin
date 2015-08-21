<?php

// +----------------------------------------------------------------------
// | date: 2015-07-11
// +----------------------------------------------------------------------
// | SiteCatModel.php: 后端网址分类模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Admin;

use App\Model\Admin\BaseModel;

class SiteCatModel extends BaseModel {

    protected $table    = 'site_cat';//定义表名
    protected $guarded  = ['id'];//阻挡所有属性被批量赋值

    /**
     * 组合数据
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeData($data){
        if(!empty($data)){
            foreach($data as &$v){
                //组合状态
                $v->status = self::mergeStatus($v->status);
                //组合is_show_search
                $v->is_show_search = self::mergeStatus($v->is_show_search);
                //组合操作
                $v->handle = '<a href="'.url('admin/site-cat/edit', [$v->id]).'" target="_blank" >编辑</a>';
                $v->handle  .= ' | ';
                $v->handle  .= '<a onclick="del(this,\''.url('admin/site-cat/delete', [$v->id]).'\')" target="_blank" >删除</a>';
            }
        }
        return $data;
    }


}
