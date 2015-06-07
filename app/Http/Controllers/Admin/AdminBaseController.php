<?php

// +----------------------------------------------------------------------
// | date: 2015-06-07
// +----------------------------------------------------------------------
// | AdminBaseController.php: 后端基础控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Session;

use Crypt;

use Redirect;

class AdminBaseController extends \App\Http\Controllers\BaseController {

    protected $all_memu;

    /**
     * 构造方法
     *
     */
    public function __construct(){
        //检测登录
        $this->checkIsLogin();
    }

    /**
     * 检测登录
     *
     * @return bool|\Illuminate\Http\RedirectResponse
     */
    private function checkIsLogin(){
        load_func('common');
        $uid = is_login();
        return $uid <= 0 && header('location:/admin/login');

    }



}
