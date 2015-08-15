<?php

// +----------------------------------------------------------------------
// | date: 2015-07-12
// +----------------------------------------------------------------------
// | UserModel.php: 前台用户模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Home;

use DB;

use Session;

class UserModel extends BaseModel {

    protected $table    = 'user_info';//定义表名
    protected $guarded  = ['id','open_id', 'is_validate_email', 'is_validate_mobile'];//阻挡所有属性被批量赋值

    /**
     * 用户登录
     *
     * @param $params array 用户登录名和密码参数
     * @return int
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function login($params){;
        //查找用户
        $user_info = DB::table('user_info')->where('email', '=', $params['email'])->first();


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
        //保存用户信息到swoole
        self::saveUserInfo($user_info);

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
        $user_info['user_user_data'] = [
            'id'            => $user_info['id'],
            'email'         => $user_info['email'],
            'updated_at'    => $user_info['updated_at'],
        ];
        $user_info['sign'] = hash_user_sign($user_info['user_user_data']);
        Session::put('user_info', $user_info);
        Session::save();
    }

    /**
     * 保存用户信息 到 swoole
     *
     * @param $user_info
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function saveUserInfo($user_info){
        //加载函数库
        load_func('swoole');
        send_save_user_to_swoole_server(action('Home\UserController@getSaveUserInfo'), serialize($user_info), '');
    }

    /**
     * 用户退出
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function logout(){
        Session::flush();
        Session::save();
    }

    /**
     * 注册会员
     *
     * @param $params
     * @return static
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function register($params){
        //加密密码
        $params['password'] = bcrypt($params['password']);

        //写入数据
        $user_info = self::create($params);
        return self::registerUserProfile($user_info->id) == true ? $user_info->id : false;
    }

    /**
     * 注册会员其他信息
     *
     * @param $user_id
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function registerUserProfile($user_id){
        if($user_id > 0 ){
            $profile_id = DB::table('user_profile')->insertGetId([
                'user_info_id'  => $user_id,
            ]);
            return $profile_id > 0 ? true : false;
        }
    }

}
