<?php

// +----------------------------------------------------------------------
// | date: 2016-01-12
// +----------------------------------------------------------------------
// | BaseController.php: 自动构建基础控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Build;

use App\Model\Admin\Admin\AdminFunctionModel;
use App\Model\Admin\Admin\AdminInfoModel;
use App\Model\Admin\Admin\AdminMenuModel;
use Illuminate\Http\Request;
use Route;
use View;
use App\Model\Admin\Admin\AdminLimitFunctionModel;

class BaseController extends \App\Http\Controllers\BaseController
{
    /**
     * 构造方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct()
    {
        parent::__construct();
    }
}
