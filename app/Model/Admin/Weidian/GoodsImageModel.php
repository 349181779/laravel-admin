<?php

// +----------------------------------------------------------------------
// | date: 2016-03-18
// +----------------------------------------------------------------------
// | GoodsImageModel.php: 微店商品图片模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Admin\Weidian;

class GoodsImageModel extends BaseModel
{
    protected $table = 'weidian_goods_images';

    /**
     * 批量新增商品图片
     *
     * @param $goods_id
     * @param array $images
     * @return bool
     */
    public static function addGoodsImages($goods_id, array $images = [])
    {
        if ( $goods_id > 0 && count($images) > 0 ) {
            foreach ($images as $image) {
                $status = self::addGoodsImage($goods_id, $image);

                if ( $status == false ) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }

    /**
     * 新增商品图片
     *
     * @param $goods_id 商品id
     * @param $image    商品图片
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function addGoodsImage($goods_id, $image)
    {
        if ( $goods_id > 0 && !empty($image) > 0 ) {
            $inser_data = self::create([
                'media'     => $image,
                'goods_id'  => $goods_id,
            ]);
            return $inser_data->id > 0 ? true : false;
        }
        return false;
    }

    const INPUT_NAME = 'media';//上传商品图片表单名称

    /**
     * 获得当前商品全部图片
     *
     * @param $goods_id
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getGoodsImage($goods_id)
    {
        if ($goods_id > 0 ) {
            //获得当前商品全部图片
            return self::multiwhere( [ 'goods_id' => $goods_id])->get();
        }
        return false;
    }

    /**
     * 更新图片到数据库
     *
     * @param $image_name   图片正式路径
     * @param $goods_id     商品id
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function updateImageToShop($image_name, $goods_id)
    {
        if (!empty($image_name) && $goods_id > 0 ) {
            return self::insertGetId([
                'goods_id'      => $goods_id,
                'media'         => $image_name,
            ]) > 0 ? true : false;
        }
        return false;
    }
}

