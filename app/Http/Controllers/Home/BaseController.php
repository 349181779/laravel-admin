<?php

// +----------------------------------------------------------------------
// | date: 2015-07-12
// +----------------------------------------------------------------------
// | BaseController.php: 前台基础控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Home;

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
        //加载函数库
        load_func('common');
        //检测是否登陆
        $this->checkIsLogin();
        //获得导航数据
        $this->getSearch();

    }


    /**
     * 获得导航数据
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function getSearch(){
        view()->share('all_search', BaseModel::getSearch());
    }

    /**
     * 检测登录
     *
     * @return bool|\Illuminate\Http\RedirectResponse
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function checkIsLogin(){
        $uid = is_user_login();

        if($uid <= 0 && Request::method() == 'POST' ){
            $this->response(400, trans('response.no_login'));
        }else if($uid <= 0 ){
            header('location:'. action('Home\UserController@getLogin'));die;
        }

    }

}
