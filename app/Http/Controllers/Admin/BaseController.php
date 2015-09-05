<?php

// +----------------------------------------------------------------------
// | date: 2015-06-07
// +----------------------------------------------------------------------
// | BaseController.php: 后端基础控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Model\Admin\MenuModel;

use Route;

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
        //验证权限
        $this->checkAccess();
    }

    /**
     * 检测登录
     *
     * @return bool|\Illuminate\Http\RedirectResponse
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function checkIsLogin(){
        load_func('common');
        $uid = is_admin_login();
        return $uid <= 0 && header('location:'.action('Admin\LoginController@getIndex'));die;
    }

    /**
     * 获得全部菜单
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function getAllMenu(){
        view()->share('menu_tree_data', MenuModel::getUserMenuSide());
    }

    /**
     * 验证权限
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function checkAccess(){
        $all_user_menu_url  = MenuModel::getUserMenu();//用户全部菜单
        $all_menu_url       = MenuModel::getAllMenuUrl();//当前全部菜单

        if(!empty($all_menu_url)){
            foreach($all_menu_url as &$menu){
                if(!empty($menu)){
                    $menu = url($menu);
                }
            }
        }

        if(!empty($all_user_menu_url)){
            foreach($all_user_menu_url as &$menu){
                if(!empty($menu)){
                    $menu = url($menu);
                }
            }
        }
        //如果当前菜单在全局菜单里面，并且不存在角色当前菜单，则没有权限
        if(in_array($this->getCurrentUrl(), $all_menu_url) && !in_array($this->getCurrentUrl(), $all_user_menu_url)){
            echo '没有权限';die;
        }

    }

    /**
     * 获得当前url
     *
     * @return string
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function getCurrentUrl(){

        if(!empty($_SERVER['REQUEST_URI'])){
            return url($_SERVER['REQUEST_URI']);
        }

        $current_action = Route::currentRouteAction();

        $tmp = explode('\\', $current_action);

        //获得当前命名空间
        $namespace = $tmp[count($tmp) - 2];

        //获得当前控制器名称
        $action_name = end($tmp);

        return action($namespace . '\\' . $action_name);
    }

}
