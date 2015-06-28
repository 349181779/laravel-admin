<?php

// +----------------------------------------------------------------------
// | date: 2015-06-06
// +----------------------------------------------------------------------
// | AdminInfoModel.php: 后端用户模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App;

use Illuminate\Database\Eloquent\Model;

use Session;

use DB;

use Lang;

class AdminInfoModel extends Model {

    protected $table    = 'admin_info';//定义表名
    protected $guarded  = ['*'];//阻挡所有属性被批量赋值

    /**
     * 用户登录
     *
     * @param $params array 用户登录名和密码参数
     * @return int
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public static function login($params){
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
        self::_saveUserSession($user_info);
        return 1;
    }

    /**
     * 写入用户信息到SESSION
     *
     * @param $user_info
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    private static function _saveUserSession($user_info){
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
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public static function logout(){
        Session::flush();
    }

    /**
     * 获得后台用户列表
     *
     * @return object
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAdminList(){
        $data   =   DB::table('admin_info AS a')->
                    join('role AS r', 'a.role_id', '=', 'r.id')->
                    select('a.id','a.email', 'a.mobile', 'a.status', 'a.face', 'r.role_name', 'a.created_at', 'a.updated_at')->
                    orderBy('id', 'DESC')->
                    paginate(config('page.page_limit'));
        $pages  = $data->render();
        $data   = $data->toArray();
        return array(
            'data' => self::mergeData($data['data']),
            'pages'=> $pages
        );
    }

    /**
     * 组合角色数据
     *
     * @param $roles
     * @return mixed
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeData($roles){
        if(!empty($roles)){
            foreach($roles as $role){
                switch($role->status){
                    case 1:
                        $role->status = Lang::get('response.on');
                        break;
                    case 2:
                        $role->status = Lang::get('response.off');
                        break;
                }

            }
        }
        return $roles;
    }

    /**
     * 获取单个菜单
     *
     * @return mixed
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public static function findAdminInfo($id){
        return DB::table('admin_info')->where('id', '=', $id)->first();
    }



}
