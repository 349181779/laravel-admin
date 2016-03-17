<?php

// +----------------------------------------------------------------------
// | date: 2015-12-25
// +----------------------------------------------------------------------
// | SearchController.php: 搜索控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Tools;

use App\Http\Requests;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class SearchController extends BaseController
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
     * 首页
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getIndex()
    {
        $xs = app('search', [
            'config_name' => 'search/demo.ini'
        ]);
        $index = $xs->index;
    }
}
