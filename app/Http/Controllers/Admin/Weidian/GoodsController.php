<?php

// +----------------------------------------------------------------------
// | date: 2016-03-18
// +----------------------------------------------------------------------
// | GoodsController.php: 微店商品控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin\Weidian;

use App\Http\Controllers\Admin\HtmlBuilderController;
use App\Model\Admin\Weidian\GoodsDescModel;
use Illuminate\Http\Request;
use App\Model\Admin\Weidian\GoodsModel;
use App\Model\Admin\Weidian\CategoryModel;
use App\Http\Requests\Admin\Weidian\GoodsRequest;
use App\Http\Requests\Admin\Weidian\DeleteGoodsRequest;
use App\Model\Admin\MergeModel;

class GoodsController extends BaseController
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
     * 商品列表页
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getIndex()
    {
        return  $this->html_builder->
                builderTitle('商品列表')->
                builderSchema('id', 'id')->
                builderSchema('item_name', '商品名称')->
                builderSchema('price', '商品销售价')->
                builderSchema('stock', '商品库存')->
                builderSchema('status', '商品状态')->
                builderSchema('sold', '销售数量')->
                builderSchema('istop', '是否是店长推荐')->
                builderSchema('thumb_imgs', '缩略图')->
                builderSchema('is_sync', '是否需要同步', false)->
                builderSchema('handle', '操作')->
                builderSearchSchema('item_name', '商品名称')->
                builderSearchSchema($name = 'goods_status', $title = '是否开启', $type = 'select', '', $class = '', $option = MergeModel::mergeStatusForSelect(), 1, 'name')->
                builderBotton('增加 微店商品', createUrl('Admin\Weidian\GoodsController@getAdd'), 'glyphicon glyphicon-plus')->
                builderBotton('pull 微店商品', '', 'glyphicon glyphicon-download', GoodsModel::getPullEvent())->
                builderBotton('同步 微店商品', '', 'glyphicon glyphicon-refresh', GoodsModel::getSyncEvent())->
                builderJsonDataUrl(createUrl('Admin\Weidian\GoodsController@getSearch'))->
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

        //解析params
        parse_str($search);

        //组合查询条件
        $map = [];

        if (!empty($item_name)) {
            $map['item_name'] = ['LIKE', '%' . $item_name . '%'];
        }
        if ( $goods_status > 0 ) {
            $map['goods_status'] = $goods_status;
        }

        $data = GoodsModel::search($map, $sort, $order, $limit, $offset);

        echo json_encode([
            'total' => $data['count'],
            'rows'  => $data['data'],
        ]);
    }

    /**
     * 编辑商品
     *
     * @param  int  $id
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getEdit(Request $request)
    {
        $infos = GoodsModel::getGoodsInfo($request->get('id'));

        return  $this->html_builder->
                builderTitle('编辑商品')->
                builderFormSchema('item_name', '商品名称')->
                builderFormSchema('price', '商品价格')->
                builderFormSchema('stock', '商品库存')->
                builderFormSchema('merchant_code', '商品编码')->
                buildFormRule('')->
                builderFormSchema('desc.item_desc', '商品描述', 'ckeditor', GoodsModel::getCkEditorParams())->
                buildFormRule('')->
                builderFormSchema('category_id[]', '商品分类', 'select' )->
                buildFormRule('*')->
                buildFormAttr(['is_copy' => true])->
                buildDataSource( CategoryModel::getAllForSchemaOption('cate_name', 0, false), 1, 'cate_name')->
                builderConfirmBotton('确认', createUrl('Admin\Weidian\GoodsController@postEdit'), 'btn btn-success')->
                builderBotton('返回', createUrl('Admin\Weidian\GoodsController@getIndex'), 'glyphicon glyphicon-arrow-left')->
                builderEditData($infos)->
                builderEdit();
    }

    /**
     * 处理更新商品
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postEdit(GoodsRequest $request)
    {
        $data   = $request->except('category_id', 'desc_item_desc');

        if ( GoodsModel::updateGoodsInfo($data) ) {
            //更新商品描述信息
            GoodsDescModel::addGoodsDesc($data['id'], $request->get('desc_item_desc'));
        }

        //更新成功
        return $this->response(self::SUCCESS_STATE_CODE, trans('response.update_success'), [], true, createUrl('Admin\Weidian\GoodsController@getIndex'));
    }

    /**
     * 增加商品
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getAdd()
    {
        return  $this->html_builder->
                builderTitle('添加后台用户')->
                builderFormSchema('cate_name', '商品名称')->
                builderFormSchema('sort_num', '排序', $type = 'text', $default = '255',  $notice = '排序规则按照越小的越在前面')->
                builderConfirmBotton('确认', createUrl('Admin\Weidian\GoodsController@postAdd'), 'btn btn-success')->
                builderBotton('返回', createUrl('Admin\Weidian\GoodsController@getIndex'), 'glyphicon glyphicon-arrow-left')->
                builderAdd();
    }

    /**
     * 添加商品
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postAdd(GoodsRequest $request)
    {
        //写入数据
        $affected_number = GoodsModel::create($request->all());

        return  $affected_number->id > 0  ? $this->response(self::SUCCESS_STATE_CODE, trans('response.add_success')) : $this->response(self::ERROR_STATE_CODE, trans('response.add_error'));
    }

    /**
     * 拉取微店商品数据
     *
     * @return
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postPull()
    {
        $result = $this->send(self::GET_API_URL, [
            'param'     => '{"page_num":1,"page_size":10,"orderby":1}',
            'public'    => '{"method":"vdian.item.list.get"}',
        ]);


        if ($result !== false) {
            GoodsModel::mergeWeidianGoods($result['items']);
            return $this->response(self::SUCCESS_STATE_CODE, '拉取微店信息成功', [], true , createUrl('Admin\Weidian\GoodsController@getIndex'));
        }
        return $this->response(self::ERROR_STATE_CODE, '拉取微店信息失败');
    }

    /**
     * 同步商品数据
     *
     * @return $this
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postSync()
    {
        //获得全部添加更新到微店的商品
        $this->addGoodsCategory();
        //获得全部需要更新到微店的商品
        $this->updateGoodsCategory();
        //拉取商品信息
        $this->postPull();

        return $this->response(self::SUCCESS_STATE_CODE, '同步微店商品信息成功', [], true , createUrl('Admin\Weidian\GoodsController@getIndex'));
    }

    /**
     * 新增商品
     *
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function addGoodsCategory()
    {
        //获得全部需要更新到微店的商品
        $all_category = GoodsModel::getAllShoudAddCategory();

        if ( count($all_category) > 0 ) {
            $cates = [];

            foreach ($all_category as $category) {
                $cates[] = [
                    'cate_name' => $category->cate_name,
                    'sort_num'  => $category->sort_num,
                ];
            }
            if ( count($cates) > 0 ) {
                $result = $this->send(self::GET_API_URL, [
                    'param'     => json_encode(['cates' => $cates]),
                    'public'    => '{"method":"vdian.shop.cate.add"}',
                ]);
                return true;
            }
        }
        return false;
    }

    /**
     * 更新全部商品
     *
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function updateGoodsCategory()
    {
        //获得全部需要更新到微店的商品
        $all_category = GoodsModel::getAllShoudUpdateCategory();

        if ( count($all_category) > 0 ) {
            $cates = [];

            foreach ($all_category as $category) {
                $cates[] = [
                    'cate_name' => $category->cate_name,
                    'sort_num'  => $category->sort_num,
                    'cate_id'   => $category->cate_id,
                ];
            }
            if ( count($cates) > 0 ) {
                $result = $this->send(self::GET_API_URL, [
                    'param'     => json_encode(['cates' => $cates]),
                    'public'    => '{"method":"vdian.shop.cate.update"}',
                ]);

                if ($result !== false ) {
                    foreach ($cates as $cate_info) {
                        GoodsModel::updateCategoryToSyncSuccess($cate_info['cate_id']);
                    }
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * 删除商品
     *
     * @param DeleteGoodsRequest $request
     * @return $this
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postDelete(DeleteGoodsRequest $request)
    {
        //商品的id
        $category_ids = $request->get('id');

        if (is_array($category_ids) && count($category_ids) > 0 ) {
            foreach ($category_ids as $category_id) {
                $status = $this->deleteOnes($category_id);

                if ($status === false) {
                    return $this->response(self::ERROR_STATE_CODE, '删除商品失败');
                }
            }
        } elseif ( $category_ids > 0 ) {
            $status = $this->deleteOnes($category_ids);

            if ($status === false) {
                return $this->response(self::ERROR_STATE_CODE, '删除商品失败');
            }
        }
        return $this->response(self::SUCCESS_STATE_CODE, '删除商品成功');
    }

    /**
     * 删除单个商品
     *
     * @param $category_id 商品id
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function deleteOnes($category_id)
    {
        $cate_id = GoodsModel::isWeidianCategory($category_id);

        if ( $cate_id != false ) {

            if ($cate_id == 73238008) {
                return true;
            }
            $result = $this->send(self::GET_API_URL, [
                'param'     => json_encode(['cate_id' => $cate_id]),
                'public'    => '{"method":"vdian.shop.cate.delete"}',
            ]);

            if ($result === false) {
                return false;
            }
            return GoodsModel::deleteGoodsCategory($category_id);
        }
        return GoodsModel::deleteGoodsCategory($category_id);
    }

}
