<?php

// +----------------------------------------------------------------------
// | date: 2015-07-12
// +----------------------------------------------------------------------
// | NewsController.php: 前台新闻控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Home\BaseController;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Model\Home\UserModel;

use App\Http\Requests\Home\UserLoginRequest;

use App\Http\Requests\Home\UserRegisterRequest;

class NewsController extends BaseController {

	/**
	 * 新闻首页
	 *
	 * @return Response
     * @auther yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(){
        return view('home.news.index', [
			'title'         => '新闻',
			'keywords'      => '新闻',
			'description'   => '新闻',
		]);
	}


}
