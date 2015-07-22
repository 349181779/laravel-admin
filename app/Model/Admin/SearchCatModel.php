<?php

// +----------------------------------------------------------------------
// | date: 2015-07-14
// +----------------------------------------------------------------------
// | SearchCatModel.php: 后端新闻分类模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Admin;

use App\Model\Admin\BaseModel;

class SearchCatModel extends BaseModel {

    protected $table    = 'search_cat';//定义表名
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
                //组合是否默认
                $v->is_default = self::mergeIsDefault($v->is_default);
                //组合状态
                $v->status = self::mergeStatus($v->status);
                //组合操作
                $v->handle = '<a href="'.url('admin/search-cat/edit', [$v->id]).'" target="_blank" >编辑</a>';
            }
        }
        return $data;
    }


}
