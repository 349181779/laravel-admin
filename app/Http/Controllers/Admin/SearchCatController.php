<?php

// +----------------------------------------------------------------------
// | date: 2015-07-14
// +----------------------------------------------------------------------
// | SearchCatController.php: 后端查询工具分类控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Model\Admin\SearchCatModel;

use App\Http\Requests\Admin\SearchCatRequest;

class SearchCatController extends BaseController {

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
	 * 获得搜索工具分类列表
	 *
	 * @return Response
     * @auther yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(){
        return  $this->html_builder->
                builderTitle('查询工具分类')->
                builderSchema('id', 'id')->
                builderSchema('cat_name', '分类名称')->
                builderSchema('is_default', '默认')->
                builderSchema('status', '状态')->
                builderSchema('sort', '排序')->
                builderSchema('created_at', '创建时间')->
                builderSchema('updated_at', '更新时间')->
                builderSchema('handle', '操作')->
                builderAddBotton('增加查询工具分类', url('admin/search-cat/add'))->
                builderJsonDataUrl(url('admin/search-cat/search'))->
                builderList();
	}

    /**
     * 搜索
     *
     * @param Request $request
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function getSearch(Request $request){
        //接受参数
        $search = $request->get('search', '');
        $sort   = $request->get('sort', 'id');
        $order  = $request->get('order', 'asc');
        $limit  = $request->get('limit', 0);
        $offset = $request->get('offset', config('config.page_limit'));

        //解析params
        parse_str($search);

        //组合查询条件
        $map = [];
        if(!empty($cat_name)){
            $map['cat_name'] = ['like', '%'.$cat_name.'%'];
        }
        if(!empty($status)){
            $map['status'] = $status;
        }

        $data = SearchCatModel::search($map, $sort, $order, $limit, $offset);

        echo json_encode([
            'total' => $data['count'],
            'rows'  => $data['data'],
        ]);
    }

    /**
     * 编辑搜索工具分类
     *
     * @param  int  $id
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function getEdit($id){
        return  $this->html_builder->
                builderTitle('编辑搜索工具分类')->
                builderFormSchema('id', 'id', 'hidden')->
                builderFormSchema('cat_name', '分类名称')->
                builderFormSchema('logo', 'logo', 'image')->
                builderFormSchema('is_default', '是否默认搜', 'radio', '', '', '', '', '', [1=>'默认', '2'=>'不默认'], '1')->
                builderFormSchema('status', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderFormSchema('sort', '菜单排序')->
                builderConfirmBotton('确认', url('admin/search-cat/edit'), 'btn btn-success')->
                builderEditData(SearchCatModel::findOrFail($id))->
                builderEdit();
    }

    /**
     * 处理更新文章分类
     *
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function postEdit(SearchCatRequest $request){
        $Model = SearchCatModel::findOrFail($request->get('id'));
        $Model->update($request->all());
        //更新成功
        return $this->response(200, trans('response.update_success'), [], true , url('admin/search-cat/index'));
    }

    /**
     * 增加搜索工具分类
     *
     * @param  int  $id
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function getAdd(){
        return  $this->html_builder->
                builderTitle('增加搜索工具分类')->
                builderFormSchema('cat_name', '分类名称')->
                builderFormSchema('logo', 'logo', 'image')->
                builderFormSchema('is_default', '是否默认搜', 'radio', '', '', '', '', '', [1=>'默认', '2'=>'不默认'], '1')->
                builderFormSchema('status', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderFormSchema('sort', '菜单排序', 'text', 255)->
                builderConfirmBotton('确认', url('admin/search-cat/add'), 'btn btn-success')->
                builderAdd();
    }

    /**
     * 处理搜索工具分类
     *
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function postAdd(SearchCatRequest $request){
        $affected_number = SearchCatModel::create($request->all());
        return $affected_number->id > 0 ? $this->response(200, trans('response.add_success'), [], true, url('admin/search-cat/index')) : $this->response(400, trans('response.add_error'), [], true, url('admin/search-cat/index'));
    }

}
