<?php

// +----------------------------------------------------------------------
// | date: 2015-06-07
// +----------------------------------------------------------------------
// | AdminAssessController.php: 后端权限控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\AdminAccessModel as AdminAccessModel;

class AdminAssessController extends AdminBaseController {

    protected $html_builder;

    /**
     * 构造方法
     *
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct(){
        $this->html_builder = new AdminHtmlBuilderController();
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
                builderBotton('编辑', url('admin/access/editRole'), '###')->
                builderBotton('权限', url('admin/access/edit_role'), '###')->
                builderList(AdminAccessModel::role());
	}

	/**
	 * 提交角色
	 *
	 * @param  int  $id
	 * @auther yangyifan <yangyifanphp@gmail.com>
	 */
	public function getEditRole($role_id){
		return $this->html_builder->
                builderTitle('编辑角色')->
                builderSchema('id', 'id')->
                builderSchema('role_name', '角色名称')->
                builderSchema('status', '状态')->
                builderSchema('created_at', '创建时间')->
                builderSchema('updated_at', '更新时间')->
                builderBotton('编辑', url('admin/access/role_save'))->
                builderBotton('权限', url('admin/access/edit_role'))->
                builderList(AdminAccessModel::getRoleInfo($role_id));
	}

}
