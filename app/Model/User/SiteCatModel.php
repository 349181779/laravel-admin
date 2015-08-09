<?php

// +----------------------------------------------------------------------
// | date: 2015-08-09
// +----------------------------------------------------------------------
// | SiteCatModel.php: 会员网址分类模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\User;

use App\Model\Admin\BaseModel;

class SiteCatModel extends BaseModel {

    protected $table    = 'user_site_cat';//定义表名
    protected $guarded  = ['id'];//阻挡所有属性被批量赋值


}
