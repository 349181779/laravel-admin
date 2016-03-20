<?php

// +----------------------------------------------------------------------
// | date: 2016-03-18
// +----------------------------------------------------------------------
// | GoodsSKUModel.php: 微店商品SKU模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Admin\Weidian;

class GoodsSKUModel extends BaseModel
{
    protected $table = 'weidian_goods_sku';

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
                $v->class_name   = self::mergeClassName($v->status);

                //组合状态
                $v->is_sync      = $v->status == 2
                    ? "<a class='btn btn-danger glyphicon glyphicon-refresh' href='javascript:void(0)' disabled='disabled'> 已经删除</a>"
                    :
                    (
                    self::mergeStatus($v->is_sync) == 'true'
                        ? "<a class='btn btn-warning glyphicon glyphicon-refresh' href='javascript:void(0)' > 需要同步</a>"
                        : "<a class='btn btn-success glyphicon glyphicon-ok-circle' href='javascript:void(0)'> 不需要同步</a>"
                    );

                //组合操作
                if ($v->status == 2){
                    $v->handle       = '<a class="btn btn-primary" disabled="disabled" href="javascript:void(0)" >修改</a>';
                    $v->handle      .= '&nbsp;';
                    $v->handle      .= '<a class="btn btn-danger" disabled="disabled" href="javascript:void(0)" >删除</a>';
                } else {
                    $v->handle       = '<a class="btn btn-primary" href="'.createUrl('Admin\Weidian\GoodsSKUController@getEdit',['id' => $v->id]).'" >修改</a>';
                    $v->handle      .= '&nbsp;';
                    $v->handle      .= '<a class="btn btn-danger" href="javascript:void(0)" onclick="category.deleteCategory(\''.createUrl('Admin\Weidian\CategoryController@postDelete').'\', '.$v->id.')" >删除</a>';
                }


            }
        }
        return $data;
    }


    /**
     * 新增商品SKU信息
     *
     * @param $goods_id                 商品id
     * @param $goods_sku_arr array      SKU数组信息
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function addGoodsSKUs($goods_id, array $goods_sku_arr = [])
    {
        if ( $goods_id > 0 && count($goods_sku_arr) > 0 ) {
            foreach ($goods_sku_arr as $goods_sku) {
                $status = self::addGoodsSKU($goods_id, $goods_sku);

                if ( $status == false ) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }

    /**
     * 新增商品SKU
     *
     * @param $goods_id     商品id
     * @param $goods_sku    商品图片
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function addGoodsSKU($goods_id, $goods_sku)
    {
        if ( $goods_id > 0 && count($goods_sku) > 0 ) {
            $inser_data = self::create([
                'sku_id'            => $goods_sku['id'],
                'title'             => $goods_sku['title'],
                'price'             => $goods_sku['price'],
                'stock'             => $goods_sku['stock'],
                'sku_merchant_code' => $goods_sku['sku_merchant_code'],
                'goods_id'          => $goods_id,
            ]);
            return $inser_data->id > 0 ? true : false;
        }
        return false;
    }
}

