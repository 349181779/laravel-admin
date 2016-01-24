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
<<<<<<< HEAD
use DB;

class AdminInfoModel extends BaseModel
{
=======

use DB;

class AdminInfoModel extends BaseModel {
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1

    protected $table    = 'admin_info';//定义表名
    protected $guarded  = ['id'];//阻挡所有属性被批量赋值

    /**
     * 判断是否登录状态
     *
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
<<<<<<< HEAD
    public static function hasLoginStatus()
    {
        if(isAdminLogin() > 0 ) return true;
=======
    public static function hasLoginStatus(){
        //加载函数库
        load_func('common');
        if(is_admin_login() > 0 ) return true;
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
        return false;
    }

    /**
     * 用户登录
     *
     * @param $params array 用户登录名和密码参数
     * @return int
     * @author yangyifan <yangyifanphp@gmail.com>
     */
<<<<<<< HEAD
    public static function login($params)
    {
        //查找用户
        $user_info =    self::multiwhere(['admin_info.admin_name' => $params['admin_name']])->
                        select(['admin_info.*', 's.station_name', 's.city_id', 's.level', 'r.region_name', 'al.limit_name'])->
                        leftJoin('sys_station AS s', 'admin_info.station_id', '=', 's.id')->
                        leftJoin('sys_region AS r', 's.city_id', '=', 'r.id')->
                        leftJoin('admin_limit AS al', 'admin_info.limit_id', '=', 'al.id')->
                        first();
=======
    public static function login($params){;
        //查找用户
        $user_info = DB::table('admin_info')->where('email', '=', $params['email'])->first();
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1

        //判断改用户是否存在
        if(empty($user_info)){
            return -1;
        }

        //判断改用户是否被禁用
<<<<<<< HEAD
        if($user_info->state != 1){
=======
        if($user_info->status != 1){
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
            return -2;
        }

        //判断密码是否正确
<<<<<<< HEAD
        if (self::checkPassword($params['password'], $user_info) == false) {
            return -3;
        }

        //获得当前用户所在城市


        //保存用户session信息
        $user_info->ip = $params['ip'];
=======
        if(password_verify($params['password'], $user_info->password) == false){
            return -3;
        }

        //保存用户session信息
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
        self::saveUserSession($user_info);
        return 1;
    }

<<<<<<< HEAD
    /**
     * 判断密码是否正确
     *
     * @param $password
     * @param $user_info
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function checkPassword($password, $user_info)
    {
        if (empty($password) || empty($user_info)) {
            return false;
        }

        if (strlen($user_info->password) == 32) {
            //如果md5验证成功，则把当前密码修改成password_hash方式
            if (md5($password) === $user_info->password) {
                return self::where('id', '=', $user_info->id)->update(['password'  => bcrypt($password),]);
            }
            return false;
        }

        return password_verify($password, $user_info->password);
    }

=======
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
   /**
     * 写入用户信息到SESSION
     *
     * @param $user_info
     * @author yangyifan <yangyifanphp@gmail.com>
     */
<<<<<<< HEAD
    private static function saveUserSession($user_info)
    {
        $user_info = objToArray($user_info);
=======
    private static function saveUserSession($user_info){
        //引入函数库
        load_func('common');
        $user_info = obj_to_array($user_info);
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
        $user_info['admin_user_data'] = [
            'id'            => $user_info['id'],
            'email'         => $user_info['email'],
            'updated_at'    => $user_info['updated_at'],
<<<<<<< HEAD
            'ip'            => $user_info['ip'],
        ];
        $user_info['sign'] = hashUserSign($user_info['admin_user_data']);
=======
        ];
        $user_info['sign'] = hash_user_sign($user_info['admin_user_data']);
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
        Session::put('admin_info', $user_info);
        Session::save();
    }

    /**
     * 用户退出
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
<<<<<<< HEAD
    public static function logout()
    {
=======
    public static function logout(){
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
        Session::forget('admin_info');
        Session::save();
    }

    /**
     * 搜索
     *
     * @param $map
     * @param $sort
     * @param $order
     * @param $offset
     * @return mixed
<<<<<<< HEAD
     * @author zhuweijian <zhuweijain@louxia100.com>
     */
    protected static function search($map, $sort, $order, $limit, $offset)
    {
        return [
            'data' => self::mergeData(
                self::multiwhere($map)->
                select('admin_info.id', 'admin_info.admin_name','admin_info.state','admin_info.last_login','admin_info.create_date','admin_info.mobile','s.station_name','l.limit_name','admin_info.limit_id')->
                join('sys_station as s', 'admin_info.station_id', '=', 's.id')->
                join('admin_limit as l', 'admin_info.limit_id', '=', 'l.id')->
                orderBy($sort, $order)->
=======
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    protected static function search($map, $sort, $order, $limit, $offset){
        return [
            'data' => self::mergeData(
                self::multiwhere($map)->
                select('r.role_name', 'admin_info.*')->
                join('role as r', 'admin_info.role_id', '=', 'r.id')->
                orderBy('admin_info.'.$sort, $order)->
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
                skip($offset)->
                take($limit)->
                get()
            ),
<<<<<<< HEAD
            'count' => self::multiwhere($map)->
                       join('sys_station as s', 'admin_info.station_id', '=', 's.id')->
                       join('admin_limit as l', 'admin_info.limit_id', '=', 'l.id')->
                       count(),
=======
            'count' => self::multiwhere($map)->join('role as r', 'admin_info.role_id', '=', 'r.id')->count(),
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
        ];
    }

    /**
     * 组合数据
     *
<<<<<<< HEAD
     * @author zhuweijian <zhuweijain@louxia100.com>
     */
    public static function mergeData($data)
    {
        if (!empty($data)) {
            foreach($data as &$v){
                //组合状态
                $v->state_name   = self::mergeStatus($v->state);

                //组合操作
                $v->handle       = '<a href="'.createUrl('Admin\Admin\AdminInfoController@getEdit',['id' => $v->id]).'" target="_blank" >修改</a>';
=======
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
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1

            }
        }
        return $data;
    }

<<<<<<< HEAD
    /**
     * 配送站点列表
     *
     * @author zhuweijian <zhuweijain@louxia100.com>
     */

    public static function adminInfoStationName()
    {
        $map=[];
        $roles = StationModel::multiwhere($map)->lists('station_name','id') ;
        if (!empty($roles)) {
            $data = [];
            foreach ($roles as $k =>$v) {
                $data[] = [
                    'id'    => $k,
                    'name'  => $v,
                ];
            }
        }
        return $data;
    }

    /**
     * 用户权限列表
     *
     * @author zhuweijian <zhuweijain@louxia100.com>
     */

    public static function adminInfoLimitName()
    {
        $map=[];
        $roles = AdminLimitModel::multiwhere($map)->lists('limit_name','id') ;
        if (!empty($roles)) {
            $data = [];
            foreach ($roles as $k =>$v) {
                $data[] = [
                    'id'    => $k,
                    'name'  => $v,
                ];
            }
        }
        return $data;
    }

    /**
     * 获得后台用户信息
     *
     * @param $admin_id
     * @return bool|\Illuminate\Support\Collection|null|static
     */
    public static function getAdminInfo($admin_id)
    {
        if ($admin_id <= 0) {
            return false;
        }

        return self::find($admin_id);
    }

    /**
     * 获得当前用户站点id
     *
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getStationId()
    {
        return hashUserSign(Session::get('admin_info.admin_user_data')) == Session::get('admin_info.sign') ? Session::get('admin_info.station_id') : false;
    }

    /**
     * 获得当前用户城市id
     *
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getCityId()
    {
        return hashUserSign(Session::get('admin_info.admin_user_data')) == Session::get('admin_info.sign') ? Session::get('admin_info.city_id') : false;
    }

    /**
     * 获得当前用户角色id
     *
     * @return bool
     */
    public static function getAdminLimit()
    {
        return hashUserSign(Session::get('admin_info.admin_user_data')) == Session::get('admin_info.sign') ? Session::get('admin_info.limit_id') : false;
    }

    /**
     * 获得当前用户名称
     *
     * @return bool
     */
    public static function getAdminName()
    {
        return hashUserSign(Session::get('admin_info.admin_user_data')) == Session::get('admin_info.sign') ? Session::get('admin_info.admin_name') : false;
    }

    /**
     * 获得当前用户id
     *
     * @return bool
     */
    public static function getAdminId()
    {
        return hashUserSign(Session::get('admin_info.admin_user_data')) == Session::get('admin_info.sign') ? Session::get('admin_info.id') : false;
    }
=======

>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1

}
