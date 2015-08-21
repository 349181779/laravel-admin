<?php

// +----------------------------------------------------------------------
// | date: 2015-08-08
// +----------------------------------------------------------------------
// | ForumCatController.php: 后端论坛菜单控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Model\Admin\ForumCatModel;

use App\Http\Requests\Admin\ForumCatRequest;

class ForumCatController extends BaseController {

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
	 * 获得论坛分类列表
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(){
        return  $this->html_builder->
                builderTitle('论坛分类')->
                builderSchema('id', 'id')->
                builderSchema('cat_name', '分类名称')->
                builderSchema('pid_name','父级栏目')->
                builderSchema('status', '状态')->
                builderSchema('sort', '排序')->
                builderSchema('created_at', '创建时间')->
                builderSchema('updated_at', '更新时间')->
                builderSchema('handle', '操作')->
                builderAddBotton('增加论坛分类', url('admin/forum-cat/add'))->
                builderTreeData(ForumCatModel::getAll())->
                builderTree();
	}

    /**
     * 编辑论坛分类
     *
     * @param  int  $id
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getEdit($id){
        return  $this->html_builder->
                builderTitle('编辑论坛分类')->
                builderFormSchema('id', 'id', 'hidden')->
                builderFormSchema('cat_name', '分类名称')->
                builderFormSchema('keywords', '分类关键字')->
                builderFormSchema('description', '分类描述', 'textarea')->
                builderFormSchema('pid', '父级菜单', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', ForumCatModel::getAllForSchemaOption('cat_name', $id), 'cat_name')->
                builderFormSchema('status', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderFormSchema('is_show', '是否设置为推荐', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '2')->
                builderFormSchema('sort', '菜单排序')->
                builderConfirmBotton('确认', url('admin/forum-cat/edit'), 'btn btn-success')->
                builderEditData(ForumCatModel::find($id))->
                builderEdit();
    }

    /**
     * 处理更新论坛分类
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postEdit(ForumCatRequest $request){
        $Model = ForumCatModel::findOrFail($request->get('id'));
        $Model->update($request->all());
        //更新成功
        return $this->response(200, trans('response.update_success'), [], true , url('admin/forum-cat/index'));
    }

    /**
     * 增加论坛分类
     *
     * @param  int  $id
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getAdd(){
        return  $this->html_builder->
                builderTitle('增加论坛分类')->
                builderFormSchema('cat_name', '分类名称')->
                builderFormSchema('keywords', '分类关键字')->
                builderFormSchema('description', '分类描述', 'textarea')->
                builderFormSchema('pid', '父级菜单', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', ForumCatModel::getAllForSchemaOption('cat_name'), 'cat_name')->
                builderFormSchema('status', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderFormSchema('is_show', '是否设置为推荐', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '2')->
                builderFormSchema('sort', '菜单排序', 'text', 255)->
                builderConfirmBotton('确认', url('admin/forum-cat/add'), 'btn btn-success')->
                builderAdd();
    }

    /**
     * 处理新增论坛分类
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postAdd(ForumCatRequest $request){
        $affected_number = ForumCatModel::create($request->all());
        return $affected_number->id > 0 ? $this->response(200, trans('response.add_success'), [], true, url('admin/forum-cat/index')) : $this->response(400, trans('response.add_error'), [], true, url('admin/forum-cat/index'));
    }

    /**
     * 删除数据
     *
     * @param $id
     * @throws \Exception
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getDelete($id){
        ForumCatModel::del($id) > 0 ? $this->response(200, trans('response.delete_success'), [], false, url('admin/news/index')) : $this->response(400, trans('response.delete_error'), [], false);
    }

}
