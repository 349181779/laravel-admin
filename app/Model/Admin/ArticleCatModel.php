<?php

// +----------------------------------------------------------------------
// | date: 2015-07-10
// +----------------------------------------------------------------------
// | ArticleCatModel.php: 后端文章分类模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Admin;

<<<<<<< HEAD
class ArticleCatModel extends BaseModel
{
=======
class ArticleCatModel extends BaseModel {
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1

    protected $table    = 'article_cat';//定义表名
    protected $guarded  = ['id'];//阻挡所有属性被批量赋值

    /**
     * 获得全部文章分类
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
<<<<<<< HEAD
    public static function getAll()
    {
        return mergeTreeNode(objToArray(self::mergeData(self::all())));
=======
    public static function getAll(){
        //加载函数库
        load_func('common');
        return merge_tree_node(obj_to_array(self::mergeData(self::where('status', '=', 1)->where('deleted_at', '=', '0000-00-00 00:00:00')->get())));
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
    }

    /**
     * 组合数据
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
<<<<<<< HEAD
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
=======
    public static function mergeData($data){
        if(!empty($data)){
            foreach($data as &$v){
                //组合pid
                $v->pid_name = $v->pid == 0 ? trans('response.top_classification') : self::where('id', '=', $v->pid)->pluck('cat_name');
                //组合状态
                $v->status = self::mergeStatus($v->status);
                //组合操作
                $v->handle = '<a href="'.url('admin/article-cat/edit', [$v->id]).'" target="_blank" >编辑</a>';
                $v->handle  .= ' | ';
                $v->handle  .= '<a onclick="del(this,\''.url('admin/article-cat/delete', [$v->id]).'\')" target="_blank" >删除</a>';
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
            }
        }
        return $data;
    }

<<<<<<< HEAD
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
=======
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1

}
