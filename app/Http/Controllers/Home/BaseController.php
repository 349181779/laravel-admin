<?php

// +----------------------------------------------------------------------
// | date: 2015-07-12
// +----------------------------------------------------------------------
// | BaseController.php: 前台基础控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

use Session;

class BaseController extends \App\Http\Controllers\BaseController {

    /**
     * 构造方法
     *
     */
    public function __construct(){
        load_func('common');
    }

}
