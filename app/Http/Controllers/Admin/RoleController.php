<?php

// +----------------------------------------------------------------------
// | date: 2015-06-07
// +----------------------------------------------------------------------
// | RoleController.php: 后端权限控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Model\Admin\RoleModel;

use App\Http\Requests\Admin\RoleRequest;

use App\Model\Admin\MenuModel;

use App\Model\Admin\AccessModel;

class RoleController extends BaseController {

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
	 * 获得角色列表
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
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
        $map['deleted_at'] = ['=', '0000-00-00 00:00:00'];

        $data = RoleModel::search($map, $sort, $order, $limit, $offset);
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
        return $this->html_builder->
                builderTitle('编辑角色')->
                builderFormSchema('id', 'id', 'hidden')->
                builderFormSchema('role_name', '角色名称')->
                builderFormSchema('status', '状态', 'radio', '', '当前角色是否开启，如果关闭，则属于当前角色都不可用', '', '', '', [1=>'开启', '2'=>'关闭'], '2')->
                builderConfirmBotton('确认', url('admin/role/edit'), 'btn btn-success')->
                builderEditData(RoleModel::getRoleInfo($id))->
                builderEdit();
	}

    /**
     * 处理更新角色
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postEdit(RoleRequest $request){
        $Model  = RoleModel::findOrFail($request->get('id'));
        $Model->fill($request->all());
        $Model->save();
        //更新成功
        return $this->response(200, trans('response.update_success'), [], true, url('admin/role/index'));
    }

    /**
     * 增加角色
     *
     * @author yangyifan <yangyifanphp@gmail.com>
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
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postAdd(RoleRequest $request){
        $affected_number    = RoleModel::create($request->all());
        return $affected_number->id > 0  ? $this->response(200, trans('response.add_success'), [], true, url('admin/role/index')) : $this->response(400, trans('response.add_error'), [], false);
    }

    /**
     * 删除数据
     *
     * @param $id
     * @throws \Exception
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getDelete($id){
        RoleModel::del($id) > 0 ? $this->response(200, trans('response.delete_success'), [], false, url('admin/news/index')) : $this->response(400, trans('response.delete_error'), [], false);
    }

    /**
     * 获得当前用户权限
     *
     * @return \Illuminate\View\View
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getAccess(Request $request, $role_id){
        return view('admin.menu.user', [
            'all_user_menu' => AccessModel::getFullUserMenu($role_id),
            'role_id'       => $role_id,
        ]);
    }

    /**
     * 编辑用户权限
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postAccess(Request $request){
        $status = AccessModel::updateUserAccess($request->get('menu_id'), $request->get('role_id', null));
        return $status == true ? $this->response($code = 200, $msg = trans('response.update_user_access_success')) : $this->response(400, trans('response.update_user_access_error'));

    }

}
