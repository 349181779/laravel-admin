<?php

// +----------------------------------------------------------------------
// | date: 2015-06-22
// +----------------------------------------------------------------------
// | MenuController.php: 后端导航菜单控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Model\Admin\MenuModel;

use App\Http\Requests\Admin\MenuRequest;

class MenuController extends BaseController {

    protected $html_builder;

    /**
     * 构造方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
<<<<<<< HEAD
    public function __construct(HtmlBuilderController $html_builder)
    {
        parent::__construct();
=======
    public function __construct(HtmlBuilderController $html_builder){
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
        $this->html_builder = $html_builder;
    }

	/**
	 * 获得菜单列表
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(){
        return  $this->html_builder->
                builderTitle('文章分类')->
                builderSchema('id', 'id')->
                builderSchema('menu_name', '菜单名称')->
                builderSchema('pid_name','父级栏目')->
                builderSchema('status', '状态')->
                builderSchema('sort', '排序')->
                builderSchema('created_at', '创建时间')->
                builderSchema('updated_at', '更新时间')->
                builderSchema('handle', '操作')->
<<<<<<< HEAD
                builderBotton('增加菜单分类', url('admin/menu/add'))->
=======
                builderAddBotton('增加菜单分类', url('admin/menu/add'))->
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
                builderTreeData(MenuModel::getAll())->
                builderTree();
	}

    /**
     * 编辑菜单
     *
     * @param  int  $id
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getEdit($id){
        return  $this->html_builder->
                builderTitle('编辑菜单')->
                builderFormSchema('id', 'id', 'hidden')->
                builderFormSchema('menu_name', '菜单名称')->
                builderFormSchema('pid', '父级菜单', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', MenuModel::getAllForSchemaOption('menu_name', $id), 'menu_name')->
                builderFormSchema('status', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderFormSchema('icon', '菜单icon')->
                builderFormSchema('url', '菜单url')->
                builderFormSchema('sort', '菜单排序')->
                builderConfirmBotton('确认', url('admin/menu/edit'), 'btn btn-success')->
                builderEditData(MenuModel::find($id))->
                builderEdit();
    }

    /**
     * 处理更新菜单
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postEdit(MenuRequest $request){
        $Model = MenuModel::findOrFail($request->get('id'));
        $Model->update($request->all());
        //更新成功
<<<<<<< HEAD
        return $this->response(self::SUCCESS_STATE_CODE, trans('response.update_success'), [], true , url('admin/menu/index'));
=======
        return $this->response(200, trans('response.update_success'), [], true , url('admin/menu/index'));
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
    }

    /**
     * 增加菜单
     *
     * @param  int  $id
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getAdd(){
        return  $this->html_builder->
                builderTitle('增加菜单')->
                builderFormSchema('menu_name', '菜单名称')->
                builderFormSchema('pid', '父级菜单', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', MenuModel::getAllForSchemaOption('menu_name'), 'menu_name')->
                builderFormSchema('status', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderFormSchema('icon', '菜单icon')->
                builderFormSchema('url', '菜单url')->
                builderFormSchema('sort', '菜单排序', 'text', 255)->
                builderConfirmBotton('确认', url('admin/menu/add'), 'btn btn-success')->
                builderAdd();
    }

    /**
     * 处理新增菜单
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postAdd(MenuRequest $request){
        $affected_number = MenuModel::create($request->all());
<<<<<<< HEAD
        return $affected_number > 0 ? $this->response(self::SUCCESS_STATE_CODE, trans('response.add_success'), [], true, url('admin/menu/index')) : $this->response(self::ERROR_STATE_CODE, trans('response.add_error'), [], true, url('admin/menu/index'));
=======
        return $affected_number > 0 ? $this->response(200, trans('response.add_success'), [], true, url('admin/menu/index')) : $this->response(400, trans('response.add_error'), [], true, url('admin/menu/index'));
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
    }

    /**
     * 删除数据
     *
     * @param $id
     * @throws \Exception
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getDelete($id){
<<<<<<< HEAD
        MenuModel::del($id) > 0 ? $this->response(self::SUCCESS_STATE_CODE, trans('response.delete_success'), [], false, url('admin/news/index')) : $this->response(self::ERROR_STATE_CODE, trans('response.delete_error'), [], false);
=======
        MenuModel::del($id) > 0 ? $this->response(200, trans('response.delete_success'), [], false, url('admin/news/index')) : $this->response(400, trans('response.delete_error'), [], false);
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
    }

}
