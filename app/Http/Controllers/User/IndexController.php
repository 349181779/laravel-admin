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

use App\Model\User\SiteCatModel;

use App\Model\User\SiteModel;

use App\Http\Requests\Admin\SearchCatRequest;

use App\Http\Requests\User\SiteRequest;

use Session;

use Route;

class IndexController extends BaseController {

    /**
     * 构造方法
     *
     */
    public function __construct(){
        parent::__construct();

    }
	/**
	 * 网址首页
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(){ dd(\Route::currentRouteName());
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
    public function getCategory(Request $request){
        return view('user.index.category', [
            'all_site_category'     => IndexModel::getAllCategory(),
            'title'                 => '会员-网址分类',
            'keywords'              => '会员-网址分类',
            'description'           => '会员-网址分类',
        ]);
    }

    /**
     * 网址分类详细列表
     *
     * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getInfo(Request $request, $cat_id){
        return view('home.index.info', [
            'all_site'      => IndexModel::getCategorySite((int)$cat_id),
            'title'         => '网址分类',
            'keywords'      => '网址分类',
            'description'   => '网址分类',
        ]);
    }

    /**
     * 添加网址
     *
     * @return \Illuminate\View\View
     */
    public function getAddSite(){
        return view('user.index.add_site', [
            'all_cat' => SiteCatModel::getAllForSchemaOption('cat_name', 0, false)
        ]);
    }

    /**
     * 添加网址
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postSiteAdd(SiteRequest $request){
        $data = $request->all();
        //写入数据
        $affected_number = SiteModel::create($data);
        return  $affected_number->id > 0  ? $this->response(200, trans('response.add_success'), [], false) : $this->response(400, trans('response.add_error'), [], false);
    }

    /**
     * 添加网址分类
     *
     * @return \Illuminate\View\View
     */
    public function getAddSiteCategory(){
        return view('user.index.add_site_category');
    }

    /**
     * 添加网址分类
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postSiteCategory(SearchCatRequest $request){
        $data = $request->all();
        //加载函数库
        load_func('common');
        $data['user_info_id'] = is_user_login();

        $affected_number = SiteCatModel::create($data);
        return  $affected_number->id > 0  ? $this->response(200, trans('response.add_success'), [], false) : $this->response(400, trans('response.add_error'), [], false);
    }

}
