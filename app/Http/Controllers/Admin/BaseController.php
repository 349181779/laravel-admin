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
use Illuminate\Http\Request;
use Route;
use View;
use App\Model\Admin\AdminLimitFunctionModel;

class BaseController extends \App\Http\Controllers\BaseController
{
    private $request;

    const CONNECTION = '@';//控制器名称和方法名称连接符号

    /**
     * 构造方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct()
    {
        parent::__construct();
        $this->request = new Request();
        //检测登录
        $this->checkIsLogin();
        //获得全部菜单
        $this->getAllMenu();
        //验证权限
        //$this->checkAccess();
    }

    /**
     * 检测登录
     *
     * @return bool|\Illuminate\Http\RedirectResponse
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function checkIsLogin()
    {
        return isAdminLogin() <= 0 && header('location:' . createUrl('Admin\LoginController@getIndex'));die;
    }

    /**
     * 获得全部菜单
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function getAllMenu()
    {
        view()->share('menu_tree_data', MenuModel::getUserMenuSide());
    }

    /**
     * 验证权限
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function checkAccess()
    {
        //获得当前路由
        $action = $this->getCurrentAction();

        $all_user_function = AdminLimitFunctionModel::getUserFunction();
        //判断当前控制器是否存在 当前角色函数列表

        if (in_array($action['controller'], $all_user_function)){
            return true;
        } elseif (in_array(implode(self::CONNECTION, $action), $all_user_function)){
            return true;
        }

        $this->response(self::ERROR_STATE_CODE, trans('response.access_error'));

    }

    /**
     * 获取当前控制器名
     *
     * @return string
     */
    public function getCurrentControllerName()
    {
        return getCurrentAction()['controller'];
    }

    /**
     * 获取当前方法名
     *
     * @return string
     */
    public function getCurrentMethodName()
    {
        return getCurrentAction()['method'];
    }

    /**
     * 获取当前控制器与方法
     *
     * @return array
     */
    public function getCurrentAction()
    {
        $action = \Route::current()->getActionName();
        list($class, $method) = explode('@', $action);
        return ['controller' => str_replace("App\\Http\\Controllers\\", "", $class), 'method' => $method];
    }

    /**
     * 获得当前url
     *
     * @return string
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function getCurrentUrl()
    {
        if(!empty($_SERVER['REQUEST_URI']) && strrpos($_SERVER['REQUEST_URI'], 'index')){
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

    /**
     * 显示错误信息
     *
     * @param $info
     * @param $time
     * @return \Illuminate\View\View
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function error($info, $time = 3, $jump_url = '')
    {
        //跳转地址
        $jump_url = $jump_url != '' ? $jump_url : action('Admin\HomeController@getIndex');

        echo $info;
        echo "<script>setTimeout(function(){window.location.href = '{$jump_url}'} ,{$time} * 1000)</script>";die;
    }
}
