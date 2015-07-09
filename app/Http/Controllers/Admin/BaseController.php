<?php

// +----------------------------------------------------------------------
// | date: 2015-06-07
// +----------------------------------------------------------------------
// | BaseController.php: 后端基础控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Session;

use App\MenuModel;

class BaseController extends \App\Http\Controllers\BaseController {

    /**
     * 构造方法
     *
     */
    public function __construct(){
        //检测登录
        $this->checkIsLogin();
        //获得全部菜单
        $this->getAllMenu();
    }

    /**
     * 检测登录
     *
     * @return bool|\Illuminate\Http\RedirectResponse
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    private function checkIsLogin(){
        load_func('common');
        $uid = is_login();
        return $uid <= 0 && header('location:/admin/login');
    }

    /**
     * 获得全部菜单
     *
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    private function getAllMenu(){
        view()->share('menu_tree_data', MenuModel::getAllForMenuSide());
    }



}
