<?php

// +----------------------------------------------------------------------
// | date: 2015-06-06
// +----------------------------------------------------------------------
// | AdminAccessModel.php: 后端权限模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------


namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

use Config;

use Illuminate\Pagination\Paginator;

class AdminAccessModel extends Model {

    protected $table    = 'admin_info';//定义表名
    protected $guarded  = ['*'];//阻挡所有属性被批量赋值

    /**
     * 获取角色
     *
     * @return mixed
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public static function role(){
        $role =  DB::table('role')->paginate(Config::get('page.page_limit'));
        $pages = $role->render();
        $role = $role->toArray();
        return array(
            'data' => $role['data'],
            'pages'=> $pages
        );
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
