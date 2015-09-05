<?php

// +----------------------------------------------------------------------
// | date: 2015-08-02
// +----------------------------------------------------------------------
// | UserModel.php: 会员用户模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\User;

use DB;

use Session;

class UserModel extends BaseModel {

    protected $table    = 'user_info';//定义表名
    protected $guarded  = ['id','open_id', 'is_validate_email', 'is_validate_mobile'];//阻挡所有属性被批量赋值

    /**
     * 获得在线好友
     *
     * @param $params array 用户登录名和密码参数
     * @return int
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function onlineUser(){;
        load_func('instanceof,image,common');

        $online_user = get_redis()->hGetAll(config('config.user_list_hash_table'));

        $item = [];

        //获得全部我的好友
        $my_friends = FriendsModel::getMyFriends();

        foreach($online_user as $user){
            $user = unserialize($user);

            //如果是自己，则跳过 || 如果不是自己好友，则跳过
            if($user->id == is_user_login() || !in_array($user->id, $my_friends)) continue;

            $item[] = [
                'id'    => $user->id,
                'name'  => $user->user_name,
                'face'  => get_user_info_face($user->face),
                'url'   => action("User\UserController@getIndex", ['id' => $user->id]),
            ];
        }

        $data = [
            [
                'name'  => '在线好友',
                'nums'  => count($item),
                'id'    => 1,
                'item'  => $item,
            ]

        ];

        return $data;
    }



}
