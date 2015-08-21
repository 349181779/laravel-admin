<?php

// +----------------------------------------------------------------------
// | date: 2015-07-12
// +----------------------------------------------------------------------
// | QueryCatController.php: 后端查询工具分类控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Model\Admin\QueryCatModel;

use App\Http\Requests\Admin\QueryCatRequest;

class QueryCatController extends BaseController {

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
	 * 获得文章分类列表
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(){
        return  $this->html_builder->
                builderTitle('后台工具分类列表')->
                builderSchema('id', 'id')->
                builderSchema('cat_name', '分类名称')->
                builderSchema('status', '状态')->
                builderSchema('sort', '排序')->
                builderSchema('created_at', '创建时间')->
                builderSchema('updated_at', '更新时间')->
                builderSchema('handle', '操作')->
                builderSearchSchema('cat_name', '文章标题')->
                builderSearchSchema($name = 'status', $title = '状态', $type = 'select', $class = '', $option = [1=>'开启', '2'=>'关闭'], $option_value_schema = '0')->
                builderAddBotton('增加查询工具分类', url('admin/query-cat/add'))->
                builderJsonDataUrl(url('admin/query-cat/search'))->
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
        if(!empty($cat_name)){
            $map['cat_name'] = ['like', '%'.$cat_name.'%'];
        }
        if(!empty($status)){
            $map['status'] = $status;
        }
        $map['deleted_at'] = ['=', '0000-00-00 00:00:00'];

        $data = QueryCatModel::search($map, $sort, $order, $limit, $offset);

        echo json_encode([
            'total' => $data['count'],
            'rows'  => $data['data'],
        ]);
    }

    /**
     * 编辑文章分类
     *
     * @param  int  $id
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getEdit($id){
        return  $this->html_builder->
                builderTitle('编辑网址分类')->
                builderFormSchema('id', 'id', 'hidden')->
                builderFormSchema('cat_name', '分类名称')->
                builderFormSchema('status', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderFormSchema('sort', '排序', 'text', 255)->
                builderConfirmBotton('确认', url('admin/query-cat/edit'), 'btn btn-success')->
                builderEditData(QueryCatModel::find($id))->
                builderEdit();
    }

    /**
     * 处理更新文章分类
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postEdit(QueryCatRequest $request){
        $Model = QueryCatModel::findOrFail($request->get('id'));
        $Model->update($request->all());
        //更新成功
        return $this->response(200, trans('response.update_success'), [], true , url('admin/query-cat/index'));
    }

    /**
     * 增加文章分类
     *
     * @param  int  $id
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getAdd(){
        return  $this->html_builder->
                builderTitle('增加')->
                builderFormSchema('cat_name', '分类名称')->
                builderFormSchema('status', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderFormSchema('sort', '排序', 'text', 255)->
                builderConfirmBotton('确认', url('admin/query-cat/add'), 'btn btn-success')->
                builderAdd();
    }

    /**
     * 处理新增文章分类
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postAdd(QueryCatRequest $request){
        $affected_number = QueryCatModel::create($request->all());
        return $affected_number->id > 0 ? $this->response(200, trans('response.add_success'), [], true, url('admin/query-cat/index')) : $this->response(400, trans('response.add_error'), [], true, url('admin/query-cat/index'));
    }

    /**
     * 删除数据
     *
     * @param $id
     * @throws \Exception
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getDelete($id){
        QueryCatModel::del($id) > 0 ? $this->response(200, trans('response.delete_success'), [], false, url('admin/news/index')) : $this->response(400, trans('response.delete_error'), [], false);
    }

}
