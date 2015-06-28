<?php

// +----------------------------------------------------------------------
// | date: 2015-06-28
// +----------------------------------------------------------------------
// | AdmininfoController.php: 后端用户控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\admin;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\AdminInfoModel;

use App\AdminRoleModel;

use DB;

use Lang;

class AdmininfoController extends AdminBaseController {

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
     * 获得后台用户
     *
     * @return Response
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function getIndex(){
        return  $this->html_builder->
                builderTitle('后台用户列表')->
                builderSchema('id', 'id')->
                builderSchema('email', '登录名')->
                builderSchema('mobile','手机号码')->
                builderSchema('status', '状态')->
                builderSchema('face', '头像')->
                builderSchema('role_name', '角色')->
                builderSchema('created_at', '创建时间')->
                builderSchema('updated_at', '更新时间')->
                builderBotton('编辑', url('admin/admininfo/edit'), '' , '###')->
                builderAddBotton('增加后台用户', url('admin/admininfo/add'))->
                builderList(AdminInfoModel::getAdminList());
    }

    /**
     * 编辑角色
     *
     * @param  int  $id
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function getEdit($id){
        return  $this->html_builder->
                builderTitle('编辑后台用户')->
                builderFormSchema('id', 'id', 'hidden')->
                builderFormSchema('email', '登录邮箱', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'e', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('password', '登录密码', $type = 'password')->
                builderFormSchema('mobile', '手机号码', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'm', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('status', '状态', 'radio', '', '当前角色是否开启，如果关闭，则属于当前角色都不可用', '', '', '', [1=>'开启', '2'=>'关闭'], '2')->
                builderFormSchema('face', '头像')->
                builderFormSchema('role_id', '所属角色', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', AdminRoleModel::getRoleList(), 'role_name')->
                builderConfirmBotton('确认', url('admin/admininfo/edit'), 'btn btn-success')->
                builderEdit(AdminInfoModel::findAdminInfo($id));
    }

    /**
     * 处理更新角色
     *
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function postEdit(Request $request){
        $id         = $request->get('id');
        $email      = $request->get('email');
        $password   = $request->get('password');
        $mobile     = $request->get('mobile');
        $status     = $request->get('status');
        $face       = $request->get('face');
        $role_id    = $request->get('role_id');

        $affected_number = DB::table('admin_info')->where('id', '=', $id)->update([
            'email'     => $email,
            'password'  => password_encrypt($password),
            'mobile'    => $mobile,
            'status'    => $status,
            'face'      => $face,
            'role_id'   => $role_id,
        ]);
        //更新成功
        return $this->response(200, Lang::get('response.update_success'), [], false);
    }


    /**
     * 增加后台用户
     *
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function getAdd(){
        return  $this->html_builder->
                builderTitle('增加后台用户')->
                builderFormSchema('email', '登录邮箱', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'e', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('password', '登录密码', $type = 'password')->
                builderFormSchema('mobile', '手机号码', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'm', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('status', '状态', 'radio', '', '当前角色是否开启，如果关闭，则属于当前角色都不可用', '', '', '', [1=>'开启', '2'=>'关闭'], '2')->
                builderFormSchema('face', '头像')->
                builderFormSchema('role_id', '所属角色', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', AdminRoleModel::getRoleList(), 'role_name')->
                builderConfirmBotton('确认', url('admin/admininfo/add'), 'btn btn-success')->
                builderAdd();
    }

    /**
     * 添加后台用户
     *
     * @param Request $request
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function postAdd(Request $request){
        $email      = $request->get('email');
        $password   = $request->get('password');
        $mobile     = $request->get('mobile');
        $status     = $request->get('status');
        $face       = $request->get('face');
        $role_id    = $request->get('role_id');

        //加载函数库
        load_func('common');

        $affected_number = DB::table('admin_info')->insertGetId([
            'email'     => $email,
            'password'  => password_encrypt($password),
            'mobile'    => $mobile,
            'status'    => $status,
            'face'      => $face,
            'role_id'   => $role_id,
        ]);
        return $affected_number > 0 ? $this->response(200, Lang::get('response.add_success'), [], false) : $this->response(400, Lang::get('response.add_error'), [], false);
    }



}
