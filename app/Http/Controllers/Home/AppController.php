<?php

// +----------------------------------------------------------------------
// | date: 2015-07-12
// +----------------------------------------------------------------------
// | AppController.php: 前台应用控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Home\BaseController;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Model\Home\AppModel;

class AppController extends BaseController {

	/**
	 * 应用首页
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(){
        return view('home.app.index', [
			'all_app'      => AppModel::getAllApp(),
			'title'         => '应用',
			'keywords'      => '应用',
			'description'   => '应用',
		]);
	}

	/**
	 * App分类
	 *
	 * @return Response
	 * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function getCategory(Request $request, $cat_id){
		return view('home.app.category', [
			'all_app'      => AppModel::getCategory((int)$cat_id),
			'title'         => '应用分类',
			'keywords'      => '应用分类',
			'description'   => '应用分类',
		]);
	}

}
