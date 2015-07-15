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

use App\Model\Home\BaseModel;

use Session;

class BaseController extends \App\Http\Controllers\BaseController {

    /**
     * 构造方法
     *
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct(){
        //加载函数库
        load_func('common');
        //获得导航数据
        $this->getSearch();
    }


    /**
     * 获得导航数据
     *
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    private function getSearch(){
        view()->share('all_search', BaseModel::getSearch());
    }

}
