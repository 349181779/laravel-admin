<?php

// +----------------------------------------------------------------------
// | date: 2015-07-13
// +----------------------------------------------------------------------
// | NewsModel.php: 后端新闻模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Admin;

class NewsModel extends BaseModel {

    protected $table    = 'news';//定义表名
    protected $guarded  = ['id'];//阻挡所有属性被批量赋值

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
                select('c.cat_name', 'a.email', 'news.*')->
                join('news_cat as c', 'news.news_cat_id', '=', 'c.id')->
                join('admin_info as a', 'news.admin_info_id', '=', 'a.id')->
                orderBy('news.'.$sort, $order)->
                skip($offset)->
                take($limit)->
                get()
            ),
            'count' =>  self::multiwhere($map)->
                        join('news_cat as c', 'news.news_cat_id', '=', 'c.id')->
                        join('admin_info as a', 'news.admin_info_id', '=', 'a.id')->
                        count(),

        ];
    }

    /**
     * 组合数据
     *
     * @param $roles
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeData($data){
        if(!empty($data)){
            foreach($data as &$v){
                //组合状态
                $v->status = self::mergeStatus($v->status);
                //组合操作
                $v->handle  = '<a href="'.url('admin/news/edit', [$v->id]).'" target="_blank" >编辑</a>';
                $v->handle  .= ' | ';
                $v->handle  .= '<a onclick="del(this,\''.url('admin/news/delete', [$v->id]).'\')" target="_blank" >删除</a>';
            }
        }
        return $data;
    }

}
