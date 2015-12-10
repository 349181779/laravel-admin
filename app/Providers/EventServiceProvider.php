<?php namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
			'event.name' => [
					'EventListener',
			],
			'App\Events\Admin\Cache\LocationEvent' => [
					'App\Listeners\Admin\Cache\LocationListener'
			],
			'App\Events\Admin\Cache\AdminTopMenuEvent' => [
					'App\Listeners\Admin\Cache\AdminTopMenuListener'
			],
			'App\Events\Admin\Cache\AdminChildMenuEvent' => [
					'App\Listeners\Admin\Cache\AdminChildMenuListener'
			],
	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		//
	}

}
