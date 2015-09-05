<?php

// +----------------------------------------------------------------------
// | date: 2015-08-08
// +----------------------------------------------------------------------
// | ForumCatModel.php: 后端论坛分类模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Admin;

use \DB;

class ForumCatModel extends BaseModel {

    protected $table    = 'forum_cat';//定义表名
    protected $guarded  = ['id'];//阻挡所有属性被批量赋值

    /**
     * 获得全部文章分类
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAll(){
        //加载函数库
        load_func('common');

        $role_id = self::getRoleId();

        //设置允许查看全部论坛角色组
        if(in_array($role_id, config('config.forum_cat_supper_role_ids') ) ){
            return merge_tree_node(obj_to_array(self::mergeData(
                self::where('status', '=', 1)->
                where('deleted_at', '=', '0000-00-00 00:00:00')->
                get()
            )));
        }

        return merge_tree_node(obj_to_array(self::mergeData(
            DB::table('forum_access AS fa')->
            join('forum_cat AS fc', 'fa.forum_cat_id', '=', 'fc.id')->
            where('fa.role_id', '=', $role_id)->
            where('fc.status', '=', 1)->
            where('fc.deleted_at', '=', '0000-00-00 00:00:00')->
            get()
        )));
    }

    /**
     * 组合数据
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeData($data){
        if(!empty($data)){

            foreach($data as &$v){
                //组合pid
                $v->pid_name = $v->pid == 0 ? trans('response.top_classification') : self::where('id', '=', $v->pid)->pluck('cat_name');
                //组合状态
                $v->status = self::mergeStatus($v->status);
                //组合操作
                $v->handle = '<a href="'.url('admin/forum-cat/edit', [$v->id]).'" target="_blank" >编辑</a>';
                $v->handle  .= ' | ';
                $v->handle  .= '<a href="'.url('admin/forum/index', [$v->id]).'" target="_blank" >帖子</a>';
                $v->handle  .= ' | ';
                $v->handle  .= '<a onclick="del(this,\''.url('admin/forum-cat/delete', [$v->id]).'\')" target="_blank" >删除</a>';
            }
        }
        return $data;
    }


    /**
     * 获得当前栏目全部角色权限
     *
     * @param null $role_id
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getUserForumCat($forum_cat_id){
        if(!empty($forum_cat_id)){
            //加载函数库
            load_func('common');

            return obj_to_array(DB::table('forum_access AS fa')->select('r.id', 'r.role_name')->join('role AS r', 'fa.role_id', '=', 'r.id')->where('fa.forum_cat_id', '=', $forum_cat_id)->get());
        }
        return false;
    }

    /**
     * 更新当前分类权限
     *
     * @param array $access_list
     * @param $forum_cat_id
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function updateCategoryAccess(Array $access_list, $forum_cat_id){
        if(!empty($forum_cat_id)){
            //删除当前分类权限
            self::deleteCategoryAccess($forum_cat_id);

            if(!empty($access_list)){
                foreach($access_list as $access){
                    if($access <= 0) continue;

                    DB::table('forum_access')->insertGetId([
                        'forum_cat_id'  => $forum_cat_id,
                        'role_id'       => $access,
                    ]);
                }
            }
            return true;
        }
        return false;
    }

    /**
     * 删除当前分类权限
     *
     * @param $forum_cat_id
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function deleteCategoryAccess($forum_cat_id){
        if(!empty($forum_cat_id)){
            return DB::table('forum_access')->where('forum_cat_id', '=', $forum_cat_id)->delete();
        }
        return false;
    }

    /**
     * 验证当前栏目权限
     *
     * @param $forum_cat_id
     * @param $role_id
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function checkAccess($forum_cat_id, $role_id = null){
        //获得当前角色
        $role_id = self::getRoleId($role_id);

        if(in_array($role_id, config('config.forum_cat_supper_role_ids') ) ){
            return true;
        }

        if(!empty($forum_cat_id)){
            //获得当前栏目全部权限
            $all_access =  DB::table('forum_access')->where('forum_cat_id', '=', $forum_cat_id)->lists('role_id', 'id');
            return in_array($role_id, $all_access) ? true : false;
        }

        return false;
    }

    /**
     * 获得当前角色全部论坛分类
     *
     * @param null $role_id
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function getRoleForumCat($role_id = null){
        //获得当前角色
        $role_id = self::getRoleId($role_id);
        return DB::table('forum_access')->where('role_id', '=', $role_id)->lists('forum_cat_id', 'id');
    }


}
