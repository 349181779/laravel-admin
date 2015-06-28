<?php

// +----------------------------------------------------------------------
// | date: 2015-06-06
// +----------------------------------------------------------------------
// | AdminRoleModel.php: 后端权限模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

use Lang;

use Illuminate\Pagination\Paginator;

class AdminRoleModel extends Model {

    protected $table    = 'role';//定义表名
    protected $guarded  = ['*'];//阻挡所有属性被批量赋值

    /**
     * 获取角色
     *
     * @return mixed
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public static function role(){
        $data   =  DB::table('role')->paginate(config('page.page_limit'));
        $pages  = $data->render();
        $data   = $data->toArray();
        return array(
            'data' => self::mergeRoleData($data['data']),
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
    public static function mergeRoleData($roles){
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
     * 获得角色列表
     *
     * @return mixed
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public static function getRoleList(){
        //加载函数库
        load_func('common');
        return obj_to_array(DB::table('role')->where('status', '=', 1)->get());
    }

    /**
     * 获得角色消息信息
     *
     * @param $role_id
     * @return mixed
     */
    public static function getRoleInfo($role_id){
        return DB::table('role')->where('id', '=', (int)$role_id)->first();
    }

}
