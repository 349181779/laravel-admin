<?php

// +----------------------------------------------------------------------
// | date: 2015-07-15
// +----------------------------------------------------------------------
// | SearchModel.php: 前台搜索模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Home;

use App\Model\Home\BaseModel;

use DB;

class SearchModel extends BaseModel {

    protected $table    = 'search_cat';//定义表名
    protected $guarded  = ['*'];//阻挡所有属性被批量赋值

    /**
     * 获得当前搜索分类下面的全部信息
     *
     * @param $search_cat_id
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getSearchInfo($search_cat_id){
        $search_cat = self::select('cat_name', 'logo', 'id')->where('id', '=', $search_cat_id)->where('status', '=', 1)->first();
        //获得当前分类下面的全部搜索导航
        $search_cat['all_search'] = DB::table('search')->select('name', 'search_url')->where('status', '=', 1)->where('search_cat_id', '=', $search_cat_id)->orderBy('sort', 'ASC')->get();

        return $search_cat;
    }

}
