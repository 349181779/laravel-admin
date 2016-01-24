<?php

// +----------------------------------------------------------------------
// | date: 2015-09-05
// +----------------------------------------------------------------------
// | ForumModel.php: 后端论坛模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Admin;

class ForumModel extends BaseModel {

    protected $table    = 'forum';//定义表名
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
                select('c.cat_name', 'u.email', 'forum.*')->
                join('forum_cat as c', 'forum.forum_cat_id', '=', 'c.id')->
                join('user_info as u', 'forum.user_info_id', '=', 'u.id')->
                orderBy('forum.'.$sort, $order)->
                skip($offset)->
                take($limit)->
                get()
            ),
            'count' =>  self::multiwhere($map)->
                        join('forum_cat as c', 'forum.forum_cat_id', '=', 'c.id')->
                        join('user_info as u', 'forum.user_info_id', '=', 'u.id')->
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
                $v->handle  = '<a href="'.action('Home\ForumController@getInfo', [$v->id]).'" target="_blank" >查看</a>';
                $v->handle  .= ' | ';
                $v->handle  .= '<a onclick="del(this,\''.action('Admin\ForumController@getDelete', [$v->id]).'\')" target="_blank" >删除</a>';
            }
        }
        return $data;
    }

}
