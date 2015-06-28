<?php

// +----------------------------------------------------------------------
// | date: 2015-06-28
// +----------------------------------------------------------------------
// | UserInfoController.php: 前端用户控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use DB;

use Lang;

use App\AdminUserInfoModel;

class UserInfoController extends AdminBaseController {

    protected $html_builder;

    /**
     * 构造方法
     *
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct(AdminHtmlBuilderController $html_builder){
        $this->html_builder = $html_builder;
    }

	/**
	 * 获得前台用户
	 *
	 * @return Response
     * @auther yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(){
        return  $this->html_builder->
                builderTitle('会员列表')->
                builderSchema('id', 'id')->
                builderSchema('user_name', '昵称')->
                builderSchema('email', '登录名')->
                builderSchema('mobile','手机号码')->
                builderSchema('status', '状态')->
                builderSchema('sex', '性别')->
                builderSchema('birthday', '生日')->
                builderSchema('face', '头像')->
                builderSchema('created_at', '创建时间')->
                builderSchema('updated_at', '更新时间')->
                builderBotton('编辑', url('admin/userinfo/edit'), '' , '###')->
                builderAddBotton('增加后台用户', url('admin/userinfo/add'))->
                builderList(AdminUserInfoModel::getUser());
	}

    /**
     * 编辑会员
     *
     * @param  int  $id
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function getEdit($id){
        return  $this->html_builder->
                builderTitle('编辑会员')->
                builderFormSchema('id', 'id', 'hidden')->
                builderFormSchema('user_name', '昵称')->
                builderFormSchema('email', '登录邮箱', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'e', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('password', '登录密码', $type = 'password')->
                builderFormSchema('mobile', '手机号码', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'm', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('status', '状态', 'radio', '', '当前角色是否开启，如果关闭，则属于当前角色都不可用', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderFormSchema('sex', '性别', 'radio', '', '', '', '', '', [1=>'男', '2'=>'女', '3'=>'未知'], '3')->
                builderFormSchema('birthday', '生日', 'date')->
                builderFormSchema('face', '头像')->
                builderConfirmBotton('确认', url('admin/userinfo/edit'), 'btn btn-success')->
                builderEdit(AdminUserInfoModel::find($id));
    }

    /**
     * 处理更新会员
     *
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function postEdit(Request $request){
        $id         = $request->get('id');
        $user_name  = $request->get('user_name');
        $email      = $request->get('email');
        $password   = $request->get('password');
        $mobile     = $request->get('mobile');
        $status     = $request->get('status');
        $sex        = $request->get('sex');
        $birthday   = $request->get('birthday');
        $face       = $request->get('face');

        $affected_number = DB::table('user_info')->where('id', '=', $id)->update([
            'user_name' => $user_name,
            'email'     => $email,
            'password'  => password_encrypt($password),
            'mobile'    => $mobile,
            'status'    => $status,
            'sex'       => $sex,
            'birthday'  => $birthday,
            'face'      => $face,
        ]);
        //更新成功
        return $this->response(200, Lang::get('response.update_success'), [], false);
    }

    /**
     * 增加会员
     *
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function getAdd(){
        return  $this->html_builder->
                builderTitle('增加会员')->
                builderFormSchema('user_name', '昵称')->
                builderFormSchema('email', '登录邮箱', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'e', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('password', '登录密码', $type = 'password')->
                builderFormSchema('mobile', '手机号码', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'm', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('status', '状态', 'radio', '', '当前角色是否开启，如果关闭，则属于当前角色都不可用', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderFormSchema('sex', '性别', 'radio', '', '', '', '', '', [1=>'男', '2'=>'女', '3'=>'未知'], '3')->
                builderFormSchema('birthday', '生日', 'date')->
                builderFormSchema('face', '头像')->
                builderConfirmBotton('确认', url('admin/userinfo/add'), 'btn btn-success')->
                builderAdd();
    }

    /**
     * 添加会员
     *
     * @param Request $request
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function postAdd(Request $request){
        $user_name  = $request->get('user_name');
        $email      = $request->get('email');
        $password   = $request->get('password');
        $mobile     = $request->get('mobile');
        $status     = $request->get('status');
        $sex        = $request->get('sex');
        $birthday   = $request->get('birthday');
        $face       = $request->get('face');

        //加载函数库
        load_func('common');

        $affected_number = DB::table('user_info')->insertGetId([
            'user_name' => $user_name,
            'email'     => $email,
            'password'  => password_encrypt($password),
            'mobile'    => $mobile,
            'status'    => $status,
            'sex'       => $sex,
            'birthday'  => $birthday,
            'face'      => $face,
        ]);
        return $affected_number > 0 ? $this->response(200, Lang::get('response.add_success'), [], false) : $this->response(400, Lang::get('response.add_error'), [], false);
    }
}
