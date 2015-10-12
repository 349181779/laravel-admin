<?php

// +----------------------------------------------------------------------
// | date: 2015-09-26
// +----------------------------------------------------------------------
// | ImageModel.php: 后端图片模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Admin\Image;

use App\Model\Admin\MergeModel;
use App\Library\Image;
use App\Model\Admin\BaseModel;

class ImageModel extends BaseModel
{

    protected $table    = 'images';//定义表名
    protected $guarded  = ['id'];//阻挡所有属性被批量赋值

    private static $all_state;//图片状态

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
            'count' =>  self::multiwhere($map)->count(),
        ];
    }

    /**
     * 组合数据
     *
     * @param $roles
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeData($data)
    {
        if (!empty($data)) {
            foreach($data as &$v){
                //组合广告类型
                $v->image       =  MergeModel::mergeImage($v->image_name, $v->source, $v->image_type);
                //组合图片类型
                $v->image_type  = self::mergeImageType($v->image_type);
                //组合图片状态
                $v->state       = self::mergeState($v->state);
                //组合图片来源
                $v->source      = self::mergeImageSource($v->source);
                //组合操作
                $v->handle      .= '<a href="'.createUrl('Admin\AdController@getEdit', ['id' => $v->id]).'" target="_blank" >删除</a>';
            }
        }
        return $data;
    }

    /**
     * 获得图片全部类型
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function getAllState()
    {
        if (empty(self::$all_state)) {
            self::$all_state = [
                1 => trans('response.image_used'),
                2 => trans('response.image_not_use'),
            ];
        }
        return self::$all_state;
    }

    /**
     * 组合图片状态
     *
     * @param $state
     * @return bool
     */
    private static function mergeState($state)
    {
        if (empty($state)) {
            return false;
        }

        $all_state = self::getAllState();

        if (array_key_exists($state, $all_state)) {
            return $all_state[$state];
        }
    }

    /**
     * 组合图片资源来源
     *
     * @param $image_source
     * @return string
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeImageSource($image_source)
    {
        if (empty($image_source)) {
            return false;
        }

        //获取全部图片来源
        $all_image_source = Image::getAllImageSource();

        if(array_key_exists($image_source, $all_image_source)){
            return $all_image_source[$image_source];
        }
    }

    /**
     * 组合图片资源来源 （select表单格式）
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeImageSourceForSelect()
    {
        //获取全部图片来源
        $all_image_source   = Image::getAllImageSource();
        $data               = [];

        if (!empty($all_image_source)) {
            foreach ($all_image_source as $key => $image_source) {
                $data[] = [
                    'id'    => $key,
                    'name'  => $image_source,
                ];
            }
        }
        return $data;
    }

    /**
     * 组合图片资源类型
     *
     * @param $image_type
     * @return string
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeImageType($image_type)
    {
        if (empty($image_type)) {
            return false;
        }

        //获取全部图片类型
        $all_image_type = Image::getAllImageType();

        if (array_key_exists($image_type, $all_image_type)) {
            return $all_image_type[$image_type];
        }
    }

    /**
     * 组合图片资源类型（select表单格式）
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeImageTypeForSelect()
    {
        //获取全部图片类型
        $all_image_type     = Image::getAllImageType();
        $data               = [];

        if (!empty($all_image_type)) {
            foreach ($all_image_type as $key => $image_type) {
                $data[] = [
                    'id'    => $key,
                    'name'  => $image_type,
                ];
            }
        }
        return $data;
    }

    /**
     * 获得js 事件
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function uploadJsEvent()
    {
        return [
            [
                'name'          => 'click',//事件名称
                'function_name' => 'showUploadDialog',//方法名称
                'params'        => json_encode( ['url' => createUrl('Admin\Image\ImageController@getUploadView') ] )],//js参数,json格式
        ];
    }

    /**
     * 上传完成图片回调方法
     *
     * @param $image_name
     * @param int $source
     * @param int $image_type
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function uploadSuccessCallback($image_name, $source = 1, $image_type = 1)
    {
        //新增记录到数据库
        return self::insertGetId([
            'image_name'    => $image_name,
            'image_type'    => $image_type,
            'source'        => $source,
        ]);
    }

    /**
     * 判断文件是否存在数据库
     *
     * @param $image_name
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function exists($image_name)
    {
        return self::multiwhere(['image_name' => $image_name])->count() > 0 ;
    }


}
