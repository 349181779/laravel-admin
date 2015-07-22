<?php

// +----------------------------------------------------------------------
// | date: 2015-07-04
// +----------------------------------------------------------------------
// | BaseModel.php: 公共模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;

use DB;

class BaseModel extends Model{


    /**
     * 搜索
     *
     * @param $map
     * @param $sort
     * @param $order
     * @param $offset
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    protected static function search($map, $sort, $order, $limit, $offset){
        return [
            'data' => self::mergeData(
                self::multiwhere($map)->
                orderBy($sort, $order)->
                skip($offset)->
                take($limit)->
                get()
            ),
            'count' => self::multiwhere($map)->count(),
        ];
    }

    /**
     * 多条件查询where
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function scopeMultiwhere($query, $arr){
        if (!is_array($arr)) {
            return $query;
        }
        foreach ($arr as $key => $value) {
            //判断$arr
            if(is_array($value)){
                $value[0] = strtolower($value[0]);
                switch(strtolower($value[0])){
                    case 'like';
                        $query = $query->where($key, $value[0] ,$value[1]);
                        break;
                    case 'in':
                        $query = $query->whereIn($key, $value[1]);
                        break;
                    case 'between':
                        $query = $query->whereBetween($key, $value[1][0], $value[1][1]);
                        break;
                }
            }else{
                $query = $query->where($key, $value);
            }
        }
        return $query;
    }

    /**
     * 组合性别
     *
     * @param $sex
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    protected static function mergeUserSex($sex){
        if(empty($sex)){
            return;
        }
        switch($sex){
            case 1:
                return trans('response.sex_1');
            case 2:
                return trans('response.sex_2');
            default:
                return trans('response.sex_3');
        }
    }

    /**
     * 组合状态
     *
     * @param $sex
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    protected static function mergeStatus($status){
        if(empty($status)){
            return;
        }
        switch($status){
            case 1:
                return trans('response.on');
            default:
                return trans('response.off');
        }
    }

    /**
     * 组合图片路径
     *
     * @param $image_src
     * @param $image_type
     * @return string
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    protected static function mergeImagePath($image_src, $image_type = 1){
        return config('config.file_url').$image_src;
    }

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
     * 打印最后一条执行sql
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getLastSql(){
        $sql = DB::getQueryLog();
        $query = end($sql);
        return $query;
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
}

