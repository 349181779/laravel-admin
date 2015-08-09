<?php

// +----------------------------------------------------------------------
// | date: 2015-07-26
// +----------------------------------------------------------------------
// | IndexController.php: 会员首页控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\User;

use App\Http\Controllers\User\BaseController;

use App\Http\Requests;

use Illuminate\Http\Request;

use App\Model\User\IndexModel;

class IndexController extends BaseController {

	/**
	 * 网址首页
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(){
        return view('user.index.index', [
            'all_site'      => IndexModel::getAllSite(),
            'title'         => '会员-首页',
            'keywords'      => '会员-首页',
            'description'   => '会员-首页',
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
            'title'         => '会员-网址分类',
            'keywords'      => '会员-网址分类',
            'description'   => '会员-网址分类',
        ]);
    }

}
