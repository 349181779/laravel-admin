<?php


// +----------------------------------------------------------------------
// | date: 2015-06-06
// +----------------------------------------------------------------------
// | common.func: 公共函数库
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

/**
 * 对象 转成 数组
 *
 * @param $obj
 * @return array
 * @auther yangyifan <yangyifanphp@gmail.com>
 */
if(!function_exists('obj_to_array')){
    function obj_to_array($obj){
        return json_decode(json_encode($obj),true);
    }
}

/**
 * 生成后台用户签名
 *
 * @param $params
 * @return string
 * @auther yangyifan <yangyifanphp@gmail.com>
 */
if(!function_exists('hash_user_sign')){
    function hash_user_sign($params){
        if(!is_array($params)){
            $params = (array)$params;
        }
        ksort($params);
        $sign   = http_build_query($params);
        return sha1($sign);
    }
}

/**
 * 判断是否登录
 *
 * @return Int
 * @auther yangyifan <yangyifanphp@gmail.com>
 */
if(!function_exists('is_login')){
    function is_login(){
        return hash_user_sign(Session::get('admin_info.admin_user_data')) == Session::get('admin_info.sign') ? Session::get('admin_info.id') : false;
    }
}