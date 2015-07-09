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
        echo '</pre>';
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

if(!function_exists('curl_post')){
    /**
     * curl_post
     * @author aaron
     * @param string $url
     * @param string $str_params
     */
    function curl_post($url,$str_params = ''){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);                                    // 设置访问链接
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);                         // 是否返回信息
        curl_setopt($ch, CURLOPT_HEADER, 'Content-type: application/json');     // 设置返回信息数据格式 application/json
        curl_setopt($ch, CURLOPT_POST, TRUE);                                   // 设置post方式提交
        curl_setopt($ch, CURLOPT_POSTFIELDS, $str_params);                      // POST提交数据
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);                                   // 响应时间 5s
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}

if(!function_exists('curl_get')){
    /**
     * curl_get
     * @author aaron
     * @param string $url
     * @param string $str_params
     */
    function curl_get($url,$str_params = ''){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);                                    // 设置访问链接
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);                         // 是否返回信息
        curl_setopt($ch, CURLOPT_HEADER, 'Content-type: application/json');     // 设置返回信息数据格式 application/json
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);                                   // 响应时间 5s
        $http_head = mb_substr($url,0,5);
        if($http_head == 'https'){
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);                    // https请求 不验证证书和hosts
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        }
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}
