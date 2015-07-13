<?php

// +----------------------------------------------------------------------
// | date: 2015-07-13
// +----------------------------------------------------------------------
// | NewsController.php: 后端新闻控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests\Admin\NewsRequest;

use App\Model\Admin\NewsModel;

use App\Model\Admin\NewsCatModel;

use Session;

class NewsController extends BaseController {

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
     * 获得后台用户
     *
     * @return Response
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function getIndex(){
        return  $this->html_builder->
                builderTitle('后台新闻列表')->
                builderSchema('id', 'id')->
                builderSchema('title', '新闻标题')->
                builderSchema('cat_name', '所属分类')->
                builderSchema('email', '作者')->
                builderSchema('status', '状态')->
                builderSchema('sort', '排序')->
                builderSchema('created_at', '创建时间')->
                builderSchema('updated_at', '更新时间')->
                builderSchema('handle', '操作')->
                builderSearchSchema('title', '新闻标题')->
                builderSearchSchema('news_cat_id', '所属分类', 'select', $class = '', $option = NewsCatModel::lists('cat_name', 'id'), $option_value_schema = '')->
                builderSearchSchema('admin_name', '作者')->
                builderSearchSchema($name = 'status', $title = '状态', $type = 'select', $class = '', $option = [1=>'开启', '2'=>'关闭'], $option_value_schema = '0')->
                builderAddBotton('增加新闻', url('admin/news/add'))->
                builderJsonDataUrl(url('admin/news/search'))->
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
        $limit  = $request->get('limit',0);
        $offset = $request->get('offset', config('config.page_limit'));

        //解析params
        parse_str($search);

        //组合查询条件
        $map = [];
        if(!empty($title)){
            $map['news.title'] = ['like', '%'.$title.'%'];
        }
        if(!empty($email)){
            $map['a.email'] = ['like', '%'.$email.'%'];
        }
        if(!empty($news_cat_id)){
            $map['news.news_cat_id'] = $news_cat_id;
        }
        if(!empty($status)){
            $map['news.status'] = $status;
        }

        $data = NewsModel::search($map, $sort, $order, $limit, $offset);

        echo json_encode([
            'total' => $data['count'],
            'rows'  => $data['data'],
        ]);
    }


    /**
     * 编辑文章
     *
     * @param  int  $id
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function getEdit($id){
        return  $this->html_builder->
                builderTitle('编辑新闻')->
                builderFormSchema('title', '新闻标题', $type = 'text', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('news_cat_id', '所属分类', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', NewsCatModel::getAllForSchemaOption('cat_name'), 'cat_name')->
                builderFormSchema('site_url', '网址url', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'url', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('thumb', '缩略图', 'image')->
                builderFormSchema('sort', '排序', 'text', 255)->
                builderFormSchema('status', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderFormSchema('view', '点击量', 'text', mt_rand(100, 200))->
                builderConfirmBotton('确认', url('admin/news/edit'), 'btn btn-success')->
                builderEditData(NewsModel::findOrFail($id))->
                builderEdit();
    }

    /**
     * 处理更新角色
     *
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function postEdit(NewsRequest $request){
        $Model  = NewsModel::findOrFail($request->get('id'));
        $Model->update($request->all());
        //更新成功
        return $this->response(200, trans('response.update_success'), [], true, url('admin/news/index'));
    }


    /**
     * 增加文章
     *
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function getAdd(){
        return  $this->html_builder->
                builderTitle('增加新闻')->
                builderFormSchema('title', '新闻标题', $type = 'text', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('news_cat_id', '所属分类', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', NewsCatModel::getAllForSchemaOption('cat_name'), 'cat_name')->
                builderFormSchema('site_url', '网址url', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'url', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('thumb', '缩略图', 'image')->
                builderFormSchema('sort', '排序', 'text', 255)->
                builderFormSchema('status', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderFormSchema('view', '点击量', 'text', mt_rand(100, 200))->
                builderConfirmBotton('确认', url('admin/news/add'), 'btn btn-success')->
                builderAdd();
    }

    /**
     * 添加文章
     *
     * @param Request $request
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function postAdd(NewsRequest $request){
        $data = $request->all();
        //写入当前用户到数据
        $data['admin_info_id'] = $request->get('admin_info_id', Session::get('admin_info.id'));
        //写入数据
        $affected_number = NewsModel::create($data);
        return  $affected_number->id > 0  ? $this->response(200, trans('response.add_success'), [], true, url('admin/news/index')) : $this->response(400, trans('response.add_error'), [], false);
    }



}
