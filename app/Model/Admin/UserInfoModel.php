<?php

// +----------------------------------------------------------------------
// | date: 2015-06-28
// +----------------------------------------------------------------------
// | UserInfoModel.php: 后端会员模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\Admin;

use App\Model\Admin\BaseModel;

class UserInfoModel extends BaseModel {

    protected $table    = 'user_info';//定义表名
    protected $guarded  = ['id','open_id', 'is_validate_email', 'is_validate_mobile'];//阻挡所有属性被批量赋值

    /**
     * 组合会员数据
     *
     * @param $roles
     * @return mixed
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public static function mergeData($data){
        if(!empty($data)){
            foreach($data as $v){
                //组合性别
                $v->sex     = self::mergeUserSex($v->sex);
                //组合状态
                $v->status  = self::mergeStatus($v->status);
                //组合图片
                $v->face    = '<img src="'.config('config.file_url').$v->face.'" width="100" height="100" />';
                //组合方法
                $v->handle  = '<a href="'.url('admin/userinfo/edit', [$v->id]).'" target="_blank" >编辑</a>';

            }
        }
        return $data;
    }

}
