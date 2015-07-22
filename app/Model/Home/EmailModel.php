<?php

// +----------------------------------------------------------------------
// | date: 2015-07-22
// +----------------------------------------------------------------------
// | EmailModel.php: 前台邮箱模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Home;

use App\Model\Home\BaseModel;

use DB;

class EmailModel extends BaseModel {

    protected $table    = 'email';//定义表名
    protected $guarded  = ['*'];//阻挡所有属性被批量赋值

    /**
     * 获得首页网址分类和分类下面的网址
     *
     * @return mixed
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public static function getAllEmail(){
       return self::where('status', '=', '1')->orderBy('sort', 'desc')->take(11)->get();
    }

}
