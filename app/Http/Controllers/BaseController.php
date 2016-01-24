<?php

// +----------------------------------------------------------------------
// | date: 2015-06-06
// +----------------------------------------------------------------------
// | BaseController: 基础控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------


namespace App\Http\Controllers;

use App\Http\Requests;
<<<<<<< HEAD

class BaseController extends Controller {

    const SUCCESS_STATE_CODE    = 200;//成功状态码
    const ERROR_STATE_CODE      = 400;//失败状态码
=======
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\AdminBaseModel AS Base;

class BaseController extends Controller {

>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1

    /**
     * 构造方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct(){
<<<<<<< HEAD
        //开启sql调试
        \DB::connection()->enableQueryLog();
=======

>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
    }

    /**
     * 响应
     *
     * @param $code     状态码
     * @param $msg      提示文字
     * @param $data     数据
     * @param $target   是否跳转到新页面
     * @prams $href     跳转的网址
     * @author yangyifan <yangyifanphp@gmail.com>
     */
<<<<<<< HEAD
	protected function response($code = self::SUCCESS_STATE_CODE, $msg = '', $data = [], $target = true, $href = ''){
        //die(json_encode(compact('code', 'msg', 'data', 'target', 'href')));
        echo json_encode(compact('code', 'msg', 'data', 'target', 'href'));
=======
	protected function response($code = 200, $msg = '', $data = [], $target = true, $href = ''){
        die(json_encode(compact('code', 'msg', 'data', 'target', 'href')));
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
    }

}
