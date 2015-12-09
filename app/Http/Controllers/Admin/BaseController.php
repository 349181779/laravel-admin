<?php

// +----------------------------------------------------------------------
// | date: 2015-06-07
// +----------------------------------------------------------------------
// | BaseController.php: 后端基础控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Model\Admin\Admin\AdminFunctionModel;
use App\Model\Admin\Admin\AdminInfoModel;
use App\Model\Admin\Admin\AdminMenuModel;
use Illuminate\Http\Request;
use Route;
use View;
use App\Model\Admin\Admin\AdminLimitFunctionModel;

class BaseController extends \App\Http\Controllers\BaseController
{
    private $request;

    const CONNECTION = '@';//控制器名称和方法名称连接符号
    private static $route_arr = null;//当前路由数组

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
        //显示管理者信息
        $this->showAdminInfo();
        //获得当前位置信息
        $this->getLocation();
        //验证权限
        if ( $this->checkAccess() == false) {
            if (isAjax() == true) {
                echo $this->responseContent(self::ERROR_STATE_CODE, trans('response.unauthorized'));die;
            }
            echo '<script>alert("'.trans('response.unauthorized').'");window.location.href="'.createUrl("Admin\HomeController@getIndex").'"</script>';die;
        }
    }

    /**
     * 检测登录
     *
     * @return bool|\Illuminate\Http\RedirectResponse
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function checkIsLogin()
    {
        if ( isAdminLogin() <= 0 ) {
            echo "<script>window.location.href='".createUrl('Admin\LoginController@getIndex')."'</script>";
        }
    }

    /**
     * 显示管理者信息
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function showAdminInfo()
    {
        view()->share('admin_info', AdminInfoModel::getAdminInfoForSession());
    }

    /**
     * 获得当前位置信息
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function getLocation()
    {
        view()->share('location_arr', AdminMenuModel::mergeLocation( AdminMenuModel::getMenuId(implode(self::CONNECTION, $this->getCurrentAction())) ));
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

        return true;
        $all_user_function  = AdminLimitFunctionModel::getUserFunction();
        $all_function       = AdminFunctionModel::lists('function_name');

        //如果当前权限，没有设定到权限控制表里面，则返回true
        if ( !in_array($action['controller'], $all_function) && !in_array(implode(self::CONNECTION, $action), $all_function) ) {
            return true;
        }
        //判断当前控制器是否存在 当前角色函数列表

//        if (in_array($action['controller'], $all_user_function) && array_search($action['controller'], $all_user_function)){
//            echo 11;die;
//            return true;
//        } else

        if (in_array(implode(self::CONNECTION, $action), $all_user_function)){
            return true;
        }
        return false;
    }

    /**
     * 获取当前控制器与方法
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getCurrentAction()
    {
        if (is_null(self::$route_arr)) {
            $action = \Route::current()->getActionName();
            list($class, $method) = explode(self::CONNECTION, $action);
            self::$route_arr =  ['controller' => str_replace("App\\Http\\Controllers\\", "", $class), 'method' => $method];
        }
        return self::$route_arr;
    }
}
