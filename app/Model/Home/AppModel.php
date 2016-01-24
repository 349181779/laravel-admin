<?php

// +----------------------------------------------------------------------
// | date: 2015-07-25
// +----------------------------------------------------------------------
// | AppModel.php: 前台App模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Home;

use DB;

class AppModel extends BaseModel {

    protected $table    = 'app_cat';//定义表名
    protected $guarded  = ['*'];//阻挡所有属性被批量赋值

    /**
     * 获得首页网址分类和分类下面的网址
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAllApp(){
       return self::mergeData(self::where('status', '=', '1')->where('deleted_at', '=', '0000-00-00 00:00:00')->orderBy('sort', 'ASC')->paginate(config('config.page_limit')));
    }

    /**
     * 组合数据
     *
     * @param $roles
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeData($data, $limit = 30){
        if(!empty($data)){
            foreach($data as &$v){
                //组合操作
                $v->app  = DB::table('app')->where('app_cat_id', '=', $v->id)->where('status', '=', 1)->where('deleted_at', '=', '0000-00-00 00:00:00')->orderBy('sort', 'ASC')->take($limit)->get();
            }
        }
        return $data;
    }

    /**
     * 获得当前分类下面全部app
     *
     * @param $cat_id
     * @return mixed
     */
    public static function getCategory($cat_id){
        if(!empty($cat_id)){
            $cat_info           = new \stdClass();
            $cat_info->cat_info = DB::table('app_cat')->select('cat_name', 'id')->where('deleted_at', '=', '0000-00-00 00:00:00')->where('id', '=', $cat_id)->first();
            $cat_info->all_app  = DB::table('app')->where('app_cat_id', '=', $cat_id)->where('status', '=', '1')->where('deleted_at', '=', '0000-00-00 00:00:00')->orderBy('sort', 'ASC')->paginate(config('config.page_limit'));
            return $cat_info;
        }
    }

}
