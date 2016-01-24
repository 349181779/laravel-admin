<?php

// +----------------------------------------------------------------------
// | date: 2015-07-22
// +----------------------------------------------------------------------
// | AppController.php: 后端网址控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Requests;

use Illuminate\Http\Request;

use App\Http\Requests\Admin\AppRequest;

use App\Model\Admin\AppModel;

use App\Model\Admin\AppCatModel;

class AppController extends BaseController {

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
                builderTitle('后台App列表')->
                builderSchema('id', 'id')->
                builderSchema('name', 'App名称')->
                builderSchema('cat_name', '所属分类')->
                builderSchema('site_url', '下载url')->
                builderSchema('status', '状态')->
                builderSchema('sort', '排序')->
                builderSchema('created_at', '创建时间')->
                builderSchema('updated_at', '更新时间')->
                builderSchema('handle', '操作')->
                builderSearchSchema('name', 'App名称')->
                builderSearchSchema('app_cat_id', '所属分类', 'select', $class = '', $option = AppCatModel::lists('cat_name', 'id'), $option_value_schema = '')->
                builderSearchSchema($name = 'status', $title = '状态', $type = 'select', $class = '', $option = [1=>'开启', '2'=>'关闭'], $option_value_schema = '0')->
                builderAddBotton('增加App', url('admin/app/add'))->
                builderJsonDataUrl(url('admin/app/search'))->
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
        if(!empty($app_cat_id)){
            $map['app.app_cat_id'] = $app_cat_id;
        }
        if(!empty($status)){
            $map['app.status'] = $status;
        }

        $map['app.deleted_at'] = ['=', '0000-00-00 00:00:00'];

        $data = AppModel::search($map, $sort, $order, $limit, $offset);

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
                builderTitle('编辑网址')->
                builderFormSchema('name', 'App名称')->
                builderFormSchema('app_cat_id', '所属分类', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', AppCatModel::getAllForSchemaOption('cat_name'), 'cat_name')->
                builderFormSchema('site_url', 'App url', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'url', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('icon', 'App icon', 'image')->
                builderFormSchema('thumb_small', '缩略图【小图】', 'image')->
                builderFormSchema('thumb_medium', '缩略图【中图】', 'image')->
                builderFormSchema('thumb_logo', 'App logo', 'image')->
                builderFormSchema('sort', '排序', 'text', 255)->
                builderFormSchema('status', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderFormSchema('view', '点击量', 'text', mt_rand(100, 200))->
                builderConfirmBotton('确认', url('admin/app/edit'), 'btn btn-success')->
                builderEditData(AppModel::findOrFail($id))->
                builderEdit();
    }

    /**
     * 处理更新角色
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postEdit(AppRequest $request){
        $Model  = AppModel::findOrFail($request->get('id'));
        $Model->update($request->all());
        //更新成功
        return $this->response(200, trans('response.update_success'), [], true, url('admin/app/index'));
    }


    /**
     * 增加文章
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getAdd(){
        return  $this->html_builder->
                builderTitle('增加网址')->
                builderFormSchema('name', 'App名称')->
                builderFormSchema('app_cat_id', '所属分类', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', AppCatModel::getAllForSchemaOption('cat_name'), 'cat_name')->
                builderFormSchema('site_url', 'App url', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'url', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('icon', 'App icon', 'image')->
                builderFormSchema('thumb_small', '缩略图【小图】', 'image')->
                builderFormSchema('thumb_medium', '缩略图【中图】', 'image')->
                builderFormSchema('thumb_logo', 'App logo', 'image')->
                builderFormSchema('sort', '排序', 'text', 255)->
                builderFormSchema('status', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderFormSchema('view', '点击量', 'text', mt_rand(100, 200))->
                builderConfirmBotton('确认', url('admin/app/edit'), 'btn btn-success')->
                builderConfirmBotton('确认', url('admin/app/add'), 'btn btn-success')->
                builderAdd();
    }

    /**
     * 添加文章
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postAdd(AppRequest $request){
        //写入数据
        $affected_number = AppModel::create($request->all());
        return  $affected_number->id > 0  ? $this->response(200, trans('response.add_success'), [], true, url('admin/app/index')) : $this->response(400, trans('response.add_error'), [], false);
    }

    /**
     * 删除数据
     *
     * @param $id
     * @throws \Exception
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getDelete($id){
        AppModel::del($id) > 0 ? $this->response(200, trans('response.delete_success'), [], false, url('admin/news/index')) : $this->response(400, trans('response.delete_error'), [], false);
    }


}
