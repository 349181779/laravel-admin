<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Input,Auth;

class LoginController extends Controller {

	/**
	 * 登录操作
	 *
	 * @return Response
	 */
	public function getIndex()
	{
        return view('admin.login.login');
	}

	/**
	 * 处理登录操作
	 *
	 * @return Response
	 */
	public function postLogin()
	{
        $email      = Input::get('email');
        $password   = Input::get('password');
//        if (Auth::attempt(['email' => $email, 'password' => $password]))
//        {
            return redirect()->intended('admin/home');
//        }

        //登陆失败
       return redirect()->intended('admin/login');
	}

}
