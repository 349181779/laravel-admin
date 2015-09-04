<?php

// +----------------------------------------------------------------------
// | date: 2015-09-04
// +----------------------------------------------------------------------
// | UserModel.php: 会员头像模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\User;

use DB;

use Session;

use App\Model\User\LetterModel;

class AvatarModel extends BaseModel {

    protected $table    = 'user_info';//定义表名
    protected $guarded  = ['id','open_id', 'is_validate_email', 'is_validate_mobile'];//阻挡所有属性被批量赋值

    /**
     * 获得用户真实头像地址
     *
     * @param $image_src
     * @param null $user_id
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getUserRealAvatar($image_src, $user_id = null){
        $path = config('config.user_info_face_prefix');

        //加载函数库
        load_func('common');

        $user_id = $user_id != null ? $user_id : is_user_login();

        if(!empty($image_src)){
            return sprintf("%s%s/%d/%s", $path, 'avatar', $user_id, $image_src);
        }
        return $path . 'avatar/default_user_avatar.jpg';
    }

    /**
     * 保存用户头像
     *
     * @param $image
     * @param null $user_id
     * @return bool
     */
    public static function saveUserAvatar($image, $user_id = null ){
        if(!empty($image)){
            //加载函数库
            load_func('common');

            $user_id = $user_id != null ? $user_id : is_user_login();

            return self::where('id', '=', $user_id)->update(['face' => $image]);
        }
        return false;
    }

}
