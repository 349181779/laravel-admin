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
use App\Model\Admin\AdminInfoModel;
use App\Http\Requests\Admin\LoginFormRequest;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class LoginController extends BaseController
{

    /**
     * 构造方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct(Request $request)
    {
        parent::__construct();
        //判断是否已经登录
        if(isAdminLogin() > 0 ) return header('location:' . createUrl('Admin\HomeController@getIndex'));
    }

	/**
	 * 登录操作
     *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex()
    {
        return view('admin.login.login');
	}

	/**
	 * 处理登录操作
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function postLogin(LoginFormRequest $request)
    {

        $data           = $request->all();
        $data['ip']     = $request->ip();
        $login_status   = AdminInfoModel::login($data);

        switch ($login_status) {
            case 1:
                return $this->response(self::SUCCESS_STATE_CODE, trans('response.success'), [], true, url('admin/home'));
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
