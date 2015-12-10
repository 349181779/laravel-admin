<?php

// +----------------------------------------------------------------------
// | date: 2015-12-09
// +----------------------------------------------------------------------
// | AdminTopMenuCommand.php: 生产后台顶部菜单缓存 命令
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Commands\Admin;

use App\Commands\Command;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use App\Model\Admin\Admin\AdminMenuModel;
use App\Model\Admin\Admin\AdminLimitModel;

class AdminTopMenuCommand extends Command implements SelfHandling, ShouldBeQueued
{

	use InteractsWithQueue, SerializesModels;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		//获得全部角色
		$all_limit = AdminLimitModel::getAllLimit();

		if (!empty($all_limit)) {
			foreach ($all_limit as $limit) {
				//生产缓存
				AdminMenuModel::getAdminTopMenu($limit->id);
			}
		}
	}

}
