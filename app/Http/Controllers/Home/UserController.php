<?php

// +----------------------------------------------------------------------
// | date: 2015-07-12
// +----------------------------------------------------------------------
// | UserController.php: 前台会员控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Home\BaseController;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Model\Home\UserModel;

use App\Http\Requests\Home\UserLoginRequest;

use App\Http\Requests\Home\UserRegisterRequest;

class UserController extends BaseController {

	/**
	 * 登录
	 *
	 * @return Response
     * @auther yangyifan <yangyifanphp@gmail.com>
	 */
	public function getLogin(){
        return view('home.user.login');
	}

    /**
     * 处理登录操作
     *
     * @return Response
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function postLogin(UserLoginRequest $request){
        $login_status = UserModel::login($request->only('email', 'password', 'readme'));

        switch($login_status){
            case 1:
                return $this->response(200, trans('response.success'),[], true, action('Home\IndexController@getIndex'));
            case -1:
            case -3:
                return $this->response(401, trans('response.admin_not_exists'));
            case -2:
                return $this->response(401, trans('response.admin_disable'));

        }
        //登陆失败
        return $this->response(401, trans('response.unauthorized'));
    }

    /**
     * 用户退出
     *
     * @return Response
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function getLogout(){
        UserModel::logout();
        $this->response(200, trans('response.success'), [], true, action('Home\IndexController@getIndex'));
    }

    /**
     * 注册
     *
     * @return Response
     */
    public function getRegister(){
        return view('home.user.register');
    }

    /**
     * 处理注册操作
     *
     * @return Response
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function postRegister(UserRegisterRequest $request){
        $input = $request->only('email', 'mobile', 'verify', 'password', 'password_confirmation');
        //写入数据
        $affected_number = UserModel::register($input);
        return $affected_number->id > 0 ? $this->response(200, trans('response.add_success'), [], true, action('Home\UserController@getLogin')) : $this->response(400, trans('response.add_error'), [], true);
    }

}
