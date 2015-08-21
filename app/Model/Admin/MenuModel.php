<?php

// +----------------------------------------------------------------------
// | date: 2015-06-06
// +----------------------------------------------------------------------
// | MenuModel.php: 后端菜单模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Admin;

use App\Model\Admin\BaseModel;

class MenuModel extends BaseModel {

    protected $table    = 'menu';//定义表名
    protected $guarded  = ['id'];//阻挡所有属性被批量赋值

    /**
     * 获得全部文章分类
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAll(){
        //加载函数库
        load_func('common');
        return merge_tree_node(obj_to_array(self::mergeData(self::where('deleted_at', '=', '0000-00-00 00:00:00')->get())));
    }

    /**
     * 组合数据
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeData($data){
        if(!empty($data)){
            foreach($data as &$v){
                //组合pid
                $v->pid_name = $v->pid == 0 ? trans('response.top_classification') : self::where('id', '=', $v->pid)->pluck('menu_name');
                //组合状态
                $v->status = self::mergeStatus($v->status);
                //组合操作
                $v->handle = '<a href="'.url('admin/menu/edit', [$v->id]).'" target="_blank" >编辑</a>';
                $v->handle  .= ' | ';
                $v->handle  .= '<a onclick="del(this,\''.url('admin/menu/delete', [$v->id]).'\')" target="_blank" >删除</a>';
            }
        }
        return $data;
    }

    /**
     * 获得全部菜单--递归（左侧菜单显示）
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAllForMenuSide(){
        //加载函数库
        load_func('common');
        return merge_tree_child_node(obj_to_array(self::all()));
    }
}
