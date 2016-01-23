<?php

// +----------------------------------------------------------------------
// | date: 2016-01-23
// +----------------------------------------------------------------------
// | HomeModel.php: 首页模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace Yangyifan\AutoBuild\Model;

use \DB;

class HomeModel extends BaseModel
{
    /**
     * 获得全部表
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAllTable()
    {
         return self::mergeTable(DB::select("show tables"));
    }

    /**
     * 组合表数据
     *
     * @param $all_table
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function mergeTable($all_table)
    {
        $data = [];

        if (!empty($all_table)) {
            foreach ($all_table as $v) {
                $data[] = ['table_name' => $v->Tables_in_laravel];
            }
        }
        return $data;
    }

    /**
     * 获得字段列表
     *
     * @param $table_name
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getSchemaList($table_name)
    {
        return self::mergeSchema(
            DB::select("select * from information_schema.COLUMNS where table_name = '{$table_name}' and table_schema = '".env('DB_DATABASE')."'")
        );
    }

    /**
     * 组合字段列表
     *
     * @param $all_schema
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function mergeSchema($all_schema)
    {
        $data = [];

        if (!empty($all_schema)) {
            foreach ($all_schema as $v) {
                $data[] = [
                    'col_name'  => $v->COLUMN_NAME,
                    'position'  => $v->ORDINAL_POSITION,
                    'default'   => $v->COLUMN_DEFAULT,
                    'is_null'   => $v->IS_NULLABLE,
                    'type'      => $v->DATA_TYPE,
                    'real_type' => $v->COLUMN_TYPE,
                    'key'       => $v->COLUMN_KEY,
                    'extra'     => $v->EXTRA,
                    'comment'   => $v->COLUMN_COMMENT,
                ];
            }
        }
        return $data;
    }
}

