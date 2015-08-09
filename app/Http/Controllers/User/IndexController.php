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
        return view('user.index.category', [
            'all_site'      => IndexModel::getCategorySite((int)$cat_id),
            'title'         => '会员-网址分类',
            'keywords'      => '会员-网址分类',
            'description'   => '会员-网址分类',
        ]);
    }

    /**
     * 添加网址
     *
     * @return \Illuminate\View\View
     */
    public function getAddSite(){
        return view('user.index.add_site', [
            'all_cat' => SiteCatModel::getAllForSchemaOption('cat_name')
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
        return view('user.index.add_site_category');
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
            return  $affected_number->id > 0  ? $this->response(200, trans('response.add_success'), [], false) : $this->response(400, trans('response.add_error'), [], false);
        }
    }

}
