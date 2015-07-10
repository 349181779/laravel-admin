<?php

// +----------------------------------------------------------------------
// | date: 2015-07-04
// +----------------------------------------------------------------------
// | AdminResource.php: 后端资源模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App;

use DB;

class AdminResource extends BaseModel {

    protected $table    = 'resource';//定义表名
    protected $guarded  = ['*'];//阻挡所有属性被批量赋值

    private static  $url;

    /**
     * 组合搜索结果集
     *
     * @param $data
     * @return mixed
     * @return mixed'@auther yangyifan <yangyifanphp@gmail.com>
     */
    protected static function mergeData($data){
        if(!empty($data)){
            $file_type_array = config('config.file_type');

            //设置文件路径
            self::$url = config('config.file_url');

            foreach($data as &$v){
                //组合状态
                $v->status      = self::mergeStatus($v->status);
                //组合文件名称
                $v->file_name   = self::mergeResourceFileName($v->file_name, $v->file_type);
                //组合文件类型
                $v->file_type   = array_key_exists($v->file_type, $file_type_array) > 0 ? $file_type_array[$v->file_type] : trans('response.file_unkown');

            }
        }
        return $data;
    }

    /**
     * 组合文件名称
     *
     * @param $file_name
     * @param $file_type
     * @return string
     */
    private static function mergeResourceFileName($file_name, $file_type){
        switch($file_type){
            case 1:
                return '<img src="'.self::$url.$file_name.'" data-src="'.$file_name.'" style="width:100px;height:100px;" onclick="choseImage(this)" />';
            case 2:
                return '<span class="entypo-note"></span>';
            case 3:
                return '<img src="/images/video.png" data-src="'.$file_name.'" style="width:100px;height:100px;" onclick="choseImage(this)" />';
        }
    }
}
