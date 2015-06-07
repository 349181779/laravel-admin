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
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\AdminBaseModel AS Base;

class BaseController extends Controller {


    /**
     * 构造方法
     *
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct(){

    }

    /**
     * 响应
     *
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
	protected function response($code = 200, $msg = '', $data = []){
        die(json_encode(compact('code', 'msg', 'data')));
    }

}
