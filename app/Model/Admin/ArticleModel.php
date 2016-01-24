<?php

// +----------------------------------------------------------------------
// | date: 2015-07-10
// +----------------------------------------------------------------------
<<<<<<< HEAD
// | ArticleModel.php: 后端文章模型
=======
// | ArticleModel.php: 后端用户模型
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Admin;

<<<<<<< HEAD
class ArticleModel extends BaseModel
{
=======
class ArticleModel extends BaseModel {
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1

    protected $table    = 'article';//定义表名
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
<<<<<<< HEAD
    protected static function search($map, $sort, $order, $limit, $offset)
    {
        return [
            'data' => self::mergeData(
                self::multiwhere($map)->
                select('c.cat_name', 'article.*')->
                join('article_cat as c', 'article.article_cat_id', '=', 'c.id')->
=======
    protected static function search($map, $sort, $order, $limit, $offset){
        return [
            'data' => self::mergeData(
                self::multiwhere($map)->
                select('c.cat_name', 'a.email', 'article.*')->
                join('article_cat as c', 'article.article_cat_id', '=', 'c.id')->
                join('admin_info as a', 'article.admin_info_id', '=', 'a.id')->
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
                orderBy('article.'.$sort, $order)->
                skip($offset)->
                take($limit)->
                get()
            ),
<<<<<<< HEAD
            'count' =>  self::multiwhere($map)->join('article_cat as c', 'article.article_cat_id', '=', 'c.id')->count(),
=======
            'count' =>  self::multiwhere($map)->
                        join('article_cat as c', 'article.article_cat_id', '=', 'c.id')->
                        join('admin_info as a', 'article.admin_info_id', '=', 'a.id')->
                        count(),
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
        ];
    }

    /**
     * 组合数据
     *
     * @param $roles
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
<<<<<<< HEAD
    public static function mergeData($data)
    {
        if (!empty($data)) {
            foreach ($data as &$v) {
                //组合状态
                $v->state   = self::mergeStatus($v->state);
                //组合操作
                $v->handle  = '<a href="'.createUrl('Admin\ArticleController@getEdit', ['id' => $v->id]).'" target="_blank" >编辑</a>';
=======
    public static function mergeData($data){
        if(!empty($data)){
            foreach($data as &$v){
                //组合状态
                $v->status = self::mergeStatus($v->status);
                //组合操作
                $v->handle  = '<a href="'.url('admin/article/edit', [$v->id]).'" target="_blank" >编辑</a>';
                $v->handle  .= ' | ';
                $v->handle  .= '<a onclick="del(this,\''.url('admin/article/delete', [$v->id]).'\')" target="_blank" >删除</a>';
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
            }
        }
        return $data;
    }

<<<<<<< HEAD
    /**
     * 获得文章信息
     *
     * @param $article_id
     * @return bool|\Illuminate\Support\Collection|null|static
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getInfo($article_id)
    {
        if ($article_id <= 0) {
            return false;
        }

        $data = self::find($article_id);
        $data->content = htmlspecialchars_decode($data->content);
        return $data;
    }

=======
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
}
