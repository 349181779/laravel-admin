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

use Session;

class UserController extends BaseController {

	/**
	 * 登录
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function getLogin(){
        //保存上次访问页面
        Session::put('HTTP_REFERER', $_SERVER['HTTP_REFERER']);

        return view('home.user.login', [
            'title'         => '登录',
            'keywords'      => '登录',
            'description'   => '登录',
        ]);
	}

    /**
     * 处理登录操作
     *
     * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postLogin(UserLoginRequest $request){
        $login_status = UserModel::login($request->only('email', 'password', 'readme'));

        switch($login_status){
            case 1:
                $url = !empty(Session::get('HTTP_REFERER')) ? Session::get('HTTP_REFERER') : action('User\IndexController@getIndex');
                return $this->response(200, trans('response.success'),[], true, $url);
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
     * 保用用户信息到redis
     *
     * @param Requests $requests
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getSaveUserInfo(Request $requests){
        $user_info = unserialize(urldecode($requests->get('user_info')));
        //保存用户信息到redis hash表
        load_func('instanceof,swoole');
        //返回状态
        get_redis()->hSet(config('config.user_list_hash_table'), $user_info->id, serialize($user_info)) != false ? $this->response(200, 'success') : $this->response(400, trans('response.save_user_info_to_redis_error'));
    }

    /**
     * 用户退出
     *
     * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
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
        return view('home.user.register', [
            'title'         => '注册',
            'keywords'      => '注册',
            'description'   => '注册',
        ]);
    }

    /**
     * 处理注册操作
     *
     * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postRegister(UserRegisterRequest $request){
        $input = $request->only('email', 'password');
        //写入数据
        $affected_number = UserModel::register($input);
        return $affected_number > 0 ? $this->response(200, trans('response.register_success'), [], true, action('Home\UserController@getLogin')) : $this->response(400, trans('response.register_error'), [], true);
    }

    /**
     * 用户协议
     *
     * @return \Illuminate\View\View
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getAgree(){
        return view('home.user.agree', [
            'title'         => '用户协议',
            'keywords'      => '用户协议',
            'description'   => '用户协议',
        ]);
    }

}
