<?php

// +----------------------------------------------------------------------
// | date: 2015-08-08
// +----------------------------------------------------------------------
// | IndexModel.php: 用户首页模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\User;

use App\Model\User\BaseModel;

use DB;

class IndexModel extends BaseModel {

    protected $table    = 'user_site_cat';//定义表名
    protected $guarded  = ['*'];//阻挡所有属性被批量赋值

    /**
     * 获得首页网址分类和分类下面的网址
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAllSite(){
        //加载函数库
        load_func('common');
       return self::mergeData(self::where('user_info_id', '=', is_user_login())->where('status', '=', '1')->where('deleted_at', '=', '0000-00-00 00:00:00')->orderBy('sort', 'ASC')->paginate(20));
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
                $v->site  = DB::table('user_site')->where('user_site_cat_id', '=', $v->id)->where('status', '=', 1)->where('deleted_at', '=', '0000-00-00 00:00:00')->orderBy('sort', 'ASC')->take($limit)->get();
            }
        }
        return $data;
    }

    /**
     * 获得当前分类下面全部网址
     *
     * @param $cat_id
     * @return mixed
     */
    public static function getCategorySite($cat_id){
        if(!empty($cat_id)){
            $cat_info           = new \stdClass();
            $cat_info->cat_info = DB::table('user_site_cat')->select('cat_name', 'id')->where('id', '=', $cat_id)->where('deleted_at', '=', '0000-00-00 00:00:00')->first();
            $cat_info->all_site = DB::table('user_site')->where('user_site_cat_id', '=', $cat_id)->where('status', '=', '1')->where('deleted_at', '=', '0000-00-00 00:00:00')->orderBy('sort', 'ASC')->paginate(50);
            return $cat_info;
        }
    }


}
