<?php

// +----------------------------------------------------------------------
// | date: 2015-12-25
// +----------------------------------------------------------------------
// | PayController.php: 支付控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Tools;

use App\Http\Requests;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use OAuth;

class OAuthController extends BaseController
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

    /**
     * 发起支付
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getIndex(Request $request)
    {
        OAuth::login();
    }
}
