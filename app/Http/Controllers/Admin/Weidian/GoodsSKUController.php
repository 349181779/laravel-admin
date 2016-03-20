<?php

// +----------------------------------------------------------------------
// | date: 2016-03-18
// +----------------------------------------------------------------------
// | GoodsSKUController.php: 微店商品SKU控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin\Weidian;

use App\Http\Controllers\Admin\HtmlBuilderController;
use App\Model\Admin\Weidian\GoodsDescModel;
use App\Model\Admin\Weidian\GoodsModel;
use Illuminate\Http\Request;
use App\Model\Admin\Weidian\GoodsSKUModel;
use App\Model\Admin\Weidian\CategoryModel;
use App\Http\Requests\Admin\Weidian\GoodsSKURequest;
use App\Http\Requests\Admin\Weidian\DeleteGoodsSKURequest;
use App\Model\Admin\MergeModel;

class GoodsSKUController extends BaseController
{
    /**
     * html构造器
     *
     * @var HtmlBuilderController
     */
    protected $html_builder;

    /**
     * 构造方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct(HtmlBuilderController $htmlBuilderController)
    {
        parent::__construct();
        $this->html_builder = $htmlBuilderController;
    }

    /**
     * 商品SKU列表页
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getIndex(Request $request)
    {
        return  $this->html_builder->
                builderTitle('商品SKU列表')->
                builderSchema('id', 'id')->
                builderSchema('title', '商品SKU名称')->
                builderSchema('price', '商品SKU销售价')->
                builderSchema('stock', '商品SKU库存')->
                builderSchema('status', '商品SKU状态')->
                builderSchema('is_sync', '是否需要同步', false)->
                builderSchema('handle', '操作')->
                builderSearchSchema('title', '商品SKU名称')->
                builderSearchSchema($name = 'status', $title = '是否开启', $type = 'select', '', $class = '', $option = MergeModel::mergeStatusForSelect(), 1, 'name')->
                builderBotton('返回', createUrl('Admin\Weidian\GoodsController@getIndex'), 'glyphicon glyphicon-arrow-left')->
                builderBotton('增加 微店商品SKU', createUrl('Admin\Weidian\GoodsSKUController@getAdd', ['goods_id' => $request->get('goods_id')]), 'glyphicon glyphicon-plus')->
                builderJsonDataUrl(createUrl('Admin\Weidian\GoodsSKUController@getSearch', ['goods_id' => $request->get('goods_id')]))->
                buildLimitNumber([20, 30, 40, 50])->
                loadScription('dist/weidian/goods.js')->
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
        $search     = $request->get('search', '');
        $sort       = $request->get('sort', 'id');
        $order      = $request->get('order', 'asc');
        $limit      = $request->get('limit',0);
        $offset     = $request->get('offset', config('config.page_limit'));
        $goods_id   = $request->get('goodS_id');

        //解析params
        parse_str($search);

        //组合查询条件
        $map = [];

        if ($goods_id > 0) {
            $map['goods_id'] = $goods_id;
        }
        if (!empty($title)) {
            $map['title'] = ['LIKE', '%' . $title . '%'];
        }
        if ( $status > 0 ) {
            $map['status'] = $status;
        }

        $data = GoodsSKUModel::search($map, $sort, $order, $limit, $offset);

        echo json_encode([
            'total' => $data['count'],
            'rows'  => $data['data'],
        ]);
    }

    /**
     * 编辑商品SKU
     *
     * @param  int  $id
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getEdit(Request $request)
    {
        $infos = GoodsSKUModel::find($request->get('id'));

        return  $this->html_builder->
                builderTitle('编辑商品SKU')->
                builderFormSchema('title', '商品SKU名称')->
                builderFormSchema('price', '商品SKU价格', $type = 'text', $default = '0.0')->
                builderFormSchema('stock', '商品SKU库存', $type = 'text', $default = '100')->
                builderFormSchema('sku_merchant_code', '商品SKU编码', $type = 'text')->
                buildFormRule('')->
                builderFormSchema('goods_id', '商品id', $type = 'hidden')->
                builderConfirmBotton('确认', createUrl('Admin\Weidian\GoodsSKUController@postEdit'), 'btn btn-success')->
                builderBotton('返回', createUrl('Admin\Weidian\GoodsSKUController@getIndex'), 'glyphicon glyphicon-arrow-left')->
                builderEditData($infos)->
                builderEdit();
    }

    /**
     * 处理更新商品SKU
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postEdit(GoodsSKURequest $request)
    {
        $data       = $request->all();
        $is_sync    = false;//商品是否需要修改“是否需要同步”状态
        $Model      = GoodsSKUModel::findOrFail($data['id']);
        $Model->fill($data);

        //如果修改了数据，则把当前商品修改成需要同步的数据
        if ($Model->isEqual(['title', 'price', 'stock', 'sku_merchant_code']) == false) {
            $Model->is_sync = 1;
            $is_sync = true;
        }
        $Model->save();

        if ($is_sync) {
            //更新商品为需要同步
            GoodsModel::updateToIsSync($data['goods_id']);
        }

        //更新成功
        return $this->response(self::SUCCESS_STATE_CODE, trans('response.update_success'), [], true, createUrl('Admin\Weidian\GoodsSKUController@getIndex'));
    }

    /**
     * 增加商品SKU
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getAdd(Request $request)
    {
        return  $this->html_builder->
                builderTitle('添加商品SKU')->
                builderFormSchema('title', '商品SKU名称')->
                builderFormSchema('price', '商品SKU价格', $type = 'text', $default = '0.0')->
                builderFormSchema('stock', '商品SKU库存', $type = 'text', $default = '100')->
                builderFormSchema('sku_merchant_code', '商品SKU编码', $type = 'text', $default = '')->
                buildFormRule('')->
                builderFormSchema('goods_id', '商品id', $type = 'hidden', $request->get('goods_id'))->
                builderConfirmBotton('确认', createUrl('Admin\Weidian\GoodsSKUController@postAdd'), 'btn btn-success')->
                builderBotton('返回', createUrl('Admin\Weidian\GoodsSKUController@getIndex', ['goods_id' => $request->get('goods_id')]), 'glyphicon glyphicon-arrow-left')->
                builderAdd();
    }

    /**
     * 添加商品SKU
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postAdd(GoodsSKURequest $request)
    {
        //写入数据
        $affected_number = GoodsSKUModel::create($request->all());

        return  $affected_number->id > 0  ? $this->response(self::SUCCESS_STATE_CODE, trans('response.add_success')) : $this->response(self::ERROR_STATE_CODE, trans('response.add_error'));
    }
}
