<?php

// +----------------------------------------------------------------------
// | date: 2015-06-06
// +----------------------------------------------------------------------
// | LoginController.php: 后端登录控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController as BaseController;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Input;

use Lang;

use Validator;

use App\AdminInfoModel as AdminInfo;

class LoginController extends BaseController {

	/**
	 * 登录操作
     *
	 * @return Response
     * @auther yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex()
	{
        return view('admin.login.login');
	}

	/**
	 * 处理登录操作
	 *
	 * @return Response
     * @auther yangyifan <yangyifanphp@gmail.com>
	 */
	public function postLogin()
	{
        $rules = [
            'email'     => ['required'],
            'password'  => ['required'],
            '_token'    => ['required'],
        ];
        $payload    = Input::only('email', 'password', 'remember_me','_token');
        $validator  = Validator::make($payload, $rules);

        if ($validator->fails()) {
            return $this->response(400, $validator->errors()->getMessages());
        }

        $login_status = AdminInfo::login($payload);

        switch($login_status){
            case 1:
                return $this->response(200, Lang::get('response.success'),['href'=>url('admin/index')]);
            case -1:
            case -3:
                return $this->response(401, Lang::get('response.admin_not_exists'));
            case -2:
                return $this->response(401, Lang::get('response.admin_disable'));

        }

        //登陆失败
        return $this->response(401, Lang::get('response.unauthorized'));
	}

}
