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

class BaseMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		//判断 是否登陆
		if (isAdminLogin() <= 0)
		{
			return redirect()->action('\App\Http\Controllers\Admin\LoginController@getIndex');
		}

		return $next($request);
	}

}
