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

use App\Model\Home\NewsModel;

class NewsController extends BaseController {

	/**
	 * 新闻首页
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(Request $request){
		$id = $request->get('id');
		$id = $id > 0 ? (int)$id : 1;

		return view('home.news.index', [
			'all_new'		=> NewsModel::getAllNews($id),
			'all_category'  => NewsModel::getAllCategory(),
			'title'         => '新闻',
			'keywords'      => '新闻',
			'description'   => '新闻',
		]);
	}

	public function getCategory(){
		return view('home.news.category', [
			'all_category'  => NewsModel::getAllCategory(),
			'title'         => '新闻',
			'keywords'      => '新闻',
			'description'   => '新闻',
		]);
	}


}
