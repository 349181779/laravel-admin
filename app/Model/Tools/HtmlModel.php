<?php

// +----------------------------------------------------------------------
// | date: 2015-07-11
// +----------------------------------------------------------------------
// | Html.php: 会员网址模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Tools;

use App\Model\Admin\NewsModel;

class HtmlModel extends BaseModel {

    protected $table    = 'news';//定义表名
    protected $guarded  = ['id'];//阻挡所有属性被批量赋值


    /**
     * 执行任务
     *
     * @param $title
     * @param $url
     * @param $cat_id
     */
    public static function task($title, $url, $cat_id){
        $news = NewsModel::where('title', '=', $title)->orWhere('site_url', '=', $url)->first();

        if(empty($news)){
            NewsModel::create([
                'title'         => $title,
                'site_url'      => $url,
                'status'        => 1,
                'news_cat_id'   => $cat_id,
            ]);
        }

    }
}
