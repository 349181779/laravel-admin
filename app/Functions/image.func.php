<?php

// +----------------------------------------------------------------------
// | date: 2015-08-02
// +----------------------------------------------------------------------
// | image.func.php: 获得图片函数库
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

/**
 * 发送 task 任务 到swoole server
 *
 * @param $targer   目标连接
 * @param $params   提交目标连接参数
 * @param $callback 回调地址
 * @return mixed(int|bool)
 * @author yangyifan <yangyifanphp@gmail.com>
 */
if(!function_exists('get_user_info_face')){
    function get_user_info_face($image_name){
        return config('config.user_info_face_prefix') . $image_name;
    }
}




