<?php namespace App\Events\Admin\Cache;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use App\Commands\Admin\AdminTopMenuCommand;

class AdminTopMenuEvent extends Event {

	use SerializesModels;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->handle();
	}

	public function handle()
	{
		\Bus::dispatch(
			new AdminTopMenuCommand()
		);
		return true;
	}

}
