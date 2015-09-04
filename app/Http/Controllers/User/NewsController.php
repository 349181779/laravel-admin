<?php

// +----------------------------------------------------------------------
// | date: 2015-07-12
// +----------------------------------------------------------------------
// | NewsController.php: 会员新闻控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\User;

use App\Http\Requests;

use Illuminate\Http\Request;

use App\Model\User\NewsModel;

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

		return view('user.news.index', [
			'all_new'		=> NewsModel::getAllNews($id),
			'all_category'  => NewsModel::getUserCategory(),
			'title'         => '会员-新闻',
			'keywords'      => '会员-新闻',
			'description'   => '会员-新闻',
		]);
	}

	/**
	 * 分类页面
	 *
	 * @return \Illuminate\View\View
	 * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function getCategory(){
		return view('user.news.category', [
			'all_category'  => NewsModel::getUserCategory(),
			'title'         => '新闻',
			'keywords'      => '新闻',
			'description'   => '新闻',
		]);
	}

	/**
	 * 选择分类
	 *
	 * @return \Illuminate\View\View
	 * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function getChoseCategory(){
		return view('user.news.chose', [
			'all_user_category'  => NewsModel::getUserChoseCagetory(),//用户全部分类
			'title'         => '选择分类',
			'keywords'      => '选择分类',
			'description'   => '选择分类',
		]);
	}

	/**
	 * 更新用户新闻分类
	 *
	 * @param Request $request
	 * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function postChoseCategory(Request $request){
		$status = NewsModel::updateUserCategory($request->get('news_cat_id'));
		return $status == true ? $this->response($code = 200, $msg = trans('response.update_user_news_category_success')) : $this->response(400, trans('response.update_user_news_category_error'));
	}


}
