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
if(!function_exists('objToArray')){
    function objToArray($obj){
        return json_decode(json_encode($obj), true);
    }
}

/**
 * 对象 转成 数组
 *
 * @param $obj
 * @return array
 * @author yangyifan <yangyifanphp@gmail.com>
 */
if(!function_exists('arrayToObj')){
    function arrayToObj($array){
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
if(!function_exists('hashUserSign')){
    function hashUserSign($params){
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
if(!function_exists('isAdminLogin')){
    function isAdminLogin(){
        return hashUserSign(Session::get('admin_info.admin_user_data')) == Session::get('admin_info.sign') ? Session::get('admin_info.id') : false;
    }
}

/**
 * 判断前台是否登录
 *
 * @return Int
 * @author yangyifan <yangyifanphp@gmail.com>
 */
if(!function_exists('isUserLogin')){
    function isUserLogin(){
        return hashUserSign(Session::get('user_info.user_user_data')) == Session::get('user_info.sign') ? Session::get('user_info.id') : false;
    }
}

if(!function_exists('mergeTreeNode')){
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
    function mergeTreeNode($data, $pid = 0, $level = 0, $parent_id = 0, $current_id = 0){
        $array = [];
        if(!empty($data)){
            foreach($data as $k=>$v){
                if($v['parent_id'] == $pid){
                    $v['parent_id']     = $v['parent_id'] == 0 ? '' : ltrim($parent_id .'-'. $v['parent_id'], '-');
                    $v['current_id']    = $v['parent_id'] == 0 ? $v['id'] : $current_id.'-'. $v['id'];
                    $v['level']         = $level;
                    $array[]            = $v;
                    unset($data[$k]);
                    $array = array_merge($array, mergeTreeNode($data, $v['id'], $level+1, $v['parent_id'], $v['current_id']));
                }
            }
        }
        return $array;
    }
}

if(!function_exists('mergeTreeChildNode')){
    /**
     * 组合tree节点
     *
     * @param $data
     * @param $pid
     * @param $level
     * @param $parent_name
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    function mergeTreeChildNode($data, $pid = 0, $level = 0, $parent_name = 'parent_id'){
        $array = [];
        if(!empty($data)){
            foreach($data as $v){;
                if($v[$parent_name] == $pid){
                    $v['level']         = $level;
                    $v['child']         = mergeTreeChildNode($data, $v['id'], $level+1, $parent_name);
                    $array[]            = $v;
                    unset($v);
                }
            }
        }
        return $array;
    }
}
if(!function_exists('getLocation')){
    /**
     * 获得当前页面的“所在位置”
     *
     * @param $data
     * @param int $pid
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    function getLocation($category, $pid = 0){
        $data = [];

        if(!empty($category)){
            foreach($category as $location){
                if($location['id'] == $pid){
                    $data[] = $location;
                    $data = array_merge($data, getLocation($category, $location['pid']));
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
        print_r($array);
        echo '</pre>';
    }
}

if(!function_exists('passwordEncrypt')){
    /**
     * 加密密码
     *
     * @param $password
     * @return bool|false|string
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    function passwordEncrypt($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }
}

if(!function_exists('safeBase64Encode')){
    /**
     * 安全的base64编码
     *
     * @param $str
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    function safeBase64Encode($str){
        $find = array("+", "/");
        $replace = array("-", "_");
        return str_replace($find, $replace, base64_encode($str));
    }
}

if(!function_exists('safeBase64Decode')){
    /**
     * 安全的base64解码
     *
     * @param $str
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    function safeBase64Decode($str){
        $find = array("-", "_");
        $replace = array("+", "/");
        return base64_decode(str_replace($find, $replace, $str));
    }
}

if(!function_exists('curlPost')){
    /**
     * curl_post
     *
     * @author aaron
     * @param string $url
     * @param string $str_params
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    function curlPost($url,$str_params = ''){
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

if(!function_exists('curlGet')){
    /**
     * curl_get
     *
     * @author aaron
     * @param string $url
     * @param string $str_params
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    function curlGet($url,$str_params = ''){
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

if(!function_exists('numberToCh')){
    /**
     * 日期数字转中文
     * 用于日和月、周
     *
     * @static
     * @access public
     * @param integer $number 日期数字
     * @return string
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    function  numberToCh($number) {
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


if(!function_exists('getClientIp')){
    /**
     * 获取客户端IP地址
     *
     * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    function getClientIp($type = 0) {
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

if(!function_exists('createUrl')){
    /**
     * 生成url
     *
     * @param $url
     * @param array $param
     * @return string
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    function createUrl($url, Array $param = []){
        if(!empty($url)){
            if(!empty($param)){
                return action($url) . '?' . http_build_query($param);
            }
            return action($url);
        }
    }
}

