<?php

// +----------------------------------------------------------------------
// | date: 2015-07-10
// +----------------------------------------------------------------------
// | ArticleModel.php: 后端文章模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Admin;

class ArticleModel extends BaseModel
{

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
    protected static function search($map, $sort, $order, $limit, $offset)
    {
        return [
            'data' => self::mergeData(
                self::multiwhere($map)->
                select('c.cat_name', 'article.*')->
                join('article_cat as c', 'article.article_cat_id', '=', 'c.id')->
                orderBy('article.'.$sort, $order)->
                skip($offset)->
                take($limit)->
                get()
            ),
            'count' =>  self::multiwhere($map)->join('article_cat as c', 'article.article_cat_id', '=', 'c.id')->count(),
        ];
    }

    /**
     * 组合数据
     *
     * @param $roles
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeData($data)
    {
        if (!empty($data)) {
            foreach ($data as &$v) {
                //组合状态
                $v->state   = self::mergeStatus($v->state);
                //组合操作
                $v->handle  = '<a href="'.createUrl('Admin\ArticleController@getEdit', ['id' => $v->id]).'" target="_blank" >编辑</a>';
            }
        }
        return $data;
    }

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

}
