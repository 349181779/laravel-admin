<?php

// +----------------------------------------------------------------------
// | date: 2016-01-23
// +----------------------------------------------------------------------
// | ConfigRequestModel.php: 创建 Request 配置文件模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace Yangyifan\AutoBuild\Model\Config;

class ConfigRequestModel extends BaseModel
{
    const FILE_TYPE = 'request';//对应 $type_arr 的类型

    /**
     * 创建 Request 配置信息
     *
     * @param $data
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function createRequestConfig($data)
    {
        $rule_config = [];

        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $rule_config[$key] = [
                    'name' => $value['title'],
                ];
                if (!empty($value['rule']['rule'])) {
                    foreach ($value['rule']['rule'] as $rule) {
                        if (isset($value['rule']['params'][$rule]) && is_array($value['rule']['params'][$rule])) {
                            $rule_config[$key]['rule'][] = array_merge([$rule], $value['rule']['params'][$rule]);
                        } else {
                            $rule_config[$key]['rule'][] = $rule;
                        }

                    }
                }
            }
        }
        return $rule_config;
    }

    /**
     * 获得配置json信息
     *
     * @param $table_name
     * @param $type
     * @return bool|mixed
     */
    public static function getConfig($table_name)
    {
        $json = self::getFileContent($table_name, self::FILE_TYPE);
        if (!empty($json)) {
            return json_decode($json, true);
        }
        return false;
    }
}

