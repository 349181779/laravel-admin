<?php

// +----------------------------------------------------------------------
// | date: 2015-06-22
// +----------------------------------------------------------------------
// | MenuController.php: 后端导航菜单控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\MenuModel as MenuModel;

use App\Http\Requests\Admin\RoleRequest;

use DB;

use Lang;

class MenuController extends AdminBaseController {

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
	public function getIndex()
	{
        //加载函数库
        load_func('common');
        return View('admin.menu.index',['all_menu'=> merge_tree_node(obj_to_array(MenuModel::all())) ]);
	}

    /**
     * 编辑角色
     *
     * @param  int  $id
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function getMenuedit($id){
        //获得菜单信息
        $menu_info = MenuModel::getAllForSchemaOption();

        return  $this->html_builder->
                builderTitle('编辑菜单')->
                builderFormSchema('id', 'id', 'hidden')->
                builderFormSchema('menu_name', '菜单名称')->
                builderFormSchema('pid', '父级菜单', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', $menu_info['ids'], $menu_info['menus'])->
                builderFormSchema('status', '状态', 'radio', '', '', '', '', '', '1:开启|2:关闭', '2')->
                builderFormSchema('icon', '菜单icon')->
                builderFormSchema('url', '菜单url')->
                builderFormSchema('sort', '菜单排序')->
                builderConfirmBotton('确认', url('admin/menu/menuupdate'), 'btn btn-success')->
                builderEdit(MenuModel::findMenu($id));
    }

    /**
     * 处理更新角色
     *
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function postMenuupdate(Request $request){
        $id         = $request->get('id');
        $menu_name  = $request->get('menu_name');
        $pid        = $request->get('pid');
        $status     = $request->get('status');
        $icon       = $request->get('icon');
        $url        = $request->get('url');
        $sort       = $request->get('sort');

        $affected_number = DB::table('menu')->where('id', '=', $id)->update([
            'menu_name' => $menu_name,
            'pid'       => $pid,
            'status'    => $status,
            'icon'      => $icon,
            'url'       => $url,
            'sort'      => $sort,
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
    public function getMenuadd(){
        return  $this->html_builder->
        builderTitle('增加菜单')->
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
    public function postMenuadd(RoleRequest $request){
        $role_name  = $request->get('role_name');
        $status     = $request->get('status');

        $affected_number = DB::table('role')->insertGetId([
            'role_name' => $role_name,
            'status'    => $status,
        ]);
        return $affected_number > 0 ? $this->response(200, Lang::get('response.add_success'), [], false) : $this->response(400, Lang::get('response.add_error'), [], false);
    }

}
