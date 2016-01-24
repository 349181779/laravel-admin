<?php

// +----------------------------------------------------------------------
// | date: 2015-06-06
// +----------------------------------------------------------------------
// | LoginController.php: 后端登录控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
<<<<<<< HEAD
use App\Model\Admin\AdminInfoModel;
use App\Http\Requests\Admin\LoginFormRequest;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class LoginController extends BaseController
{
=======

use App\Model\Admin\AdminInfoModel;

use App\Http\Requests\Admin\LoginFormRequest;

use App\Http\Controllers\BaseController;

class LoginController extends BaseController {
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1

    /**
     * 构造方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
<<<<<<< HEAD
    public function __construct(Request $request)
    {
        parent::__construct();
        //判断是否已经登录
        if(isAdminLogin() > 0 ) return header('location:' . createUrl('Admin\HomeController@getIndex'));
=======
    public function __construct(){

>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
    }

	/**
	 * 登录操作
     *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
<<<<<<< HEAD
	public function getIndex()
    {
=======
	public function getIndex(){
        load_func('common');
        //判断是否已经登录
        if(is_admin_login() > 0 ) return redirect(url('admin/home'), 302);
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
        return view('admin.login.login');
	}

	/**
	 * 处理登录操作
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
<<<<<<< HEAD
	public function postLogin(LoginFormRequest $request)
    {

        $data           = $request->all();
        $data['ip']     = $request->ip();
        $login_status   = AdminInfoModel::login($data);

        switch ($login_status) {
            case 1:
                return $this->response(self::SUCCESS_STATE_CODE, trans('response.success'), [], true, url('admin/home'));
=======
	public function postLogin(LoginFormRequest $request){

        $login_status = AdminInfoModel::login($request->all());

        switch($login_status){
            case 1:
                return $this->response(200, trans('response.success'), [], true, url('admin/home'));
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
            case -1:
            case -3:
                return $this->response(401, trans('response.admin_not_exists'));
            case -2:
                return $this->response(401, trans('response.admin_disable'));

        }

        //登陆失败
        return $this->response(401, trans('response.unauthorized'));
	}

}
