<?php

// +----------------------------------------------------------------------
// | date: 2015-07-12
// +----------------------------------------------------------------------
// | NewsController.php: 会员新闻控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\User;

use App\Http\Controllers\User\BaseController;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Model\Home\NewsModel;

class NewsController extends BaseController {

	/**
	 * 新闻首页
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(){
        return view('user.news.index', [
			'all_new'		=> NewsModel::getAllNews(),
			'title'         => '会员-新闻',
			'keywords'      => '会员-新闻',
			'description'   => '会员-新闻',
		]);
	}


}
