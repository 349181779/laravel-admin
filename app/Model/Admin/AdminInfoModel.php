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

class AdminInfoModel extends BaseModel
{

    protected $table    = 'admin_info';//定义表名
    protected $guarded  = ['id'];//阻挡所有属性被批量赋值

    /**
     * 判断是否登录状态
     *
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function hasLoginStatus()
    {
        if(isAdminLogin() > 0 ) return true;
        return false;
    }

    /**
     * 用户登录
     *
     * @param $params array 用户登录名和密码参数
     * @return int
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function login($params)
    {
        //查找用户
        $user_info =    self::multiwhere(['admin_info.admin_name' => $params['admin_name']])->
                        select(['admin_info.*', 's.station_name', 's.city_id', 's.level', 'r.region_name', 'al.limit_name'])->
                        leftJoin('sys_station AS s', 'admin_info.station_id', '=', 's.id')->
                        leftJoin('sys_region AS r', 's.city_id', '=', 'r.id')->
                        leftJoin('admin_limit AS al', 'admin_info.limit_id', '=', 'al.id')->
                        first();

        //判断改用户是否存在
        if(empty($user_info)){
            return -1;
        }

        //判断改用户是否被禁用
        if($user_info->state != 1){
            return -2;
        }

        //判断密码是否正确
        if (self::checkPassword($params['password'], $user_info) == false) {
            return -3;
        }

        //获得当前用户所在城市


        //保存用户session信息
        $user_info->ip = $params['ip'];
        self::saveUserSession($user_info);
        return 1;
    }

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

   /**
     * 写入用户信息到SESSION
     *
     * @param $user_info
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function saveUserSession($user_info)
    {
        $user_info = objToArray($user_info);
        $user_info['admin_user_data'] = [
            'id'            => $user_info['id'],
            'email'         => $user_info['email'],
            'updated_at'    => $user_info['updated_at'],
            'ip'            => $user_info['ip'],
        ];
        $user_info['sign'] = hashUserSign($user_info['admin_user_data']);
        Session::put('admin_info', $user_info);
        Session::save();
    }

    /**
     * 用户退出
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function logout()
    {
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
                skip($offset)->
                take($limit)->
                get()
            ),
            'count' => self::multiwhere($map)->
                       join('sys_station as s', 'admin_info.station_id', '=', 's.id')->
                       join('admin_limit as l', 'admin_info.limit_id', '=', 'l.id')->
                       count(),
        ];
    }

    /**
     * 组合数据
     *
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

            }
        }
        return $data;
    }

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

}
