<?php

// +----------------------------------------------------------------------
// | date: 2015-08-21
// +----------------------------------------------------------------------
// | HtmlDomProvider.php: 采集服务提供者
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Library\simple_html_dom;

class HtmlDomProvider extends ServiceProvider {

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
		$this->app->bind('App\Library\simple_html_dom', function($app){
            return new simple_html_dom();
        });
	}

}
