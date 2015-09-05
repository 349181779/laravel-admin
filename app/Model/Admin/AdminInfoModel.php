<?php

// +----------------------------------------------------------------------
// | date: 2015-06-06
// +----------------------------------------------------------------------
// | AdminInfoModel.php: 后端用户模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Admin;

use Session;

use DB;

class AdminInfoModel extends BaseModel {

    protected $table    = 'admin_info';//定义表名
    protected $guarded  = ['id'];//阻挡所有属性被批量赋值

    /**
     * 判断是否登录状态
     *
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function hasLoginStatus(){
        //加载函数库
        load_func('common');
        if(is_admin_login() > 0 ) return true;
        return false;
    }

    /**
     * 用户登录
     *
     * @param $params array 用户登录名和密码参数
     * @return int
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function login($params){;
        //查找用户
        $user_info = DB::table('admin_info')->where('email', '=', $params['email'])->first();

        //判断改用户是否存在
        if(empty($user_info)){
            return -1;
        }

        //判断改用户是否被禁用
        if($user_info->status != 1){
            return -2;
        }

        //判断密码是否正确
        if(password_verify($params['password'], $user_info->password) == false){
            return -3;
        }

        //保存用户session信息
        self::saveUserSession($user_info);
        return 1;
    }

   /**
     * 写入用户信息到SESSION
     *
     * @param $user_info
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function saveUserSession($user_info){
        //引入函数库
        load_func('common');
        $user_info = obj_to_array($user_info);
        $user_info['admin_user_data'] = [
            'id'            => $user_info['id'],
            'email'         => $user_info['email'],
            'updated_at'    => $user_info['updated_at'],
        ];
        $user_info['sign'] = hash_user_sign($user_info['admin_user_data']);
        Session::put('admin_info', $user_info);
        Session::save();
    }

    /**
     * 用户退出
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function logout(){
        Session::flush();
    }

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
                select('r.role_name', 'admin_info.*')->
                join('role as r', 'admin_info.role_id', '=', 'r.id')->
                orderBy('admin_info.'.$sort, $order)->
                skip($offset)->
                take($limit)->
                get()
            ),
            'count' => self::multiwhere($map)->join('role as r', 'admin_info.role_id', '=', 'r.id')->count(),
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
                //组合角色
                $v->role_name = DB::table('role')->where('id', '=', $v->role_id)->pluck('role_name');
                //组合操作
                $v->handle  = '<a href="'.url('admin/admininfo/edit', [$v->id]).'" target="_blank" >编辑</a>';
                $v->handle  .= ' | ';
                $v->handle  .= '<a onclick="del(this,\''.url('admin/admininfo/delete', [$v->id]).'\')" target="_blank" >删除</a>';

            }
        }
        return $data;
    }



}
