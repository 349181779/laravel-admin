<?php

// +----------------------------------------------------------------------
// | date: 2015-07-14
// +----------------------------------------------------------------------
// | SearchController.php: 后端搜索工具导航控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests\Admin\SearchRequest;

use App\Model\Admin\SearchModel;

use App\Model\Admin\SearchCatModel;

class SearchController extends BaseController {

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
     * 获得后台用户
     *
     * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getIndex(){
        return  $this->html_builder->
                builderTitle('后台搜索工具导航列表')->
                builderSchema('id', 'id')->
                builderSchema('name', '名称')->
                builderSchema('cat_name', '所属搜索')->
                builderSchema('search_url', 'url')->
                builderSchema('status', '状态')->
                builderSchema('sort', '排序')->
                builderSchema('created_at', '创建时间')->
                builderSchema('updated_at', '更新时间')->
                builderSchema('handle', '操作')->
                builderSearchSchema('name', '搜索导航名称')->
                builderSearchSchema('search_cat_id', '所属分类', 'select', $class = '', $option = SearchCatModel::lists('cat_name', 'id'), $option_value_schema = '')->
                builderSearchSchema($name = 'status', $title = '状态', $type = 'select', $class = '', $option = [1=>'开启', '2'=>'关闭'], $option_value_schema = '0')->
                builderAddBotton('增加搜索工具导航', url('admin/search/add'))->
                builderJsonDataUrl(url('admin/search/search'))->
                builderList();
    }

    /**
     * 搜索
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getSearch(Request $request){
        //接受参数
        $search = $request->get('search', '');
        $sort   = $request->get('sort', 'id');
        $order  = $request->get('order', 'asc');
        $limit  = $request->get('limit',0);
        $offset = $request->get('offset', config('config.page_limit'));

        //解析params
        parse_str($search);

        //组合查询条件
        $map = [];
        if(!empty($name)){
            $map['search.name'] = ['like', '%'.$name.'%'];
        }
        if(!empty($search_cat_id)){
            $map['search.search_cat_id'] = $search_cat_id;
        }
        if(!empty($status)){
            $map['search.status'] = $status;
        }

        $data = SearchModel::search($map, $sort, $order, $limit, $offset);

        echo json_encode([
            'total' => $data['count'],
            'rows'  => $data['data'],
        ]);
    }


    /**
     * 编辑搜索工具导航
     *
     * @param  int  $id
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getEdit($id){
        return  $this->html_builder->
                builderTitle('编辑搜索工具导航')->
                builderFormSchema('name', '搜索工具导航名称', $type = 'text', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('search_cat_id', '所属分类', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', SearchCatModel::getAllForSchemaOption('cat_name'), 'cat_name')->
                builderFormSchema('search_url', 'url')->
                builderFormSchema('sort', '排序', 'text', 255)->
                builderFormSchema('status', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderConfirmBotton('确认', url('admin/search/edit'), 'btn btn-success')->
                builderEditData(SearchModel::findOrFail($id))->
                builderEdit();
    }

    /**
     * 处理更新搜索工具导航
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postEdit(SearchRequest $request){
        $Model  = SearchModel::findOrFail($request->get('id'));
        $Model->update($request->all());
        //更新成功
        return $this->response(200, trans('response.update_success'), [], true, url('admin/search/index'));
    }


    /**
     * 增加搜索工具导航
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getAdd(){
        return  $this->html_builder->
                builderTitle('增加搜索工具导航')->
                builderFormSchema('name', '搜索工具导航名称', $type = 'text', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('search_cat_id', '所属分类', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', SearchCatModel::getAllForSchemaOption('cat_name'), 'cat_name')->
                builderFormSchema('search_url', 'url')->
                builderFormSchema('sort', '排序', 'text', 255)->
                builderFormSchema('status', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderConfirmBotton('确认', url('admin/search/add'), 'btn btn-success')->
                builderAdd();
    }

    /**
     * 添加文章
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postAdd(SearchRequest $request){
        //写入数据
        $affected_number = SearchModel::create($request->all());
        return  $affected_number->id > 0  ? $this->response(200, trans('response.add_success'), [], true, url('admin/search/index')) : $this->response(400, trans('response.add_error'), [], false);
    }



}
