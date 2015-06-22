<?php

// +----------------------------------------------------------------------
// | date: 2015-06-07
// +----------------------------------------------------------------------
// | AdminAssessController.php: 后端权限控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\AdminAccessModel as AdminAccessModel;

use App\Http\Requests\Admin\RoleRequest;

use DB;

use Lang;

class AdminAssessController extends AdminBaseController {

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
	 * 获得角色列表
	 *
	 * @return Response
     * @auther yangyifan <yangyifanphp@gmail.com>
	 */
	public function getRole()
	{
        return $this->html_builder->
                builderTitle('角色列表')->
                builderSchema('id', 'id')->
                builderSchema('role_name', '角色名称')->
                builderSchema('status', '状态')->
                builderSchema('created_at', '创建时间')->
                builderSchema('updated_at', '更新时间')->
                builderBotton('编辑', url('admin/access/roleedit'), '###')->
                builderBotton('权限', url('admin/access/roleedit'), '###')->
                builderAddBotton('增加角色', url('admin/access/roleadd'))->
                builderList(AdminAccessModel::role());
	}

	/**
	 * 编辑角色
	 *
	 * @param  int  $id
	 * @auther yangyifan <yangyifanphp@gmail.com>
	 */
	public function getRoleedit($id){
        return $this->html_builder->
                builderTitle('编辑角色')->
                builderFormSchema('id', 'id', 'hidden')->
                builderFormSchema('role_name', '角色名称')->
                builderFormSchema('status', '状态', 'radio', '', '当前角色是否开启，如果关闭，则属于当前角色都不可用', '', '', '', '1:开启|2:关闭', '2')->
                builderConfirmBotton('确认', url('admin/access/roleupdate'), 'btn btn-success')->
                builderEdit(AdminAccessModel::getRoleInfo($id));
	}

    /**
     * 处理更新角色
     *
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function postRoleupdate(RoleRequest $request){
        $id         = $request->get('id');
        $role_name  = $request->get('role_name');
        $status     = $request->get('status');

        $affected_number = DB::table('role')->where('id', '=', $id)->update([
            'role_name' => $role_name,
            'status'    => $status,
        ]);
        //更新成功
        return $this->response(200, Lang::get('response.update_success'), [], false);
    }

    /**
     * 增加角色
     *
     * @param  int  $id
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function getRoleadd(){
        return  $this->html_builder->
                builderTitle('增加角色')->
                builderFormSchema('role_name', '角色名称')->
                builderFormSchema('status', '状态', 'radio', '', '当前角色是否开启，如果关闭，则属于当前角色都不可用', '', '', '', '1:开启|2:关闭', '2')->
                builderConfirmBotton('确认', url('admin/access/roleadd'), 'btn btn-success')->
                builderAdd();
    }

    /**
     * 处理新增角色
     *
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function postRoleadd(RoleRequest $request){
        $role_name  = $request->get('role_name');
        $status     = $request->get('status');

        $affected_number = DB::table('role')->insertGetId([
            'role_name' => $role_name,
            'status'    => $status,
        ]);
        return $affected_number > 0 ? $this->response(200, Lang::get('response.add_success'), [], false) : $this->response(400, Lang::get('response.add_error'), [], false);
    }

}
