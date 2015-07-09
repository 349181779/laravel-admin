<?php

// +----------------------------------------------------------------------
// | date: 2015-07-04
// +----------------------------------------------------------------------
// | BaseModel.php: 公共模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class BaseModel extends Model{


    /**
     * 搜索
     *
     * @param $map
     * @param $sort
     * @param $order
     * @param $offset
     * @return mixed
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    protected static function search($map, $sort, $order, $limit, $offset){
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
     * 多条件查询where
     *
     * @return mixed
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function scopeMultiwhere($query, $arr){
        if (!is_array($arr)) {
            return $query;
        }
        foreach ($arr as $key => $value) {
            //判断$arr
            if(is_array($value)){
                $value[0] = strtolower($value[0]);
                switch(strtolower($value[0])){
                    case 'like';
                        $query = $query->where($key, $value[0] ,$value[1]);
                        break;
                    case 'in':
                        $query = $query->whereIn($key, $value[1]);
                        break;
                    case 'between':
                        $query = $query->whereBetween($key, $value[1][0], $value[1][1]);
                        break;
                }
            }else{
                $query = $query->where($key, $value);
            }
        }
        return $query;
    }

    /**
     * 组合性别
     *
     * @param $sex
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    protected static function mergeUserSex($sex){
        if(empty($sex)){
            return;
        }
        switch($sex){
            case 1:
                return trans('response.sex_1');
            case 2:
                return trans('response.sex_2');
            default:
                return trans('response.sex_3');
        }
    }

    /**
     * 组合状态
     *
     * @param $sex
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    protected static function mergeStatus($status){
        if(empty($status)){
            return;
        }
        switch($status){
            case 1:
                return trans('response.on');
            default:
                return trans('response.off');
        }
    }

    /**
     * 组合图片路径
     *
     * @param $image_src
     * @param $image_type
     * @return string
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    protected static function mergeImagePath($image_src, $image_type = 1){
        return config('config.file_url').$image_src;
    }

    /**
     * 打印最后一条执行sql
     *
     * @return mixed
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public static function getLastSql(){
        $sql = DB::getQueryLog();
        $query = end($sql);
        return $query;
    }
}

