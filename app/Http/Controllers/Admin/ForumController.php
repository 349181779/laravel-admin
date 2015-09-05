<?php

// +----------------------------------------------------------------------
// | date: 2015-09-05
// +----------------------------------------------------------------------
// | ForumController.php: 后端论坛控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Requests;

use Illuminate\Http\Request;

use App\Http\Requests\Admin\ArticleRequest;

use App\Model\Admin\ForumModel;

use App\Model\Admin\ForumCatModel;

use Session;

class ForumController extends BaseController {

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
    public function getIndex($id){
        //验证权限
        $this->checkAccess($id);


        return  $this->html_builder->
                builderTitle('后台帖子列表')->
                builderSchema('id', 'id')->
                builderSchema('title', '论坛标题')->
                builderSchema('cat_name', '所属分类')->
                builderSchema('email', '作者')->
                builderSchema('status', '状态')->
                builderSchema('sort', '排序')->
                builderSchema('created_at', '创建时间')->
                builderSchema('updated_at', '更新时间')->
                builderSchema('handle', '操作')->
                builderSearchSchema('title', '论坛标题')->
                builderSearchSchema('forum_cat_id', '所属分类', 'select', $class = '', $option = ForumCatModel::lists('cat_name', 'id'), $option_value_schema = '')->
                builderSearchSchema('email', '作者')->
                builderSearchSchema($name = 'status', $title = '状态', $type = 'select', $class = '', $option = [1=>'开启', '2'=>'关闭'], $option_value_schema = '0')->
                builderJsonDataUrl(url('admin/forum/search', [$id]))->
                builderList();
    }

    /**
     * 搜索
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getSearch(Request $request, $id){
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
            $map['forum.title'] = ['like', '%'.$title.'%'];
        }
        if(!empty($email)){
            $map['u.email'] = ['like', '%'.$email.'%'];
        }

        if(!empty($forum_cat_id)){
            $map['forum.forum_cat_id'] = $forum_cat_id;
        }else{
            if(!empty($id)){
                $map['forum.forum_cat_id'] = $id;
            }
        }

        if(!empty($status)){
            $map['forum.status'] = $status;
        }

        $map['forum.deleted_at'] = ['=', '0000-00-00 00:00:00'];
        $data = ForumModel::search($map, $sort, $order, $limit, $offset);

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
                builderTitle('编辑文章')->
                builderFormSchema('title', '文章标题', $type = 'text', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('article_cat_id', '所属分类', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', ForumCatModel::getAllForSchemaOption('cat_name'), 'cat_name')->
                builderFormSchema('keywords', '关键字')->
                builderFormSchema('description', '描述', 'textarea')->
                builderFormSchema('contents', '内容', 'ueditor')->
                builderFormSchema('thumb', '缩略图', 'image')->
                builderFormSchema('sort', '排序', 'text', 255)->
                builderFormSchema('status', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderFormSchema('view', '点击量', 'text', mt_rand(100, 200))->
                builderConfirmBotton('确认', url('admin/forum/edit'), 'btn btn-success')->
                builderEditData(ForumModel::findOrFail($id))->
                builderEdit();
    }

    /**
     * 处理更新角色
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postEdit(ArticleRequest $request){
        $Model  = ForumModel::findOrFail($request->get('id'));
        $Model->update($request->all());
        //更新成功
        return $this->response(200, trans('response.update_success'), [], true, url('admin/forum/index'));
    }


    /**
     * 增加文章
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getAdd(){
        return  $this->html_builder->
                builderTitle('增加文章')->
                builderFormSchema('title', '文章标题', $type = 'text', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('article_cat_id', '所属分类', 'select', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', ForumCatModel::getAllForSchemaOption('cat_name'), 'cat_name')->
                builderFormSchema('keywords', '关键字')->
                builderFormSchema('description', '描述', 'textarea')->
                builderFormSchema('contents', '内容', 'ueditor')->
                builderFormSchema('thumb', '缩略图', 'image')->
                builderFormSchema('sort', '排序', 'text', 255)->
                builderFormSchema('status', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderFormSchema('view', '点击量', 'text', mt_rand(100, 200))->
                builderConfirmBotton('确认', url('admin/forum/add'), 'btn btn-success')->
                builderAdd();
    }

    /**
     * 添加文章
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postAdd(ArticleRequest $request){
        $data = $request->all();
        //写入数据
        $affected_number = ForumModel::create($data);
        return  $affected_number->id > 0  ? $this->response(200, trans('response.add_success'), [], true, url('admin/forum/index')) : $this->response(400, trans('response.add_error'), [], false);
    }

    /**
     * 删除数据
     *
     * @param $id
     * @throws \Exception
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getDelete($id){
        ForumModel::del($id) > 0 ? $this->response(200, trans('response.delete_success'), [], false, url('admin/forum/index')) : $this->response(400, trans('response.delete_error'), [], false);
    }

    /**
     * 验证论坛栏目权限
     *
     * @param $id
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function checkAccess($id){
        //验证角色权限
        $status = ForumCatModel::checkAccess($id);
        if($status == false) $this->error(trans('response.access_error'));
    }



}
