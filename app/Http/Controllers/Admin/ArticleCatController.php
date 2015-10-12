<?php

// +----------------------------------------------------------------------
// | date: 2015-06-22
// +----------------------------------------------------------------------
// | ArticleCatController.php: 后端文章分类控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Model\Admin\ArticleCatModel;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ArticleCatRequest;

class ArticleCatController extends BaseController
{

    protected $html_builder;

    /**
     * 构造方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct(HtmlBuilderController $html_builder)
    {
        parent::__construct();
        $this->html_builder = $html_builder;
    }

	/**
	 * 获得文章分类列表
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex()
    {
        return  $this->html_builder->
                builderTitle('文章分类')->
                builderSchema('id', 'id')->
                builderSchema('cat_name', '分类名称')->
                builderSchema('parent_name','父级栏目')->
                builderSchema('sort', '排序')->
                builderSchema('state', '状态')->
                builderSchema('handle', '操作')->
                builderBotton('增加文章分类', createUrl('Admin\ArticleCatController@getAdd'))->
                builderTreeData(ArticleCatModel::getAll())->
                builderTree();
	}

    /**
     * 编辑文章分类
     *
     * @param  int  $id
     * @author yangyifan <yangyifanphp@gmail.com>
     */
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
                builderEdit();
    }

    /**
     * 处理更新文章分类
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postEdit(ArticleCatRequest $request)
    {
        $Model = ArticleCatModel::findOrFail($request->get('id'));
        $Model->update($request->all());
        //更新成功
        return $this->response(self::SUCCESS_STATE_CODE, trans('response.update_success'), [], true , createUrl('Admin\ArticleCatController@getIndex'));
    }

    /**
     * 增加文章分类
     *
     * @param  int  $id
     * @author yangyifan <yangyifanphp@gmail.com>
     */
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
                builderAdd();
    }

    /**
     * 处理新增文章分类
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postAdd(ArticleCatRequest $request)
    {
        $affected_number = ArticleCatModel::create($request->all());
        return $affected_number->id > 0 ? $this->response(self::SUCCESS_STATE_CODE, trans('response.add_success'), [], true, createUrl('Admin\ArticleCatController@getIndex')) : $this->response(self::ERROR_STATE_CODE, trans('response.add_error'));
    }

}
