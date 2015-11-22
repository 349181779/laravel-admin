<?php

// +----------------------------------------------------------------------
// | date: 2015-09-17
// +----------------------------------------------------------------------
// | FriendLinkController.php: 后端友情链接控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Model\Admin\FriendLinkModel;
use App\Http\Requests\Admin\FriendLinkRequest;


class FriendLinkController extends BaseController
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
     * 获得友情链接
     *
     * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getIndex()
    {
        return  $this->html_builder->
                builderTitle('后台友情链接列表')->
                builderSchema('id', 'id')->
                builderSchema('link_name', '友情链接名称')->
                builderSchema('link_url', '友情链接跳转url')->
                builderSchema('link_logo', '友情链接logo')->
                builderSchema('sort', '排序')->
                builderSchema('handle', '操作')->
                builderSearchSchema('link_name', '友情链接名称')->
                builderBotton('增加友情链接', createUrl('Admin\FriendLinkController@getAdd'))->
                builderJsonDataUrl(createUrl('Admin\FriendLinkController@getSearch'))->
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

        //解析params
        parse_str($search);

        //组合查询条件
        $map = [];
        if (!empty($link_name)) {
            $map['link_name'] = ['like', '%'.$link_name.'%'];
        }

        $data = FriendLinkModel::search($map, $sort, $order, $limit, $offset);

        echo json_encode([
            'total' => $data['count'],
            'rows'  => $data['data'],
        ]);
    }


    /**
     * 编辑友情链接
     *
     * @param  int  $id
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getEdit(Request $request)
    {
        $info = FriendLinkModel::findOrFail($request->get('id'));

        return  $this->html_builder->
                builderTitle('编辑友情链接')->
                builderFormSchema('link_name', '友情链接名称')->
                builderFormSchema('link_url', '友情链接跳转url')->
                builderFormSchema('link_logo', '友情链接logo', 'image')->
                builderFormSchema('sort', '排序', 'text')->
                builderConfirmBotton('确认', createUrl('Admin\FriendLinkController@postEdit'), 'btn btn-success')->
                builderEditData($info)->
                builderEdit();
    }

    /**
     * 处理更新友情链接
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postEdit(FriendLinkRequest $request)
    {
        $Model  = FriendLinkModel::findOrFail($request->get('id'));
        $Model->update($request->all());

        //更新成功
        return $this->response(self::SUCCESS_STATE_CODE, trans('response.update_success'), [], true, createUrl('Admin\FriendLinkController@getIndex'));
    }


    /**
     * 增加友情链接
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getAdd()
    {
        return  $this->html_builder->
                builderTitle('增加友情链接')->
                builderFormSchema('link_name', '友情链接名称')->
                builderFormSchema('link_url', '友情链接跳转url')->
                builderFormSchema('link_logo', '友情链接logo', 'image')->
                builderFormSchema('sort', '排序', 'text', 255)->
                builderConfirmBotton('确认', createUrl('Admin\FriendLinkController@postAdd'), 'btn btn-success')->
                builderAdd();
    }

    /**
     * 添加友情链接
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postAdd(FriendLinkRequest $request)
    {
        //写入数据
        $affected_number = FriendLinkModel::create($request->all());
        return  $affected_number->id > 0  ? $this->response(self::SUCCESS_STATE_CODE, trans('response.add_success'), [], true, createUrl('Admin\FriendLinkController@getIndex')) : $this->response(self::ERROR_STATE_CODE, trans('response.add_error'));
    }



}
