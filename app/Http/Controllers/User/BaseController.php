<?php

// +----------------------------------------------------------------------
// | date: 2015-07-26
// +----------------------------------------------------------------------
// | BaseController.php: 会员基础控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Model\Home\BaseModel;

use Session;

use Request;

use Route;

class BaseController extends \App\Http\Controllers\BaseController {

    /**
     * 构造方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct(){
        //检测是否登陆
        $this->checkIsLogin();
        //获得导航数据
        $this->getSearch();

    }

    /**
     * 检测登录
     *
     * @return bool|\Illuminate\Http\RedirectResponse
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function checkIsLogin(){
        //记载函数库
        load_func('common');
        $uid = is_user_login();

        if($uid <= 0 && Request::method() == 'POST' ){
            $this->response(400, trans('response.no_login'));
        }else if($uid <= 0 ){
            header('location:'. action('Home\UserController@getLogin'));die;
        }

    }

    /**
     * 获得导航数据
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function getSearch(){
        view()->share('all_search', BaseModel::getSearch());
    }

}
