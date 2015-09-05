<?php

// +----------------------------------------------------------------------
// | date: 2015-07-15
// +----------------------------------------------------------------------
// | NewsModel.php: 前台查新闻模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\User;

use App\Model\Home\BaseModel;

use DB;

class NewsModel extends BaseModel {

    protected $table    = 'news_cat';//定义表名
    protected $guarded  = ['*'];//阻挡所有属性被批量赋值

    /**
     * 获得首页网址分类和分类下面的网址
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAllNews($id){
        return DB::table('news')->where('news_cat_id', '=', $id)->where('status', '=', 1)->where('deleted_at', '=', '0000-00-00 00:00:00')->orderBy('id', 'DESC')->orderBy('sort', 'ASC')->paginate(105);
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
                //组合操作
                $v->news  = DB::table('news')->where('news_cat_id', '=', $v->id)->where('status', '=', 1)->where('deleted_at', '=', '0000-00-00 00:00:00')->orderBy('id', 'DESC')->orderBy('sort', 'ASC')->take(100)->get();
            }
        }
        return $data;
    }

    /**
     * 获得用户全部分类
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getUserCategory($user_id = null ){
        //加载函数库
        load_func('common');

        $user_id = $user_id != null ? $user_id : is_user_login();

        $data = obj_to_array(
            DB::table('user_news_category AS uns')->
            join('news_cat AS c', 'uns.news_cat_id', '=', 'c.id')->
            where('uns.user_info_id', '=', $user_id)->
            where('c.status', '=', 1)->
            where('c.deleted_at', '=', '0000-00-00 00:00:00')->
            get()
        );
        $data =  array_to_obj(merge_tree_child_node($data));
        return $data;
    }

    /**
     * 获得全部分类
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getUserChoseCagetory(){
        //加载函数库
        load_func('common');

        //获得当前用户全部新闻分类
        $user_new_category_id = self::getUserCagetory();

        $all_category = self::all();
        if(!empty($all_category)){
            foreach($all_category as &$category){
                $category->checked = in_array($category->id, $user_new_category_id) ? true : false;
            }
        }

        $all_category = obj_to_array($all_category);
        return array_to_obj(merge_tree_child_node($all_category));
    }

    /**
     * 获得用户全部分类
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function getUserCagetory($user_id = null){
        //加载函数库
        load_func('common');

        $user_id = $user_id != null ? $user_id : is_user_login();

        return DB::table('user_news_category')->where('user_info_id', '=', $user_id)->lists('news_cat_id');
    }

    /**
     * 更新用户当前新闻分类
     *
     * @param array $category_array
     * @param null $user_id
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function updateUserCategory(Array $category_array = null, $user_id = null){
        //删除会员当前全部新闻分类
        self::deleteUserCategory();

        if(!empty($category_array)){
            //加载函数库
            load_func('common');

            $user_id = $user_id != null ? $user_id : is_user_login();

            foreach($category_array as $category){
                if($category <= 0 ) continue;

                DB::table('user_news_category')->insertGetId([
                    'user_info_id'  => $user_id,
                    'news_cat_id'   => $category,
                ]);
            }
        }
        return true;
    }

    /**
     * 删除会员当前全部新闻分类
     *
     * @param null $user_id
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function deleteUserCategory($user_id = null){
        //加载函数库
        load_func('common');

        $user_id = $user_id != null ? $user_id : is_user_login();

        return DB::table('user_news_category')->where('user_info_id', '=', $user_id)->delete();
    }
}
