<?php

// +----------------------------------------------------------------------
// | date: 2015-07-11
// +----------------------------------------------------------------------
// | SiteModel.php: 会员网址模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Tools;

class Html extends BaseModel {

    protected $table    = 'news';//定义表名
    protected $guarded  = ['id'];//阻挡所有属性被批量赋值


    public static function task($data){
        NewsModel::create([
            'title'         => $article->find($task['child_dom'], 0)->plaintext,
            'site_url'      => $article->find($task['child_dom'], 0)->getAttribute('href'),
            'status'        => 1,
            'news_cat_id'   => $task['cat_id'],
        ]);



    }
}
