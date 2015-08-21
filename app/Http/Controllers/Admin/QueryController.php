<?php

// +----------------------------------------------------------------------
// | date: 2015-07-12
// +----------------------------------------------------------------------
// | QueryController.php: 后端查询工具控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests\Admin\QueryRequest;

use App\Model\Admin\QueryModel;

use App\Model\Admin\QueryCatModel;

class QueryController extends BaseController {

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
                builderTitle('后台查询工具列表')->
                builderSchema('id', 'id')->
                builderSchema('name', '查询工具名称')->
                builderSchema('cat_name', '所属分类')->
                builderSchema('site_url', '网址url')->
                builderSchema('status', '状态')->
                builderSchema('sort', '排序')->
                builderSchema('created_at', '创建时间')->
                builderSchema('updated_at', '更新时间')->
                builderSchema('handle', '操作')->
                builderSearchSchema('name', '查询工具名称')->
                builderSearchSchema('query_cat_id', '所属分类', 'select', $class = '', $option = QueryCatModel::lists('cat_name', 'id'), $option_value_schema = '')->
                builderSearchSchema($name = 'status', $title = '状态', $type = 'select', $class = '', $option = [1=>'开启', '2'=>'关闭'], $option_value_schema = '0')->
                builderAddBotton('增加查询工具', url('admin/query/add'))->
                builderJsonDataUrl(url('admin/query/search'))->
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
        $limit  = $request->get('limit', 0);
        $offset = $request->get('offset', config('config.page_limit'));

        //解析params
        parse_str($search);

        //组合查询条件
        $map = [];
        if(!empty($name)){
            $map['query.name'] = ['like', '%'.$name.'%'];
        }
        if(!empty($query_cat_id)){
            $map['query.query_cat_id'] = $query_cat_id;
        }
        if(!empty($status)){
            $map['query.status'] = $status;
        }
        $map['query.deleted_at'] = ['=', '0000-00-00 00:00:00'];

        $data = QueryModel::search($map, $sort, $order, $limit, $offset);

        echo json_encode([
            'total' => $data['count'],
            'rows'  => $data['data'],
        ]);
    }


    /**
     * 编辑文章
     *
     * @param  int  $id
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getEdit($id){
        return  $this->html_builder->
                builderTitle('编辑查询工具')->
                builderFormSchema('name', '查询工具名称')->
                builderFormSchema('query_cat_id', '所属分类', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', QueryCatModel::getAllForSchemaOption('cat_name'), 'cat_name')->
                builderFormSchema('site_url', '网址url', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'url', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('sort', '排序', 'text', 255)->
                builderFormSchema('status', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderConfirmBotton('确认', url('admin/query/edit'), 'btn btn-success')->
                builderEditData(QueryModel::findOrFail($id))->
                builderEdit();
    }

    /**
     * 处理更新角色
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postEdit(QueryRequest $request){
        $Model  = QueryModel::findOrFail($request->get('id'));
        $Model->update($request->all());
        //更新成功
        return $this->response(200, trans('response.update_success'), [], true, url('admin/query/index'));
    }


    /**
     * 增加文章
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getAdd(){
        return  $this->html_builder->
                builderTitle('增加查询工具')->
                builderFormSchema('name', '查询工具名称')->
                builderFormSchema('query_cat_id', '所属分类', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', QueryCatModel::getAllForSchemaOption('cat_name'), 'cat_name')->
                builderFormSchema('site_url', '网址url', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'url', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('sort', '排序', 'text', 255)->
                builderFormSchema('status', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderConfirmBotton('确认', url('admin/query/add'), 'btn btn-success')->
                builderAdd();
    }

    /**
     * 添加文章
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postAdd(QueryRequest $request){
        //写入数据
        $affected_number = QueryModel::create($request->all());
        return  $affected_number->id > 0  ? $this->response(200, trans('response.add_success'), [], true, url('admin/query/index')) : $this->response(400, trans('response.add_error'), [], false);
    }

    /**
     * 删除数据
     *
     * @param $id
     * @throws \Exception
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getDelete($id){
        QueryModel::del($id) > 0 ? $this->response(200, trans('response.delete_success'), [], false, url('admin/news/index')) : $this->response(400, trans('response.delete_error'), [], false);
    }



}
