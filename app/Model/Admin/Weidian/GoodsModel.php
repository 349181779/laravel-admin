<?php

// +----------------------------------------------------------------------
// | date: 2016-03-18
// +----------------------------------------------------------------------
// | GoodsModel.php: 微店商品模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Admin\Weidian;

class GoodsModel extends BaseModel
{
    protected $table = 'weidian_goods';

    /**
     * 搜索
     *
     * @param $map
     * @param $sort
     * @param $order
     * @param $offset
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    protected static function search($map, $sort, $order, $limit, $offset)
    {
        return [
            'data' => self::mergeData(
                self::multiwhere($map)->
                orderBy($sort, $order)->
                skip($offset)->
                take($limit)->
                get()
            ),
            'count' => self::multiwhere($map)->count(),
        ];
    }

    /**
     * 组合数据
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeData($data)
    {
        if (!empty($data)) {
            foreach($data as &$v){
                //组合列表col样式，如果是红色，表示已经被软删除
                $v->class_name      = self::mergeClassName($v->status);

                //组合状态
                $v->is_sync         = $v->status == 2
                                    ? "<a class='btn btn-danger glyphicon glyphicon-refresh' href='javascript:void(0)' disabled='disabled'> 已经删除</a>"
                                    :
                                    (
                                        self::mergeStatus($v->is_sync) == 'true'
                                        ? "<a class='btn btn-warning glyphicon glyphicon-refresh' href='javascript:void(0)' > 需要同步</a>"
                                        : "<a class='btn btn-success glyphicon glyphicon-ok-circle' href='javascript:void(0)'> 不需要同步</a>"
                                    );

                //组合是否店家推荐
                $v->istop           = $v->istop == 1 ? '是' : '否';

                //组合商品状态
                $v->status          = $v->status == 'onsale' ? '销售中' : ($v->status == 'instock' ? '已下架' : '已删除');

                //组合操作
                if ($v->status == 2){
                    $v->handle       = '<a class="btn btn-primary" disabled="disabled" href="javascript:void(0)" >修改</a>';
                    $v->handle      .= '&nbsp;';
                    $v->handle      .= '<a class="btn btn-primary" disabled="disabled" href="javascript:void(0)" >查看SKU</a>';
                    $v->handle      .= '&nbsp;';
                    $v->handle      .= '<a class="btn btn-primary" disabled="disabled" href="javascript:void(0)" >查看图片</a>';
                    $v->handle      .= '&nbsp;';
                    $v->handle      .= '<a class="btn btn-danger" disabled="disabled" href="javascript:void(0)" >删除</a>';
                } else {
                    $v->handle       = '<a class="btn btn-primary" href="'.createUrl('Admin\Weidian\GoodsController@getEdit', ['id' => $v->id]).'" >修改</a>';
                    $v->handle      .= '&nbsp;';
                    $v->handle      .= '<a class="btn btn-primary" href="'.createUrl('Admin\Weidian\GoodsSKUController@getIndex', ['goods_id' => $v->id]).'" >查看SKU</a>';
                    $v->handle      .= '&nbsp;';
                    $v->handle      .= '<a class="btn btn-primary" href="'.createUrl('Admin\Weidian\GoodsImageController@getUploadImage', ['goods_id' => $v->id]).'" >查看图片</a>';
                    $v->handle      .= '&nbsp;';
                    $v->handle      .= '<a class="btn btn-danger" href="javascript:void(0)" onclick="category.deleteCategory(\''.createUrl('Admin\Weidian\GoodsController@postDelete').'\', '.$v->id.')" >删除</a>';
                }


            }
        }
        return $data;
    }

    /**
     * 获得商品信息
     *
     * @param $goods_id
     * @return \stdClass
     */
    public static function getGoodsInfo($goods_id)
    {
        if ( $goods_id > 0 ) {
            $goods_info = self::find($goods_id);

            if (!empty($goods_info)) {
                $goods_info->desc = GoodsDescModel::getGoodsDesc($goods_id);
            }
            return $goods_info;
        }
        return new \stdClass();
    }

    /**
     * 获得编辑器参数
     *
     * @param $request
     * @return string
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getCkEditorParams()
    {
        return  "customConfig : '/ckeditor/config.js',".
        "toolbar:'Basic' ";
    }

    /**
     * 更新商品信息
     *
     * @param $data
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function updateGoodsInfo($data)
    {
        $Model  = self::findOrFail($data['id']);

        $Model->fill($data);

        //如果修改了数据，则把当前商品修改成需要同步的数据
        if ($Model->isEqual(['item_name', 'price', 'stock', 'merchant_code']) == false) {
            $Model->is_sync = 1;
        }
        $Model->save();
        return true;
    }

    /**
     * 更新商品为需要同步状态
     *
     * @param $goods_id 商品id
     * @return bool
     */
    public static function updateToIsSync($goods_id)
    {
        if ( $goods_id > 0 ) {
            return self::multiwhere( ['id' => $goods_id] )->update([
                'is_sync'   => 1,
            ]) > 0 ? true : false;
        }
        return false;
    }

    /**
     * 合并微店已经存在的商品
     *
     * @param array $goods_arr
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeWeidianGoods($goods_arr = [])
    {
        if (is_array($goods_arr) && count($goods_arr) > 0 ) {
            foreach ($goods_arr as $goods) {
                if (self::goodsExists(0, $goods['item_name']) == false ) {

                    $insert_data = self::create([
                        'istop'         => $goods['istop'],
                        'status'        => is_null($goods['status']) ? 'onsale' : $goods['status'],
                        'itemid'        => $goods['itemid'],
                        'merchant_code' => $goods['merchant_code'],
                        'stock'         => $goods['stock'],
                        'price'         => $goods['price'],
                        'update_time'   => $goods['update_time'],
                        'item_name'     => $goods['item_name'],
                        'fx_fee_rate'   => $goods['fx_fee_rate'],
                        'seller_id'     => $goods['seller_id'],
                        'sold'          => $goods['sold'],
                        'is_sync'       => 2,

                        //cates
                        //thumb_imgs
                    ]);

                    if ($insert_data->id > 0 ) {
                        //新增商品图片
                        GoodsImageModel::addGoodsImages($insert_data->id, $goods['imgs']);

                        //新增商品描述信息
                        GoodsDescModel::addGoodsDesc($insert_data->id, $goods['item_desc']);

                        //新增商品sku信息
                        GoodsSKUModel::addGoodsSKUs($insert_data->id, $goods['skus']);

                        //新增商品分类信息
                        GoodsCategoryModel::addGoodsCategorys($insert_data->id, $goods['cates']);

                    }
                } else{
                    self::multiwhere( ['item_name' => $goods['item_name']] )->update([
                        'itemid' => $goods['itemid'],
                    ]);
                }
            }
        }
    }

    /**
     * 判断分类是否存在
     *
     * @param int $goods_id
     * @param string item_name
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function goodsExists($goods_id = 0, $item_name = '')
    {
        $map = [];

        if ($goods_id > 0 ) {
            $map['id'] = $goods_id;
        }
        if (!empty($item_name)) {
            $map['item_name']   = $item_name;
        }

        if (is_array($map) && count($map) > 0 ) {
            return self::multiwhere($map)->count() > 0 ? true : false;
        }
        return false;
    }

    /**
     * 是否存在商品分类
     *
     * @param $id 商品分类id
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function isWeidianCategory($id)
    {
        if ( $id > 0  ) {
            $cate_id = self::multiwhere( ['id' => $id] )->pluck('cate_id');
            return $cate_id > 0 ? $cate_id :false;
        }
        return false;
    }


    /**
     * 获得拉取微店分类js event
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getPullEvent()
    {
        return [
            [
            'name'          => 'onClick',//事件
            'function_name' => 'category.pullWeidianCategory',//方法名称
            'params'        => '"'.createUrl('Admin\Weidian\GoodsController@postPull').'"',//参数
            ]
        ];
    }

    /**
     * 获得同步微店分类js event
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getSyncEvent()
    {
        return [
            [
                'name'          => 'onClick',//事件
                'function_name' => 'category.syncWeidianCategory',//方法名称
                'params'        => '"'.createUrl('Admin\Weidian\GoodsController@postSync').'"',//参数
            ]
        ];
    }

    /**
     * 获得全部应该上传到微店的商品分类
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAllShoudAddCategory()
    {
        return self::multiwhere(['cate_id' => 0])->get();
    }

    /**
     * 获得全部应该更新到微店的商品分类
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAllShoudUpdateCategory()
    {
        return self::multiwhere(['is_sync' => 1])->get();
    }

    /**
     * 更新分类为同步成功
     *
     * @param $cate_id
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function updateCategoryToSyncSuccess($cate_id)
    {
        if ( $cate_id > 0 ) {
            return self::multiwhere(['cate_id' => $cate_id])->update([
                'is_sync' => 2,
            ]) > 0 ? true : false;
        }
        return false;
    }

    /**
     * 软删除商品分类
     *
     * @param $id           分类id
     * @param $cate_id      微店商品分类id
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function deleteGoodsCategory($id = 0, $cate_id = 0)
    {
        if ( $id > 0 || $cate_id > 0 ) {

            $map = [];

            if ( $id > 0 ) {
                $map['id'] = $id;
            }
            if ( $cate_id > 0 ) {
                $map['cate_id'] = $cate_id;
            }

            if (count($map) > 0 ) {
                return self::multiwhere($map)->update([
                    'status' => 2,
                ]) > 0 ? true : false;
            }
        }
        return false;
    }
}

