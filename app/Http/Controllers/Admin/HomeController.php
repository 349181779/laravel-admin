<?php

// +----------------------------------------------------------------------
// | date: 2015-06-06
// +----------------------------------------------------------------------
// | HomeController.php: 后端首页控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Requests;

use App\Model\Admin\AdminInfoModel;

class HomeController extends BaseController {

    public function __construct(){
        parent::__construct();
    }

	/**
	 * 后台首页
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(){
        return view('admin.home.index');
	}

	/**
	 * 用户退出
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function getLogout(){
        AdminInfoModel::logout();
        $this->response(200, trans('response.success'), [], true, url('admin/login'));
	}

}
