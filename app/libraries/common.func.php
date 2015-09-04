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
 * @author yangyifan <yangyifanphp@gmail.com>
 */
if(!function_exists('obj_to_array')){
    function obj_to_array($obj){
        return json_decode(json_encode($obj),true);
    }
}

/**
 * 对象 转成 数组
 *
 * @param $obj
 * @return array
 * @author yangyifan <yangyifanphp@gmail.com>
 */
if(!function_exists('array_to_obj')){
    function array_to_obj($array){
        return json_decode(json_encode($array));
    }
}


/**
 * 生成后台用户签名
 *
 * @param $params
 * @return string
 * @author yangyifan <yangyifanphp@gmail.com>
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
 * 判断是否后台登陆登录
 *
 * @return Int
 * @author yangyifan <yangyifanphp@gmail.com>
 */
if(!function_exists('is_admin_login')){
    function is_admin_login(){
        return hash_user_sign(Session::get('admin_info.admin_user_data')) == Session::get('admin_info.sign') ? Session::get('admin_info.id') : false;
    }
}

/**
 * 判断前台是否登录
 *
 * @return Int
 * @author yangyifan <yangyifanphp@gmail.com>
 */
if(!function_exists('is_user_login')){
    function is_user_login(){
        return hash_user_sign(Session::get('user_info.user_user_data')) == Session::get('user_info.sign') ? Session::get('user_info.id') : false;
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
     * @author yangyifan <yangyifanphp@gmail.com>
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
     * @author yangyifan <yangyifanphp@gmail.com>
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
if(!function_exists('get_location')){
    /**
     * 获得当前页面的“所在位置”
     *
     * @param $data
     * @param int $pid
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    function get_location($category, $pid = 0){
        $data = [];

        if(!empty($category)){
            foreach($category as $location){
                if($location['id'] == $pid){
                    $data[] = $location;
                    $data = array_merge($data, get_location($category, $location['pid']));
                }
            }
        }

        return $data;
    }
}

if(!function_exists('p')){
    /**
     * 另一个打印函数
     *
     * @param array $array
     * @author yangyifan <yangyifanphp@gmail.com>
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
     * @author yangyifan <yangyifanphp@gmail.com>
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
     * @author yangyifan <yangyifanphp@gmail.com>
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
     * @author yangyifan <yangyifanphp@gmail.com>
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

if(!function_exists('number_to_ch')){
    /**
     * 日期数字转中文
     * 用于日和月、周
     * @static
     * @access public
     * @param integer $number 日期数字
     * @return string
     */
    function  number_to_ch($number) {
        $number = intval($number);
        $array  = array('一','二','三','四','五','六','七','八','九','十');
        $str = '';
        if($number  ==0)  { $str .= "十" ;}
        if($number  <  10){
            $str .= $array[$number-1] ;
        }
        elseif($number  <  20  ){
            $str .= "十".$array[$number-11];
        }
        elseif($number  <  30  ){
            $str .= "二十".$array[$number-21];
        }
        else{
            $str .= "三十".$array[$number-31];
        }
        return $str;
    }
}


if(!function_exists('get_client_ip')){
    /**
     * 获取客户端IP地址
     * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
     * @return mixed
     */
    function get_client_ip($type = 0) {
        $type       =  $type ? 1 : 0;
        static $ip  =   NULL;
        if ($ip !== NULL) return $ip[$type];
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos    =   array_search('unknown',$arr);
            if(false !== $pos) unset($arr[$pos]);
            $ip     =   trim($arr[0]);
        }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip     =   $_SERVER['HTTP_CLIENT_IP'];
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip     =   $_SERVER['REMOTE_ADDR'];
        }
        // IP地址合法验证
        $long = sprintf("%u",ip2long($ip));
        $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
        return $ip[$type];
    }
}
