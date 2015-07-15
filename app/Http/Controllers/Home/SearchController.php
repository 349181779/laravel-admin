<?php

// +----------------------------------------------------------------------
// | date: 2015-07-12
// +----------------------------------------------------------------------
// | SearchController.php: 前台搜索控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Home\BaseController;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Model\Home\SearchModel;

use Illuminate\Http\Request;

class SearchController extends BaseController {

	/**
	 * 搜索首页
	 *
	 * @return Response
     * @auther yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(){
        return view('home.search.index');
	}

    /**
     * 获得指定搜索下面信息
     *
     * @param Request $request
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function postSearchInfo(Request $request){
        if ($request->isMethod('post')){
            $data = SearchModel::getSearchInfo($request->get('id', 1));
            return !empty($data) ? $this->response(200, 'success', $data, false) : $this->response(400, trans('response.search_error'), [], false);
        }
    }

}
