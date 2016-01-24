<?php

// +----------------------------------------------------------------------
// | date: 2015-08-22
// +----------------------------------------------------------------------
// | HproseProvider.php: 高性能远程对象服务引擎服务提供者
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

<<<<<<< HEAD
class HproseProvider extends ServiceProvider
{
=======
class HproseProvider extends ServiceProvider {
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1

    /**
     * 指定是否延迟加载
     *
     * @var bool
     */
    protected $defer = true;

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		require_once app_path() .  '/Library/Hprose/Hprose.php';

		$this->app->bind('\Hprose\Http\Client', function($app){
			//注册对象
			return new Client();
        });

		$this->app->bind('\Hprose\Http\Server', function($app){
			//注册对象
			return new Server();
		});
	}

}
