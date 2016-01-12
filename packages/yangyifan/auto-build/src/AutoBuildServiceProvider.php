<?php

// +----------------------------------------------------------------------
// | date: 2016-01-12
// +----------------------------------------------------------------------
// | AutoBuildServiceProvider.php: 自动构建 ServiceProvider
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace Yangyifan\AutoBuild;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class AutoBuildServiceProvider extends ServiceProvider
{

	/**
	 * 指定是否延缓提供者加载。
	 *
	 * @var bool
	 * @author yangyifan <yangyifanphp@gmail.com>
	 */
	protected $defer = false;

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function boot()
	{
		//设置路由
		$this->setupRoutes($this->app->router);
	}

	/**
	 * 在容器中注册绑定
	 *
	 * @return void
	 * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function register()
	{
		$this->app->bind('contact',function($app){
			return new Contact($app);
		});
	}

	/**
	 * 设置路由
	 *
	 * @param Router $router
	 * @author yangyifan <yangyifanphp@gmail.com>
	 */
	private function setupRoutes(Router $router)
	{
		$router->group(['prefix' => "auto-build", 'namespace' => 'Yangyifan\AutoBuild\Http\Controllers'], function($router)
		{
			require __DIR__.'/Http/routes.php';
		});
	}

}
