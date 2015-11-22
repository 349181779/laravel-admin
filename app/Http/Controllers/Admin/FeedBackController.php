<?php

// +----------------------------------------------------------------------
// | date: 2015-09-15
// +----------------------------------------------------------------------
// | FeedBackController.php: 用户反馈列表控制器
// +----------------------------------------------------------------------
// | Author: zhuweijian <zhuweijain@louxia100.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Model\Admin\FeedBackModel;
use Illuminate\Http\Request;

class FeedBackController extends BaseController
{

    protected $html_builder;

    /**
     * 构造方法
     *
     * @Author: zhuweijian <zhuweijain@louxia100.com>
     */
    public function __construct(HtmlBuilderController $html_builder)
    {
        parent::__construct();
        $this->html_builder = $html_builder;
    }

    /**
     * 获得用户反馈信息
     *
     * @return Response
     * @Author: zhuweijian <zhuweijain@louxia100.com>
     */
    public function getIndex()
    {
        return  $this->html_builder->
                builderTitle('用户反馈列表')->
                builderSchema('id', 'id')->
                builderSchema('contact', '联系方式')->
                builderSchema('content', '反馈内容')->
                builderSchema('create_date', '创建时间')->
                builderJsonDataUrl(createUrl('Admin\FeedBackController@getSearch'))->
                builderList();
    }

    /**
     * 获取用户反馈列表
     *
     * @param Request $request
     * @Author:  zhuweijian <zhuweijain@louxia100.com>
     */
    public function getSearch(Request $request)
    {
        //接受参数
        $search = $request->get('search', '');
        $sort   = $request->get('sort', 'id');
        $order  = $request->get('order', 'desc');
        $limit  = $request->get('limit',0);
        $offset = $request->get('offset', config('config.page_limit'));

        $data   = FeedBackModel::search($map = [], $sort, $order, $limit, $offset);

        echo json_encode([
                'total' => $data['count'],
                'rows'  => $data['data'],
        ]);
    }


}
