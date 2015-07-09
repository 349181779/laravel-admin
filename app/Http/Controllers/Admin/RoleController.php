<?php

// +----------------------------------------------------------------------
// | date: 2015-06-07
// +----------------------------------------------------------------------
// | RoleController.php: 后端权限控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\AdminRoleModel;

use App\Http\Requests\Admin\RoleRequest;

class RoleController extends BaseController {

    protected $html_builder;

    /**
     * 构造方法
     *
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct(HtmlBuilderController $html_builder){
        $this->html_builder = $html_builder;
    }

	/**
	 * 获得角色列表
	 *
	 * @return Response
     * @auther yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(){
        return $this->html_builder->
                builderTitle('角色列表')->
                builderSchema('id', 'id')->
                builderSchema('role_name', '角色名称')->
                builderSchema('status', '状态')->
                builderSchema('created_at', '创建时间')->
                builderSchema('updated_at', '更新时间')->
                builderSchema('handle', '操作')->
                builderSearchSchema('role_name', '角色名称')->
                builderSearchSchema($name = 'status', $title = '状态', $type = 'select', $class = '', $option = [1=>'开启', '2'=>'关闭'], $option_value_schema = '0')->
                builderAddBotton('增加角色', url('admin/role/add'))->
                builderJsonDataUrl(url('admin/role/search'))->
                builderList();
	}

    /**
     * 搜索
     *
     * @param Request $request
     */
    public function getSearch(Request $request){
        //接受参数
        $search     = $request->get('search', '');
        $sort       = $request->get('sort', 'id');
        $order      = $request->get('order', 'asc');
        $limit      = $request->get('limit', 0);
        $offset     = $request->get('offset', config('config.page_limit'));

        //解析params
        parse_str($search);

        //组合查询条件
        $map = [];
        if(!empty($role_name)){
            $map['role_name'] = ['like', '%'.$role_name.'%'];
        }
        if(!empty($status)){
            $map['status'] = $status;
        }

        $data = AdminRoleModel::search($map, $sort, $order, $limit, $offset);
        echo json_encode([
            'total' => $data['count'],
            'rows'  => $data['data'],
        ]);
    }

	/**
	 * 编辑角色
	 *
	 * @param  int  $id
	 * @auther yangyifan <yangyifanphp@gmail.com>
	 */
	public function getEdit($id){
        return $this->html_builder->
                builderTitle('编辑角色')->
                builderFormSchema('id', 'id', 'hidden')->
                builderFormSchema('role_name', '角色名称')->
                builderFormSchema('status', '状态', 'radio', '', '当前角色是否开启，如果关闭，则属于当前角色都不可用', '', '', '', [1=>'开启', '2'=>'关闭'], '2')->
                builderConfirmBotton('确认', url('admin/role/edit'), 'btn btn-success')->
                builderEdit(AdminRoleModel::getRoleInfo($id));
	}

    /**
     * 处理更新角色
     *
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function postEdit(RoleRequest $request){
        $data   = $request->all();
        $Model  = AdminRoleModel::findOrFail($data['id']);
        $Model->fill($data);
        $Model->save();
        //更新成功
        return $this->response(200, trans('response.update_success'), [], true, url('admin/role/index'));
    }

    /**
     * 增加角色
     *
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function getAdd(){
        return  $this->html_builder->
                builderTitle('增加角色')->
                builderFormSchema('role_name', '角色名称')->
                builderFormSchema('status', '状态', 'radio', '', '当前角色是否开启，如果关闭，则属于当前角色都不可用', '', '', '', [1=>'开启', '2'=>'关闭'], '2')->
                builderConfirmBotton('确认', url('admin/role/add'), 'btn btn-success')->
                builderAdd();
    }

    /**
     * 处理新增角色
     *
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function postAdd(RoleRequest $request){
        $affected_number    = AdminRoleModel::create($request->all());
        return $affected_number->id > 0  ? $this->response(200, trans('response.add_success'), [], true, url('admin/role/index')) : $this->response(400, trans('response.add_error'), [], false);
    }

}
