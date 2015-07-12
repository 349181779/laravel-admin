<?php

// +----------------------------------------------------------------------
// | date: 2015-07-11
// +----------------------------------------------------------------------
// | SiteModel.php: 后端用户模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Home;

use App\Model\Home\BaseModel;

use DB;

class IndexModel extends BaseModel {

    protected $table    = 'site_cat';//定义表名
    protected $guarded  = ['*'];//阻挡所有属性被批量赋值

    /**
     * 获得首页网址分类和分类下面的网址
     *
     * @return mixed
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAllSite(){
       $all_site_cat = self::mergeData(self::where('status', '=', '1')->orderBy('sort', 'desc')->paginate(config('config.page_limit')));
       return $all_site_cat;
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
                //组合状态
                $v->status = self::mergeStatus($v->status);
                //组合操作
                $v->site  = DB::table('site')->where('site_cat_id', '=', $v->id)->where('status', '=', 1)->orderBy('sort', 'desc')->get();
            }
        }
        return $data;
    }

}
