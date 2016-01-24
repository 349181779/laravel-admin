<?php

// +----------------------------------------------------------------------
// | date: 2015-06-22
// +----------------------------------------------------------------------
<<<<<<< HEAD
// | ArticleCatController.php: 后端文章分类控制器
=======
// | MenuController.php: 后端导航菜单控制器
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Model\Admin\ArticleCatModel;
<<<<<<< HEAD
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ArticleCatRequest;

class ArticleCatController extends BaseController
{
=======

use App\Http\Requests\Admin\ArticleCatRequest;

class ArticleCatController extends BaseController {
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1

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
	 * 获得文章分类列表
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
<<<<<<< HEAD
	public function getIndex()
    {
=======
	public function getIndex(){
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
        return  $this->html_builder->
                builderTitle('文章分类')->
                builderSchema('id', 'id')->
                builderSchema('cat_name', '分类名称')->
<<<<<<< HEAD
                builderSchema('parent_name','父级栏目')->
                builderSchema('sort', '排序')->
                builderSchema('state', '状态')->
                builderSchema('handle', '操作')->
                builderBotton('增加文章分类', createUrl('Admin\ArticleCatController@getAdd'))->
=======
                builderSchema('pid_name','父级栏目')->
                builderSchema('status', '状态')->
                builderSchema('sort', '排序')->
                builderSchema('created_at', '创建时间')->
                builderSchema('updated_at', '更新时间')->
                builderSchema('handle', '操作')->
                builderAddBotton('增加文章分类', url('admin/article-cat/add'))->
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
                builderTreeData(ArticleCatModel::getAll())->
                builderTree();
	}

    /**
     * 编辑文章分类
     *
     * @param  int  $id
     * @author yangyifan <yangyifanphp@gmail.com>
     */
<<<<<<< HEAD
    public function getEdit(Request $request)
    {
        $category_info = ArticleCatModel::find($request->get('id'));

        return  $this->html_builder->
                builderTitle('编辑文章分类')->
                builderFormSchema('cat_name', '分类名称')->
                builderFormSchema('parent_id', '上级栏目分类', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', ArticleCatModel::getAllForSchemaOption('cat_name'), $category_info->parent_id, 'cat_name')->
                builderFormSchema('cat_type', '状态', 'radio', '', '', '', '', '', ArticleCatModel::getType(), $category_info->cat_type)->
                builderFormSchema('sort', '菜单排序', 'text')->
                builderFormSchema('state', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], $category_info->state)->
                builderConfirmBotton('确认', createUrl('Admin\ArticleCatController@postEdit'), 'btn btn-success')->
                builderEditData($category_info)->
=======
    public function getEdit($id){
        return  $this->html_builder->
                builderTitle('编辑文章分类')->
                builderFormSchema('id', 'id', 'hidden')->
                builderFormSchema('cat_name', '分类名称')->
                builderFormSchema('keywords', '分类关键字')->
                builderFormSchema('description', '分类描述', 'textarea')->
                builderFormSchema('pid', '父级菜单', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', ArticleCatModel::getAllForSchemaOption('cat_name', $id), 'cat_name')->
                builderFormSchema('status', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderFormSchema('sort', '菜单排序')->
                builderConfirmBotton('确认', url('admin/article-cat/edit'), 'btn btn-success')->
                builderEditData(ArticleCatModel::find($id))->
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
                builderEdit();
    }

    /**
     * 处理更新文章分类
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
<<<<<<< HEAD
    public function postEdit(ArticleCatRequest $request)
    {
        $Model = ArticleCatModel::findOrFail($request->get('id'));
        $Model->update($request->all());
        //更新成功
        return $this->response(self::SUCCESS_STATE_CODE, trans('response.update_success'), [], true , createUrl('Admin\ArticleCatController@getIndex'));
=======
    public function postEdit(ArticleCatRequest $request){
        $Model = ArticleCatModel::findOrFail($request->get('id'));
        $Model->update($request->all());
        //更新成功
        return $this->response(200, trans('response.update_success'), [], true , url('admin/article-cat/index'));
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
    }

    /**
     * 增加文章分类
     *
     * @param  int  $id
     * @author yangyifan <yangyifanphp@gmail.com>
     */
<<<<<<< HEAD
    public function getAdd()
    {
        return  $this->html_builder->
                builderTitle('增加文章分类')->
                builderFormSchema('cat_name', '分类名称')->
                builderFormSchema('parent_id', '上级栏目分类', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', ArticleCatModel::getAllForSchemaOption('cat_name'), '', 'cat_name')->
                builderFormSchema('cat_type', '状态', 'radio', '', '', '', '', '', ArticleCatModel::getType(), '1')->
                builderFormSchema('sort', '菜单排序', 'text', 255)->
                builderFormSchema('state', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderConfirmBotton('确认', createUrl('Admin\ArticleCatController@postAdd'), 'btn btn-success')->
=======
    public function getAdd(){
        return  $this->html_builder->
                builderTitle('增加菜单')->
                builderFormSchema('cat_name', '分类名称')->
                builderFormSchema('keywords', '分类关键字')->
                builderFormSchema('description', '分类描述', 'textarea')->
                builderFormSchema('pid', '父级菜单', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', ArticleCatModel::getAllForSchemaOption('cat_name'), 'cat_name')->
                builderFormSchema('status', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderFormSchema('sort', '菜单排序', 'text', 255)->
                builderConfirmBotton('确认', url('admin/article-cat/add'), 'btn btn-success')->
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
                builderAdd();
    }

    /**
     * 处理新增文章分类
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
<<<<<<< HEAD
    public function postAdd(ArticleCatRequest $request)
    {
        $affected_number = ArticleCatModel::create($request->all());
        return $affected_number->id > 0 ? $this->response(self::SUCCESS_STATE_CODE, trans('response.add_success'), [], true, createUrl('Admin\ArticleCatController@getIndex')) : $this->response(self::ERROR_STATE_CODE, trans('response.add_error'));
=======
    public function postAdd(ArticleCatRequest $request){
        $affected_number = ArticleCatModel::create($request->all());
        return $affected_number->id > 0 ? $this->response(200, trans('response.add_success'), [], true, url('admin/article-cat/index')) : $this->response(400, trans('response.add_error'), [], true, url('admin/article-cat/index'));
    }

    /**
     * 删除数据
     *
     * @param $id
     * @throws \Exception
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getDelete($id){
        ArticleCatModel::del($id) > 0 ? $this->response(200, trans('response.delete_success'), [], false, url('admin/news/index')) : $this->response(400, trans('response.delete_error'), [], false);
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
    }

}
