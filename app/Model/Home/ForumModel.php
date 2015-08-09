<?php

// +----------------------------------------------------------------------
// | date: 2015-08-08
// +----------------------------------------------------------------------
// | ForumModel.php: 前台查新闻模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Home;

use App\Model\Home\BaseModel;

use DB;

class ForumModel extends BaseModel {

    protected $table    = 'forum_cat';//定义表名
    protected $guarded  = ['*'];//阻挡所有属性被批量赋值

    /**
     * 获得首页论坛分类
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getIndexCat(){
       return self::where('status', '=', '1')->where('is_show', '=', 1)->orderBy('sort', 'ASC')->take(11)->get();
    }

    /**
     * 获得当前分类下面全部网址
     *
     * @param $cat_id 论坛分类id
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAllForums($cat_id){
        return DB::table('forum')->where('forum_cat_id', '=', $cat_id)->where('status', '=', '1')->orderBy('id', 'DESC')->orderBy('sort', 'ASC')->paginate(20);
    }
}
