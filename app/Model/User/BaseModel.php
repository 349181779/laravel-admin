<?php

// +----------------------------------------------------------------------
// | date: 2015-08-02
// +----------------------------------------------------------------------
// | BaseModel.php: 公共模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;

use DB;

use Session;

class BaseModel extends Model{

    /**
     * 获得全部文章分类--无限极分类（编辑菜单时选项）
     *
     * @descript  递归组合无限极分类，为了编辑页面和增加页面select 展示
     * @param $name 表单name名称
     * @param $id 当前id
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAllForSchemaOption($name, $id = 0){
        //加载函数库
        load_func('common');
        $data = $id > 0 ? merge_tree_node(obj_to_array(self::where('id', '<>' , $id)->get())) : merge_tree_node(obj_to_array(self::all()));
        array_unshift($data, ['id' => '0', $name => '顶级分类']);
        return $data;
    }

    /**
     * 获得搜索导航数据
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getSearch(){
        return self::mergeSearch(DB::table('search_cat')->where('status', '=', 1)->orderBy('sort', 'ASC')->get());
    }

    /**
     * 组合搜索导航数据
     *
     * @param $data
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeSearch($data){
        if(!empty($data)){
            foreach($data as &$v){
                $v->al_query = DB::table('search')->where('search_cat_id', '=', $v->id)->where('status', '=', 1)->get();
            }
        }
        return $data;
    }

    /**
     * 获得全部分类
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getAllCategory(){
        //加载函数库
        load_func('common');
        $data = obj_to_array(self::all());
        $data =  array_to_obj(merge_tree_child_node($data));
        return $data;
    }

    /**
     * 获得用户等级
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function DegreeOfCompletion(){
        //加载函数库
        load_func('common');

        //获得用户详细信息
        $data = DB::table('user_profile')->where('user_info_id', '=', is_user_login())->first();

        $total = 0;

        if(!empty($data->mobile)){
            $total += 10;
        }
        if(!empty($data->truename)){
            $total += 10;
        }
        if(!empty($data->sex)){
            $total += 10;
        }
        if(!empty($data->id_card)){
            $total += 10;
        }
        if(!empty($data->marriage)){
            $total += 10;
        }

        if($total >= 50){
            Session::put('user_info.level', '2');
        }

        Session::put('user_info.level', '1');
        Session::save();
    }
}

