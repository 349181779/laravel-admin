<?php

// +----------------------------------------------------------------------
// | date: 2015-07-10
// +----------------------------------------------------------------------
// | ConfigModel.php: 后端配置信息模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Admin;

class ConfigModel extends BaseModel {

    protected $table    = 'config';//定义表名
    protected $guarded  = ['id'];//阻挡所有属性被批量赋值

    /**
     * 获得全部配置信息
     *
     * @return array
     */
    public static function getAll(){
        $data   = self::all();
        $config = new \stdClass();

        if(!empty($data)){
            foreach($data as $v){
                $config->{$v->name} = $v->value;
            }
        }

        return $config;
    }


}
