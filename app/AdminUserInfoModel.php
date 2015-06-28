<?php

// +----------------------------------------------------------------------
// | date: 2015-06-28
// +----------------------------------------------------------------------
// | AdminUserInfoModel.php: 后端会员模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App;

use DB;

use Lang;

use Illuminate\Database\Eloquent\Model;

class AdminUserInfoModel extends Model {

    protected $table    = 'user_info';//定义表名
    protected $guarded  = ['*'];//阻挡所有属性被批量赋值

    /**
     * 获得用户列表
     *
     * @return mixed
     */
    public static function getUser(){
        $data   =   DB::table('user_info')->orderBy('id', 'DESC')->paginate(config('page.page_limit'));
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

}
