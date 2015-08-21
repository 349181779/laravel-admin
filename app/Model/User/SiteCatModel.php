<?php

// +----------------------------------------------------------------------
// | date: 2015-08-09
// +----------------------------------------------------------------------
// | SiteCatModel.php: 会员网址分类模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\User;

use App\Model\Admin\BaseModel;

class SiteCatModel extends BaseModel {

    protected $table    = 'user_site_cat';//定义表名
    protected $guarded  = ['id'];//阻挡所有属性被批量赋值

    /**
     * 获得全部文章分类--无限极分类（编辑菜单时选项）
     *
     * @descript  递归组合无限极分类，为了编辑页面和增加页面select 展示
     * @param $name 表单name名称
     * @param $id 当前id
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAllForSchemaOption($name, $id = 0, $first = true){
        //加载函数库
        load_func('common');
        $data = $id > 0 ? merge_tree_node(obj_to_array(self::where('id', '<>' , $id)->where('user_info_id', '=', is_user_login())->where('deleted_at', '=', '0000-00-00 00:00:00')->get())) : merge_tree_node(obj_to_array(self::where('user_info_id', '=', is_user_login())->get()));
        $first == true && array_unshift($data, ['id' => '0', $name => '顶级分类']);
        return $data;
    }


}
