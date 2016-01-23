<?php

// +----------------------------------------------------------------------
// | date: 2016-01-23
// +----------------------------------------------------------------------
// | RequestController.php: 创建 Request 控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace Yangyifan\AutoBuild\Http\Controllers\Config;

use Illuminate\Http\Request;
use Yangyifan\AutoBuild\Model\Build\BuildRequestModel;
use Yangyifan\AutoBuild\Model\Config\ConfigRequestModel;
use Yangyifan\AutoBuild\Model\HomeModel;

class RequestController extends BaseController
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
     * 创建配置页面
     *
     * @param Request $request
     * @return \Illuminate\View\View
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getCreateConfig(Request $request)
    {
        $table_name = $request->get('table_name');
        //dd(ConfigRequestModel::getConfig($table_name));
        return view('vendor.auto_build.create_config', [
            'table_name'    => $table_name,//表名称
            'schema_list'   => HomeModel::getSchemaList($table_name),//获得字段列表
            'all_rule'      => BuildRequestModel::getAllRule(),//全部表单验证规则
            'config'        => ConfigRequestModel::getConfig($table_name),//获得配置信息
        ]);
    }

    /**
     * 处理创建配置页面
     *
     * @param Request $request
     * @return \Illuminate\View\View
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postCreateConfig(Request $request)
    {
        $data = $request->all();
        $file_name = $data['table_name'];
        unset($data['table_name']);

        //写入文件
        $status = $this->writeRequesConfig($file_name, ConfigRequestModel::createRequestConfig($data));
        return $status == true ? $this->response(self::SUCCESS_STATE_CODE, '创建Request配置信息成功') : $this->response(self::ERROR_STATE_CODE, '创建Request配置信息失败');
    }

    /**
     * 写入 Reuqeust 配置文件
     *
     * @param $file_name
     * @param $file_data
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function writeRequesConfig($file_name, $file_data)
    {
        if (!empty($file_data)) {

            return file_put_contents(ConfigRequestModel::getConfigDir($file_name, ConfigRequestModel::FILE_TYPE), json_encode($file_data)) == false ? false : true;
        }
        return false;
    }
}
