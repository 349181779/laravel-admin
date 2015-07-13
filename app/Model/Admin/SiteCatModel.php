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
     * 获得全部文章分类
     *
     * @return array
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAll(){
        //加载函数库
        load_func('common');
        return merge_tree_node(obj_to_array(self::mergeData(self::all())));
    }

    /**
     * 组合数据
     *
     * @return mixed
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeData($data){
        if(!empty($data)){
            foreach($data as &$v){
                //组合pid
                $v->pid_name = $v->pid == 0 ? trans('response.top_classification') : self::where('id', '=', $v->pid)->pluck('cat_name');
                //组合状态
                $v->status = self::mergeStatus($v->status);
                //组合操作
                $v->handle = '<a href="'.url('admin/site-cat/edit', [$v->id]).'" target="_blank" >编辑</a>';
            }
        }
        return $data;
    }


}
