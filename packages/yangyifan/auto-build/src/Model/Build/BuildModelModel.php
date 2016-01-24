<?php

// +----------------------------------------------------------------------
// | date: 2016-01-17
// +----------------------------------------------------------------------
// | BuildModelModel.php: 组合构建 model 模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace Yangyifan\AutoBuild\Model\Build;

class BuildModelModel extends BaseModel
{
    /**
     * 设置 merge 方法主体
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function buildMergeBody()
    {
        $body = "";
        $body .= "\t if (!empty(\$data)) { \r\n";
        $body .= "\t\t foreach (\$data as &\$v) { \r\n";
        $body .= "\t\t\t \$v->handle = '<a href=\"\"  >修改</a>';\r\n";
        $body .= "\t\t } \r\n";
        $body .= "\t } \r\n";
        $body .= "return \$data;";

        return $body;
    }

    /**
     * 设置搜索方法主体
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function buildSearchBody()
    {
        $body = "";
        $body .= "return [ \r\n";
        $body .= "\t 'data' =>   self::mergeData( \r\n";
        $body .= "\t\t self::multiwhere(\$map)-> \r\n";
        $body .= "\t\t orderBy(\$sort, \$order)-> \r\n";
        $body .= "\t\t skip(\$offset)-> \r\n";
        $body .= "\t\t take(\$limit)-> \r\n";
        $body .= "\t\t get() \r\n";
        $body .= "\t ), \r\n";
        $body .= "'count' =>  self::multiwhere(\$map)->count(), \r\n";
        $body .= "];";
        return $body;
    }
}

