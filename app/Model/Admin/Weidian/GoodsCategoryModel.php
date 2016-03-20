<?php

// +----------------------------------------------------------------------
// | date: 2016-03-18
// +----------------------------------------------------------------------
// | GoodsCategoryModel.php: 微店商品分类模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Admin\Weidian;

class GoodsCategoryModel extends BaseModel
{
    protected $table = 'weidian_category_goods';

    public $timestamps = false;//开启维护时间戳

    /**
     * 新增商品分类信息
     *
     * @param $goods_id                 商品id
     * @param $goods_category_arr array      商品分类数组
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function addGoodsCategorys($goods_id, array $goods_category_arr = [])
    {
        if ( $goods_id > 0 && count($goods_category_arr) > 0 ) {

            //删除当前商品关联的商品分类
            self::deleteGoodsCategory($goods_id);
            foreach ($goods_category_arr as $goods_category) {
                $status = self::addGoodsCategory($goods_id, $goods_category);

                if ( $status == false ) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }

    /**
     * 删除当前商品关联的商品分类
     *
     * @param $goods_id 商品id
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function deleteGoodsCategory($goods_id)
    {
        if ( $goods_id > 0 ) {
            return self::multiwhere( ['goods_id' => 0] )->delete();
        }
        return false;
    }

    /**
     * 新增商品分类
     *
     * @param $goods_id     商品id
     * @param $goods_sku    商品图片
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function addGoodsCategory($goods_id, array $category_info)
    {
        if ( $goods_id > 0 && count($category_info) > 0 ) {
            //如果当前分类不存在，则添加当前商品分类
            $category_id = CategoryModel::isCurrenCategory($category_info['cate_id']);

            if ( $category_id === false ) {
                $insert_category_info = CategoryModel::create([
                    'cate_id'       => $category_info['cate_id'],
                    'cate_name'     => $category_info['cate_name'],
                    'sort_num'      => $category_info['sort_num'],
                ]);
                $category_id = $insert_category_info->id;
            }

            $inser_data = self::create([
                'category_id'   => $category_id,
                'goods_id'      => $goods_id,
            ]);
            return $inser_data->id > 0 ? true : false;
        }
        return false;
    }
}

