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

use App\Http\Requests\Admin\MenuRequest;

class MenuController extends BaseController {

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
	 * 获得菜单列表
	 *
	 * @return Response
     * @auther yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(){
        //加载函数库
        load_func('common');
        return View('admin.menu.index', ['all_menu'=> merge_tree_node(obj_to_array(MenuModel::all())) ]);
	}

    /**
     * 编辑菜单
     *
     * @param  int  $id
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function getMenuedit($id){
        return  $this->html_builder->
                builderTitle('编辑菜单')->
                builderFormSchema('id', 'id', 'hidden')->
                builderFormSchema('menu_name', '菜单名称')->
                builderFormSchema('pid', '父级菜单', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', MenuModel::getAllForSchemaOption(), 'menu_name')->
                builderFormSchema('status', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '2')->
                builderFormSchema('icon', '菜单icon')->
                builderFormSchema('url', '菜单url')->
                builderFormSchema('sort', '菜单排序')->
                builderConfirmBotton('确认', url('admin/menu/menuupdate'), 'btn btn-success')->
                builderEdit(MenuModel::findMenu($id));
    }

    /**
     * 处理更新菜单
     *
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function postMenuupdate(MenuRequest $request){
        $Model = MenuModel::findOrFail($request->get('id'));
        $Model->update($request->all());
        //更新成功
        return $this->response(200, trans('response.update_success'), [], true , url('admin/menu/index'));
    }

    /**
     * 增加菜单
     *
     * @param  int  $id
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function getMenuadd(){
        return  $this->html_builder->
                builderTitle('增加菜单')->
                builderFormSchema('menu_name', '菜单名称')->
                builderFormSchema('pid', '父级菜单', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', MenuModel::getAllForSchemaOption(), 'menu_name')->
                builderFormSchema('status', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '2')->
                builderFormSchema('icon', '菜单icon')->
                builderFormSchema('url', '菜单url')->
                builderFormSchema('sort', '菜单排序', 'text', 255)->
                builderConfirmBotton('确认', url('admin/menu/menuadd'), 'btn btn-success')->
                builderAdd();
    }

    /**
     * 处理新增菜单
     *
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function postMenuadd(MenuRequest $request){
        $affected_number = MenuModel::create($request->all());
        return $affected_number > 0 ? $this->response(200, trans('response.add_success'), [], true, url('admin/menu/index')) : $this->response(400, trans('response.add_error'), [], true, url('admin/menu/index'));
    }

}
