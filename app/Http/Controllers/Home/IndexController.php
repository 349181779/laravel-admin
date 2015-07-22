<?php

// +----------------------------------------------------------------------
// | date: 2015-07-12
// +----------------------------------------------------------------------
// | IndexController.php: 前台首页控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Home\BaseController;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Model\Home\IndexModel;

class IndexController extends BaseController {

	/**
	 * 网址首页
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(){
        return view('home.index.index', [
            'all_site'      => IndexModel::getAllSite(),
            'title'         => '首页',
            'keywords'      => '首页',
            'description'   => '首页',
        ]);
	}

    /**
     * 网址分类
     *
     * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getCategory(Request $request, $cat_id){
        return view('home.index.category', [
            'all_site'      => IndexModel::getCategorySite((int)$cat_id),
            'title'         => '网址分类',
            'keywords'      => '网址分类',
            'description'   => '网址分类',
        ]);
    }

}
