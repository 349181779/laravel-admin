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
<<<<<<< HEAD
use App\Model\Admin\AdminInfoModel;

class HomeController extends BaseController
{

    public function __construct()
    {
=======

use App\Model\Admin\AdminInfoModel;

class HomeController extends BaseController {

    public function __construct(){
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
        parent::__construct();
    }

	/**
	 * 后台首页
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
<<<<<<< HEAD
	public function getIndex()
    {
        return redirect(createUrl('Admin\Order\OrderList\OrderListController@getIndex'));
//        return view('admin.home.index', [
//            'title' => '楼下100后台管理系统',
//        ]);
=======
	public function getIndex(){
        return view('admin.home.index');
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
	}

	/**
	 * 用户退出
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
<<<<<<< HEAD
	public function getLogout()
    {
        AdminInfoModel::logout();
        $this->response(self::SUCCESS_STATE_CODE, trans('response.success'), [], true, createUrl('Admin\LoginController@getIndex'));
=======
	public function getLogout(){
        AdminInfoModel::logout();
        $this->response(200, trans('response.success'), [], true, url('admin/login'));
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
	}

}
