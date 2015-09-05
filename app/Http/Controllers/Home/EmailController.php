<?php

// +----------------------------------------------------------------------
// | date: 2015-07-12
// +----------------------------------------------------------------------
// | EmailController.php: 前台邮箱控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Home;

use App\Http\Requests;

use App\Model\Home\EmailModel;

class EmailController extends BaseController {

	/**
	 * 网址首页
	 *
	 * @return Response
	 * @auther yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(){
		return view('home.email.index', [
			'all_email'		=> EmailModel::getAllEmail(),
			'title'         => '邮箱',
			'keywords'      => '邮箱',
			'description'   => '邮箱',
		]);
	}

}
