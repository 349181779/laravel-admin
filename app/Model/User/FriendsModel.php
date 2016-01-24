<?php

// +----------------------------------------------------------------------
// | date: 2015-08-15
// +----------------------------------------------------------------------
// | FriendsModel.php: 会员好友模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\User;

use DB;

use Session;

class FriendsModel extends BaseModel {

    protected $table    = 'friends';//定义表名
    protected $guarded  = ['id'];//阻挡所有属性被批量赋值


    /**
     * 获得我的好友列表
     *
     * @return mixed
     */
    public static function getMyFriends(){
        return self::where('user_info_id', '=', is_user_login())->lists('friend_user_id');
    }

    /**
     * 添加好友
     *
     * @param $user_id
     * @param $contents
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function addFriend($user_id, $contents = ''){
        //加载函数库
        load_func('common');

        $affected_id = DB::table('add_user')->insertGetId([
            'user_info_id'  => is_user_login(),
            'invitee'       => $user_id,
            'created_at'    => date('Y-m-d H:i:s'),
        ]);

        //发送私信
        if($affected_id > 0 ) LetterModel::sendLetter($user_id, trans('log.add_user_log', ['user_name'  => Session::get('user_info.email'), 'contents'=> $contents ] ));
    }

    /**
     * 处理添加好友
     *
     * @param $id
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function confirmAddFriend($user_id, $letter_id){
        //确认添加好友
        $affected_number = DB::table('add_user')->where('invitee', '=', is_user_login())->where('user_info_id', '=', $user_id)->where('status', '=', 1)->where('deleted_at', '=', '0000-00-00 00:00:00')->update([
            'status'    => 2
        ]);

        //确认私信已读
        LetterModel::updateLetterStatus($letter_id);

        if($affected_number > 0 ){
            self::afterConfirmAddFriendAction($user_id);
            return true;
        }

        return false;
    }

    /**
     * 确认增加好友后操作
     *
     * @param $user_id
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function afterConfirmAddFriendAction($user_id){
        DB::table('friends')->insertGetId([
            'user_info_id'      => is_user_login(),
            'friend_user_id'    => $user_id,
            'created_at'        => date('Y-m-d H:i:s'),
            'friend_group_id'   => self::getFriendGroup()
        ]);

        DB::table('friends')->insertGetId([
            'user_info_id'      => $user_id,
            'friend_user_id'    => is_user_login(),
            'created_at'        => date('Y-m-d H:i:s'),
            'friend_group_id'   => self::getFriendGroup($user_id)
        ]);
    }

    /**
     * 获得用户组id
     *
     * @param $user_id
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function getFriendGroup($user_id = null){
        $user_id = $user_id == null ? is_user_login() : $user_id;

        $group_info = DB::table('friend_group')->where('user_info_id', '=', $user_id)->where('is_default', '=', '1')->where('deleted_at', '=', '0000-00-00 00:00:00')->first();

        if(empty($group_info)){
            $id = DB::table('friend_group')->insertGetId([
                'group_name'    => '我的好友',
                'created_at'    => date('Y-m-d H:i:s'),
                'user_info_id'  => $user_id,
                'is_default'    => 1,
            ]);
            return $id;
        }
        return $group_info->id;

    }

}
