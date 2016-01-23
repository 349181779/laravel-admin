<?php

// +----------------------------------------------------------------------
// | date: 2016-01-23
// +----------------------------------------------------------------------
// | BaseController.php: 创建配置文件基础控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace Yangyifan\AutoBuild\Http\Controllers\Config;

class BaseController extends \Yangyifan\AutoBuild\Http\Controllers\BaseController
{
    const CONFIG_PATH   = '/build';//配置文件生成的文件夹名称(默认在storage文件夹下面)
    const CONFIG_EXT    = '.json';//配置文件后缀

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
