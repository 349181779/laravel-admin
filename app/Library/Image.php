<?php

// +----------------------------------------------------------------------
// | date: 2015-09-17
// +----------------------------------------------------------------------
// | Image.php: 图片
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Library;

class Image
{
    private static $all_image_source;//图片资源
    private static $all_image_type;//图片类型
    private static $image_host;//图片url

    /**
     * 获得图片资源类型
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAllImageSource()
    {
        if (empty(self::$all_image_source)) {
            self::$all_image_source = config('config.image_source');
        }
        return self::$all_image_source;
    }

    /**
     * 获得图片类型
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAllImageType()
    {
        if (empty(self::$all_image_type)) {
            self::$all_image_type = config('config.image_type');
        }
        return self::$all_image_type;
    }

    /**
     * 获得图片host
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function getImageHost()
    {
        if (empty(self::$image_host)) {
            self::$image_host = config('upload.upyun.imagesHots');
        }
        return self::$image_host;
    }

    /**
     * 获得图片真实路径
     *
     * @param $image_name
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getImageRealPath($image_name, $source = 1, $image_type = 2)
    {
        //如果没有，则使用默认图片
        if (empty($image_name)) {
            return self::getDefaultImage();
        }

        //判断来源类型
        $path = self::getPath($source, $image_type);
        if (!empty(($path))) {
            return self::getImageHost() . $path . $image_name;
        }



        return false;
    }

    /**
     * 获得默认图片
     *
     * @return string
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getDefaultImage()
    {
        return self::getImageHost() . '/' . 'Public/load.png';
    }

    /**
     * 获得当前路径
     *
     * @param int $source
     * @param int $image_type
     * @return bool|string
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getPath($source = 1, $image_type = 2)
    {
        //图片来源
        $source_arr         = self::getAllImageSource();
        //图片类型
        $images_type_arr    = self::getAllImageType();

        if (array_key_exists($source, $source_arr)) {
            if (array_key_exists($image_type, $images_type_arr)) {
                return '/' .$source_arr[$source] . '/' .$images_type_arr[$image_type] . '/';
            }
        }
        return false;
    }



}