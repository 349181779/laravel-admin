<?php

// +----------------------------------------------------------------------
// | date: 2015-07-12
// +----------------------------------------------------------------------
// | QueryModel.php: 前台查询工具模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Home;

use App\Model\Home\BaseModel;

use DB;

class QueryModel extends BaseModel {

    protected $table    = 'query_cat';//定义表名
    protected $guarded  = ['*'];//阻挡所有属性被批量赋值

    /**
     * 获得首页网址分类和分类下面的网址
     *
     * @return mixed
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAllSite(){
       return self::mergeData(self::where('status', '=', '1')->orderBy('sort', 'desc')->take(11)->get());
    }

    /**
     * 组合数据
     *
     * @param $roles
     * @return mixed
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeData($data){
        if(!empty($data)){
            foreach($data as &$v){
                //组合操作
                $v->query  = DB::table('query')->where('query_cat_id', '=', $v->id)->where('status', '=', 1)->orderBy('sort', 'desc')->take(10)->get();
            }
        }
        return $data;
    }

}
