<?php

// +----------------------------------------------------------------------
// | date: 2015-07-10
// +----------------------------------------------------------------------
// | ArticleController.php: 后端文章控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
<<<<<<< HEAD
use Illuminate\Http\Request;
use App\Model\Admin\ArticleModel;
use App\Model\Admin\ArticleCatModel;
use App\Http\Requests\Admin\ArticleRequest;

class ArticleController extends BaseController
{
=======

use Illuminate\Http\Request;

use App\Http\Requests\Admin\ArticleRequest;

use App\Model\Admin\ArticleModel;

use App\Model\Admin\ArticleCatModel;

use Session;

class ArticleController extends BaseController {
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
     * 获得后台用户
     *
     * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
     */
<<<<<<< HEAD
    public function getIndex(Request $request)
    {
=======
    public function getIndex(){
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
        return  $this->html_builder->
                builderTitle('后台文章列表')->
                builderSchema('id', 'id')->
                builderSchema('title', '文章标题')->
                builderSchema('cat_name', '所属分类')->
<<<<<<< HEAD
                builderSchema('link', '外部链接')->
                builderSchema('sort', '排序')->
                builderSchema('state', '状态')->
                builderSchema('create_date', '创建时间')->
                builderSchema('handle', '操作')->
                builderSearchSchema('title', '文章标题')->
                builderSearchSchema('article_cat_id', '所属分类', 'select', '', $class = '', ArticleCatModel::getAllForSchemaOption('cat_name'), '', 'cat_name')->
                builderSearchSchema($name = 'state', $title = '状态', $type = 'select', '', $class = '', $option = [ ['id' => 1, 'name'=>'开启'], ['id' => 2, 'name' => '关闭'] ], '', 'name')->
                builderBotton('增加文章', createUrl('Admin\ArticleController@getAdd'))->
                builderJsonDataUrl(createUrl('Admin\ArticleController@getSearch', ['article_cat_id' => $request->get('article_cat_id')]))->
=======
                builderSchema('email', '作者')->
                builderSchema('status', '状态')->
                builderSchema('sort', '排序')->
                builderSchema('created_at', '创建时间')->
                builderSchema('updated_at', '更新时间')->
                builderSchema('handle', '操作')->
                builderSearchSchema('title', '文章标题')->
                builderSearchSchema('article_cat_id', '所属分类', 'select', $class = '', $option = ArticleCatModel::lists('cat_name', 'id'), $option_value_schema = '')->
                builderSearchSchema('admin_name', '作者')->
                builderSearchSchema($name = 'status', $title = '状态', $type = 'select', $class = '', $option = [1=>'开启', '2'=>'关闭'], $option_value_schema = '0')->
                builderAddBotton('增加文章', url('admin/article/add'))->
                builderJsonDataUrl(url('admin/article/search'))->
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
                builderList();
    }

    /**
     * 搜索
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
<<<<<<< HEAD
    public function getSearch(Request $request)
    {
        //接受参数
        $search         = $request->get('search', '');
        $sort           = $request->get('sort', 'id');
        $order          = $request->get('order', 'asc');
        $limit          = $request->get('limit',0);
        $offset         = $request->get('offset', config('config.page_limit'));
        $article_cat_id = $request->get('article_cat_id');
=======
    public function getSearch(Request $request){
        //接受参数
        $search = $request->get('search', '');
        $sort   = $request->get('sort', 'id');
        $order  = $request->get('order', 'asc');
        $limit  = $request->get('limit',0);
        $offset = $request->get('offset', config('config.page_limit'));
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1

        //解析params
        parse_str($search);

        //组合查询条件
        $map = [];
<<<<<<< HEAD
        if (!empty($title)) {
            $map['article.title'] = ['like', '%'.$title.'%'];
        }
        if (!empty($email)) {
            $map['a.email'] = ['like', '%'.$email.'%'];
        }

        if (!empty($article_cat_id)) {
            $map['article.article_cat_id'] = $article_cat_id;
        }
        if (!empty($article_cat_id)) {
            $map['article.article_cat_id'] = $article_cat_id;
        }
        if (!empty($state)) {
            $map['article.state'] = $state;
        }

=======
        if(!empty($title)){
            $map['article.title'] = ['like', '%'.$title.'%'];
        }
        if(!empty($email)){
            $map['a.email'] = ['like', '%'.$email.'%'];
        }
        if(!empty($article_cat_id)){
            $map['article.article_cat_id'] = $article_cat_id;
        }
        if(!empty($status)){
            $map['article.status'] = $status;
        }

        $map['article.deleted_at'] = ['=', '0000-00-00 00:00:00'];

>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
        $data = ArticleModel::search($map, $sort, $order, $limit, $offset);

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
<<<<<<< HEAD
    public function getEdit(Request $request)
    {
        $info = ArticleModel::getInfo($request->get('id'));

        return  $this->html_builder->
                builderTitle('编辑文章')->
                builderFormSchema('title', '文章标题')->
                builderFormSchema('article_cat_id', '所属分类', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', ArticleCatModel::getAllForSchemaOption('cat_name'), '', 'cat_name')->
                builderFormSchema('content', '内容', 'ueditor')->
                builderFormSchema('sort', '排序', 'text', 255)->
                builderFormSchema('state', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], $info->state)->
                builderConfirmBotton('确认', createUrl('Admin\ArticleController@postEdit'), 'btn btn-success')->
                builderEditData($info)->
=======
    public function getEdit($id){
        return  $this->html_builder->
                builderTitle('编辑文章')->
                builderFormSchema('title', '文章标题', $type = 'text', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('article_cat_id', '所属分类', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', ArticleCatModel::getAllForSchemaOption('cat_name'), 'cat_name')->
                builderFormSchema('keywords', '关键字')->
                builderFormSchema('description', '描述', 'textarea')->
                builderFormSchema('contents', '内容', 'ueditor')->
                builderFormSchema('thumb', '缩略图', 'image')->
                builderFormSchema('sort', '排序', 'text', 255)->
                builderFormSchema('status', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderFormSchema('view', '点击量', 'text', mt_rand(100, 200))->
                builderConfirmBotton('确认', url('admin/article/edit'), 'btn btn-success')->
                builderEditData(ArticleModel::findOrFail($id))->
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
                builderEdit();
    }

    /**
     * 处理更新角色
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
<<<<<<< HEAD
    public function postEdit(ArticleRequest $request)
    {
        $Model  = ArticleModel::findOrFail($request->get('id'));
        $Model->update($request->all());

        //更新成功
        return $this->response(self::SUCCESS_STATE_CODE, trans('response.update_success'), [], true, createUrl('Admin\ArticleController@getIndex'));
=======
    public function postEdit(ArticleRequest $request){
        $Model  = ArticleModel::findOrFail($request->get('id'));
        $Model->update($request->all());
        //更新成功
        return $this->response(200, trans('response.update_success'), [], true, url('admin/article/index'));
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
    }


    /**
     * 增加文章
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
<<<<<<< HEAD
    public function getAdd()
    {
        return  $this->html_builder->
                builderTitle('增加文章')->
                builderFormSchema('title', '文章标题')->
                builderFormSchema('article_cat_id', '所属分类', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', ArticleCatModel::getAllForSchemaOption('cat_name'), 'cat_name')->
                builderFormSchema('content', '内容', 'ueditor')->
                builderFormSchema('sort', '排序', 'text', 255)->
                builderFormSchema('state', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderConfirmBotton('确认', createUrl('Admin\ArticleController@postAdd'), 'btn btn-success')->
=======
    public function getAdd(){
        return  $this->html_builder->
                builderTitle('增加文章')->
                builderFormSchema('title', '文章标题', $type = 'text', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('article_cat_id', '所属分类', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', ArticleCatModel::getAllForSchemaOption('cat_name'), 'cat_name')->
                builderFormSchema('keywords', '关键字')->
                builderFormSchema('description', '描述', 'textarea')->
                builderFormSchema('contents', '内容', 'ueditor')->
                builderFormSchema('thumb', '缩略图', 'image')->
                builderFormSchema('sort', '排序', 'text', 255)->
                builderFormSchema('status', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderFormSchema('view', '点击量', 'text', mt_rand(100, 200))->
                builderConfirmBotton('确认', url('admin/article/add'), 'btn btn-success')->
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
                builderAdd();
    }

    /**
     * 添加文章
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
<<<<<<< HEAD
    public function postAdd(ArticleRequest $request)
    {
        //写入数据
        $affected_number = ArticleModel::create($request->all());
        return  $affected_number->id > 0  ? $this->response(self::SUCCESS_STATE_CODE, trans('response.add_success'), [], true, createUrl('Admin\ArticleController@getIndex')) : $this->response(self::ERROR_STATE_CODE, trans('response.add_error'));
=======
    public function postAdd(ArticleRequest $request){
        $data = $request->all();
        //写入当前用户到数据
        $data['admin_info_id'] = $request->get('admin_info_id', Session::get('admin_info.id'));
        //写入数据
        $affected_number = ArticleModel::create($data);
        return  $affected_number->id > 0  ? $this->response(200, trans('response.add_success'), [], true, url('admin/article/index')) : $this->response(400, trans('response.add_error'), [], false);
    }

    /**
     * 删除数据
     *
     * @param $id
     * @throws \Exception
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getDelete($id){
        ArticleModel::del($id) > 0 ? $this->response(200, trans('response.delete_success'), [], false, url('admin/news/index')) : $this->response(400, trans('response.delete_error'), [], false);
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
    }



}
