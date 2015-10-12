<?php

// +----------------------------------------------------------------------
// | date: 2015-07-10
// +----------------------------------------------------------------------
// | ArticleCatModel.php: 后端文章分类模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Admin;

class ArticleCatModel extends BaseModel
{

    protected $table    = 'article_cat';//定义表名
    protected $guarded  = ['id'];//阻挡所有属性被批量赋值

    /**
     * 获得全部文章分类
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAll()
    {
        return mergeTreeNode(objToArray(self::mergeData(self::all())));
    }

    /**
     * 组合数据
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeData($data)
    {
        if (!empty($data)) {
            foreach ($data as &$v) {
                //组合pid
                $v->parent_name   = $v->parent_id == 0 ? trans('response.top_classification') : self::where('id', '=', $v->parent_id)->pluck('cat_name');
                //组合状态
                $v->state       = self::mergeStatus($v->state);
                //组合操作
                $v->handle      = '<a href="'.createUrl('Admin\ArticleCatController@getEdit', ['id' => $v->id]).'" target="_blank" >编辑</a>';
                $v->handle      .= ' | ';
                $v->handle      .= '<a href="'.createUrl('Admin\ArticleCatController@getEdit', ['article_cat_id' => $v->id]).'" target="_blank" >查看所有文章</a>';
            }
        }
        return $data;
    }

    /**
     * 获得文章类型
     *
     * @return array
     */
    public static function getType()
    {
        return [
            '1' => '普通',
            '2' => '系统',
            '3' => '网店',
            '4' => '帮助',
            '5' => '网店',
        ];
    }

}
