<?php

// +----------------------------------------------------------------------
// | date: 2015-06-28
// +----------------------------------------------------------------------
// | AdmininfoController.php: 后端用户控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Requests;

use Illuminate\Http\Request;

use App\Http\Requests\Admin\AdminInfoRequest;

use App\Model\Admin\AdminInfoModel;

use App\Model\Admin\RoleModel;

class AdmininfoController extends BaseController {

    protected $html_builder;

    /**
     * 构造方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct(HtmlBuilderController $html_builder){
        $this->html_builder = $html_builder;
    }

    /**
     * 获得后台用户
     *
     * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getIndex(){
        return  $this->html_builder->
                builderTitle('后台用户列表')->
                builderSchema('id', 'id')->
                builderSchema('email', '登录名')->
                builderSchema('mobile','手机号码')->
                builderSchema('status', '状态')->
                builderSchema('role_name', '角色')->
                builderSchema('created_at', '创建时间')->
                builderSchema('updated_at', '更新时间')->
                builderSchema('handle', '操作')->
                builderSearchSchema('email', '登录名1')->
                builderSearchSchema('mobile', '手机号码')->
                builderSearchSchema($name = 'status', $title = '状态', $type = 'select', $class = '', $option = [1=>'开启', '2'=>'关闭'], $option_value_schema = '0')->
                builderSearchSchema('role_name', '角色')->
                builderAddBotton('增加后台用户', url('admin/admininfo/add'))->
                builderJsonDataUrl(url('admin/admininfo/search'))->
                builderList();
    }

    /**
     * 搜索
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getSearch(Request $request){
        //接受参数
        $search = $request->get('search', '');
        $sort   = $request->get('sort', 'id');
        $order  = $request->get('order', 'asc');
        $limit  = $request->get('limit',0);
        $offset = $request->get('offset', config('config.page_limit'));

        //解析params
        parse_str($search);

        //组合查询条件
        $map = [];
        if(!empty($email)){
            $map['admin_info.email'] = ['like','%'.$email.'%'];
        }
        if(!empty($mobile)){
            $map['admin_info.mobile'] = ['like','%'.$mobile.'%'];
        }
        if(!empty($role_name)){
            $map['r.role_name'] = ['like','%'.$role_name.'%'];
        }
        if(!empty($status)){
            $map['admin_info.status'] = $status;
        }
        $map['admin_info.deleted_at'] = ['=', '0000-00-00 00:00:00'];

        $data = AdminInfoModel::search($map, $sort, $order, $limit, $offset);

        echo json_encode([
            'total' => $data['count'],
            'rows'  => $data['data'],
        ]);
    }


    /**
     * 编辑角色
     *
     * @param  int  $id
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getEdit($id){
        return  $this->html_builder->
                builderTitle('编辑后台用户')->
                builderFormSchema('id', 'id', 'hidden')->
                builderFormSchema('email', '登录邮箱', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'e', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('password', '登录密码', $type = 'password', $default = '',  $notice = '', $class = '', $rule = '')->
                builderFormSchema('mobile', '手机号码', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'm', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('status', '状态', 'radio', '', '当前角色是否开启，如果关闭，则属于当前角色都不可用', '', '', '', [1=>'开启', '2'=>'关闭'], '2')->
                builderFormSchema('face', '头像', 'image')->
                builderFormSchema('role_id', '所属角色', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', RoleModel::getRoleList(), 'role_name')->
                builderConfirmBotton('确认', url('admin/admininfo/edit'), 'btn btn-success')->
                builderEditData(AdminInfoModel::findOrFail($id))->
                builderEdit();
    }

    /**
     * 处理更新角色
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postEdit(AdminInfoRequest $request){
        $data = $request->all();
        $Model  = AdminInfoModel::findOrFail($data['id']);
        if(empty($data['password'])){
            $data['password'] =$Model->password;
        }else{
            $data['password'] = bcrypt($data['password']);
        }
        $Model->update($data);
        //更新成功
        return $this->response(200, trans('response.update_success'), [], true, url('admin/admininfo/index'));
    }


    /**
     * 增加后台用户
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getAdd(){
        return  $this->html_builder->
                builderTitle('增加后台用户')->
                builderFormSchema('email', '登录邮箱', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'e', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('password', '登录密码', $type = 'password')->
                builderFormSchema('mobile', '手机号码', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'm', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('status', '状态', 'radio', '', '当前角色是否开启，如果关闭，则属于当前角色都不可用', '', '', '', [1=>'开启', '2'=>'关闭'], '2')->
                builderFormSchema('face', '头像', 'image')->
                builderFormSchema('role_id', '所属角色', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', RoleModel::getRoleList(), 'role_name')->
                builderConfirmBotton('确认', url('admin/admininfo/add'), 'btn btn-success')->
                builderAdd();
    }

    /**
     * 添加后台用户
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postAdd(AdminInfoRequest $request){
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        //写入数据
        $affected_number = AdminInfoModel::create($data);

        return  $affected_number->id > 0  ? $this->response(200, trans('response.add_success'), [], true, url('admin/admininfo/index')) : $this->response(400, trans('response.add_error'), [], false);
    }

    /**
     * 删除数据
     *
     * @param $id
     * @throws \Exception
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getDelete($id){
        AdminInfoModel::del($id) > 0 ? $this->response(200, trans('response.delete_success'), [], false, url('admin/news/index')) : $this->response(400, trans('response.delete_error'), [], false);
    }


}
