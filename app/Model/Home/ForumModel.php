<?php

// +----------------------------------------------------------------------
// | date: 2015-08-08
// +----------------------------------------------------------------------
// | ForumModel.php: 前台查新闻模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Home;

use App\Model\Home\BaseModel;

use App\Model\User\UserModel;

use DB;

class ForumModel extends BaseModel {

    protected $table    = 'forum_cat';//定义表名
    protected $guarded  = ['*'];//阻挡所有属性被批量赋值

    /**
     * 获得首页论坛分类
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getIndexCat($cat_id = null){
        return $cat_id != null ? self::where('status', '=', '1')->where('deleted_at', '=', '0000-00-00 00:00:00')->where('is_show', '=', 1)->orWhere('id', '=', $cat_id)->orderBy('sort', 'ASC')->take(11)->get() : self::where('status', '=', '1')->where('is_show', '=', 1)->orderBy('sort', 'ASC')->take(11)->get();
    }

    /**
     * 获得当前分类下面全部帖子
     *
     * @param $cat_id 论坛分类id
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAllForums($cat_id){
        $forum_list =  DB::table('forum')->where('forum_cat_id', '=', $cat_id)->where('status', '=', '1')->where('deleted_at', '=', '0000-00-00 00:00:00')->orderBy('id', 'DESC')->orderBy('sort', 'ASC')->paginate(config('config.forum_page_limit'));

        if(!empty($forum_list)){
            foreach($forum_list as &$forum){
                $forum->user_info       = UserModel::getUserSimpleInfo($forum->user_info_id);
                $forum->last_comment    = self::getForumLastComment($forum->id);
                $forum->total_comment   = self::getTotalComment($forum->id);
            }
        }

        return $forum_list;
    }

    /**
     * 获得帖子最后一条评论
     *
     * @param $forum_id
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function getForumLastComment($forum_id){
        if(!empty($forum_id)){
            return DB::table('forum_comment')->where('forum_id', '=', $forum_id)->where('status', '=', 1)->orderBy('id', 'DESC')->first();
        }
    }

    /**
     * 获得总评论数
     *
     * @param $forum_id
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function getTotalComment($forum_id){
        if(!empty($forum_id)){
            return DB::table('forum_comment')->where('forum_id', '=', $forum_id)->count();
        }
    }

    /**
     * 获得帖子内容
     *
     * @param $id
     * @return \Illuminate\Support\Collection|null|static
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getInfo($id){
        if(!empty($id)){
            $data = DB::table('forum')->where('id', '=', $id)->where('status', '=', 1)->where('deleted_at', '=', '0000-00-00 00:00:00')->first();

            if(!empty($data)){
                //获得分类信息
                if($data->forum_cat_id > 0 ){
                    $data->category = self::getForumCat($data->forum_cat_id);
                }

                //获得评论信息
                $data->comment = self::getForumComment($data->id);

                //获得当前所在位置
                $data->location = self::getForumLocation($data);

                //点击来+1
                DB::table('forum')->where('id', '=', $id)->increment('view');
            }


            return $data;
        }
    }

    /**
     * 获得帖子评论信息
     *
     * @param $id
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function getForumComment($id){
        $comment_list =  DB::table('forum_comment')->where('forum_id', '=', $id)->where('status', '=', '1')->orderBy('id', 'DESC')->paginate(config('config.forum_comment_page_limit'));

        if(!empty($comment_list)){
            foreach($comment_list as $comment){
                $comment->user_info = UserModel::getUserSimpleInfo($comment->user_info_id);
            }
        }
        return $comment_list;
    }

    /**
     * 获得分类信息
     *
     * @param $forum_cat_id
     * @return mixed
     */
    private static function getForumCat($forum_cat_id){
        if($forum_cat_id > 0){
            return DB::table('forum_cat')->where('id', '=', $forum_cat_id)->where('deleted_at', '=', '0000-00-00 00:00:00')->first();
        }
    }

    /**
     * 获得全部论坛分类
     *
     * @param $data
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getForumLocation($data){
        //加载函数库
        load_func('common');

        $all_category = obj_to_array(self::select('cat_name', 'id' , 'pid')->get());

        $data = get_location($all_category, $data->forum_cat_id);

        //翻转函数
        $data = array_reverse($data);
        return $data;
    }
}
