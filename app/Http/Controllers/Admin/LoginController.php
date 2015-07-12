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

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Model\Admin\AdminInfoModel;

use App\Http\Requests\Admin\LoginFormRequest;

use App\Http\Controllers\BaseController;

class LoginController extends BaseController {

	/**
	 * 登录操作
     *
	 * @return Response
     * @auther yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(){
        return view('admin.login.login');
	}

	/**
	 * 处理登录操作
	 *
	 * @return Response
     * @auther yangyifan <yangyifanphp@gmail.com>
	 */
	public function postLogin(LoginFormRequest $request){

        $login_status = AdminInfoModel::login($request->all());

        switch($login_status){
            case 1:
                return $this->response(200, trans('response.success'),[], true, url('admin/home'));
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
