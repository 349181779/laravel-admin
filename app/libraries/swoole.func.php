<?php

// +----------------------------------------------------------------------
// | date: 2015-06-06
// +----------------------------------------------------------------------
// | swoole.func.php: 获得实例函数库
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
 * @auther yangyifan <yangyifanphp@gmail.com>
 */
if(!function_exists('send_task_to_swoole_server')){
    function send_task_to_swoole_server($targer, $params, $callback){
        $swoole_client = get_swoole_client();
        return $swoole_client->send(json_encode([
                'step'      => 'task',
                'targer'    => $targer,
                'params'    => $params,
                'callback'  => $callback,
            ]).config('swoole.package_eof')
        );
    }
}

/**
 * 发送 普通数据 到swoole server
 *
 * @param $targer   目标连接
 * @param $params   提交目标连接参数
 * @param $callback 回调地址
 * @return mixed(int|bool)
 * @auther yangyifan <yangyifanphp@gmail.com>
 */
if(!function_exists('send_to_swoole_server')){
    function send_to_swoole_server($targer, $params, $callback){
        $swoole_client = get_swoole_client();
        return $swoole_client->send(json_encode([
                'step'      => 'default',
                'targer'    => $targer,
                'params'    => $params,
                'callback'  => $callback,
            ]).config('swoole.package_eof')
        );
    }
}




