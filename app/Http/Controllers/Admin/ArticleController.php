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
use Illuminate\Http\Request;
use App\Model\Admin\ArticleModel;
use App\Model\Admin\ArticleCatModel;
use App\Http\Requests\Admin\ArticleRequest;

class ArticleController extends BaseController
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
     * 获得后台用户
     *
     * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getIndex(Request $request)
    {
        return  $this->html_builder->
                builderTitle('后台文章列表')->
                builderSchema('id', 'id')->
                builderSchema('title', '文章标题')->
                builderSchema('cat_name', '所属分类')->
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
                builderList();
    }

    /**
     * 搜索
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getSearch(Request $request)
    {
        //接受参数
        $search         = $request->get('search', '');
        $sort           = $request->get('sort', 'id');
        $order          = $request->get('order', 'asc');
        $limit          = $request->get('limit',0);
        $offset         = $request->get('offset', config('config.page_limit'));
        $article_cat_id = $request->get('article_cat_id');

        //解析params
        parse_str($search);

        //组合查询条件
        $map = [];
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
                builderEdit();
    }

    /**
     * 处理更新角色
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postEdit(ArticleRequest $request)
    {
        $Model  = ArticleModel::findOrFail($request->get('id'));
        $Model->update($request->all());

        //更新成功
        return $this->response(self::SUCCESS_STATE_CODE, trans('response.update_success'), [], true, createUrl('Admin\ArticleController@getIndex'));
    }


    /**
     * 增加文章
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
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
                builderAdd();
    }

    /**
     * 添加文章
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postAdd(ArticleRequest $request)
    {
        //写入数据
        $affected_number = ArticleModel::create($request->all());
        return  $affected_number->id > 0  ? $this->response(self::SUCCESS_STATE_CODE, trans('response.add_success'), [], true, createUrl('Admin\ArticleController@getIndex')) : $this->response(self::ERROR_STATE_CODE, trans('response.add_error'));
    }



}
