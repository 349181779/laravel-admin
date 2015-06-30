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

if(!function_exists('merge_tree_node')){
    /**
     * 组合tree节点
     *
     * @param $data
     * @param $pid
     * @param $level
     * @param $parent_id
     * @param $current_id
     * @return array
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    function merge_tree_node($data, $pid = 0, $level = 0, $parent_id = 0, $current_id = 0){
        $array = [];
        if(!empty($data)){
            foreach($data as $k=>$v){
                if($v['pid'] == $pid){
                    $v['parent_id']     = $v['pid'] == 0 ? '' : ltrim($parent_id .'-'. $v['pid'], '-');
                    $v['current_id']    = $v['pid'] == 0 ? $v['id'] : $current_id.'-'. $v['id'];
                    $v['level']         = $level;
                    $array[]            = $v;
                    unset($data[$k]);
                    $array = array_merge($array, merge_tree_node($data, $v['id'], $level+1, $v['parent_id'], $v['current_id']));
                }
            }
        }
        return $array;
    }
}

if(!function_exists('merge_tree_child_node')){
    /**
     * 组合tree节点
     *
     * @param $data
     * @param $pid
     * @param $level
     * @return array
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    function merge_tree_child_node($data, $pid = 0, $level = 0){
        $array = [];
        if(!empty($data)){
            foreach($data as $v){
                if($v['pid'] == $pid){
                    $v['level']         = $level;
                    $v['child']         = merge_tree_child_node($data, $v['id'], $level+1);
                    $array[]            = $v;
                }
            }
        }
        return $array;
    }
}

if(!function_exists('p')){
    /**
     * 另一个打印函数
     *
     * @param array $array
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    function p(Array $array){
        echo '<pre>';
        var_dump($array);
        echo '</pre>';die;
    }
}

if(!function_exists('password_encrypt')){
    /**
     * 加密密码
     *
     * @param $password
     * @return bool|false|string
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    function password_encrypt($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }
}

if(!function_exists('safe_base64_encode')){
    /**
     * 安全的base64编码
     *
     * @param $str
     * @return mixed
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    function safe_base64_encode($str){
        $find = array("+", "/");
        $replace = array("-", "_");
        return str_replace($find, $replace, base64_encode($str));
    }
}

if(!function_exists('safe_base64_decode')){
    /**
     * 安全的base64解码
     *
     * @param $str
     * @return mixed
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    function safe_base64_decode($str){
        $find = array("-", "_");
        $replace = array("+", "/");
        return base64_decode(str_replace($find, $replace, $str));
    }
}