<?php

// +----------------------------------------------------------------------
// | date: 2015-07-12
// +----------------------------------------------------------------------
// | IndexController.php: 前台首页控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Home;

use App\Http\Requests;

use Illuminate\Http\Request;

use App\Model\Home\IndexModel;

use App\Model\Admin\SiteCatModel;

use App\Model\Admin\SiteModel;

use App\Http\Requests\Admin\SiteRequest;

use App\Http\Requests\Admin\SearchCatRequest;

use App\Model\Home\AppModel;

use App\Model\Home\QueryModel;

use Session;

class IndexController extends BaseController {

	/**
	 * 网址首页
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(){
        return view('home.index.index', [
            'all_site'              => IndexModel::getAllSite(),
            'title'                 => '首页',
            'keywords'              => '首页',
            'description'           => '首页',
        ]);
	}

    /**
     * 网址分类
     *
     * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getCategory(Request $request){

        return view('home.index.category', [
            'all_site_category'     => IndexModel::getAllCategory(),
            'all_app_category'      => AppModel::getAllCategory(),
            'app_query_category'    => QueryModel::getAllCategory(),
            'title'         => '网址分类',
            'keywords'      => '网址分类',
            'description'   => '网址分类',
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
        return view('home.index.add_site', [
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
        if(Session::get('admin_info.id') > 0 ){
            $data = $request->all();
            //写入当前用户到数据
            $data['admin_info_id'] = $request->get('admin_info_id', Session::get('admin_info.id'));
            //写入数据
            $affected_number = SiteModel::create($data);
            return  $affected_number->id > 0  ? $this->response(200, trans('response.add_success'), [], false, url('admin/site/index')) : $this->response(400, trans('response.add_error'), [], false);
        }
    }

    /**
     * 添加网址分类
     *
     * @return \Illuminate\View\View
     */
    public function getAddSiteCategory(){
        return view('home.index.add_site_category');
    }

    /**
     * 添加网址分类
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postSiteCategory(SearchCatRequest $request){
        if(Session::get('admin_info.id') > 0 ){
            //写入数据
            $affected_number = SiteCatModel::create($request->all());
            return  $affected_number->id > 0  ? $this->response(200, trans('response.add_success'), [], false, url('admin/site/index')) : $this->response(400, trans('response.add_error'), [], false);
        }
    }
}
