<?php

// +----------------------------------------------------------------------
// | date: 2015-12-14
// +----------------------------------------------------------------------
// | BaseMiddleware.php: 后端基础中间件
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Middleware\Admin;

use Closure;
use Cookie;
use App\Http\Controllers\BaseController;
use App\Model\Admin\Admin\AdminLimitFunctionModel;

class BaseMiddleware
{

	private $conrtoller;//基础控制器

	/**
	 * 构造方法
	 *
	 * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function __construct()
	{
		$this->conrtoller = new BaseController();
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function handle($request, Closure $next)
	{
		//判断 是否登陆
		if (isAdminLogin() > 0) {

			//验证权限
			if ( $this->checkAccess() == true) {
				return $next($request);
			}

			if (isAjax() == true || $request->method() == 'POST') {
				return $this->conrtoller->response(BaseController::UNAUTHORIZED_CODE, trans('response.unauthorized'));
			}
			return redirect()->action('BaseController@getError', ['message' => trans('response.unauthorized')]);

		}
		return redirect()->action('\App\Http\Controllers\Admin\LoginController@getIndex');

	}

	/**
	 * 验证权限
	 *
	 * @author yangyifan <yangyifanphp@gmail.com>
	 */
	private function checkAccess()
	{
		//获得当前路由
		$action = $this->conrtoller->getCurrentAction();

		$all_user_function  = AdminLimitFunctionModel::getUserFunction();
		$all_function       = \DB::table(tableName('admin_function'))->lists('function_name');

		//如果当前权限，没有设定到权限控制表里面，则返回true
		if (in_array($action['controller'], $all_function)) {
			//
			if (!in_array(implode(BaseController::CONNECTION, $action), $all_function) && in_array($action['controller'], $all_user_function)) {
				return true;
			}

			//
			if (in_array(implode(BaseController::CONNECTION, $action), $all_function) && in_array(implode(BaseController::CONNECTION, $action), $all_user_function)) {
				return true;
			}
			return false;
		}
		return true;
	}


}
