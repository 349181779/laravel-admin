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

use App\Model\User\LetterModel;

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

    /**
     * 获得用户详细信息
     *
     * @return \Illuminate\Support\Collection|null|static
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getUserProfile($user_id = null){
        $user_id                    = !empty($user_id) ? $user_id : Session::get('user_info.id');
        $user_profile               = self::find($user_id);
        $user_profile->user_profile = self::getUserOtherProfile($user_id);
        return $user_profile;
    }

    /**
     * 获得用户其他详细数据
     *
     * @param $user_id
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function getUserOtherProfile($user_id){
        if($user_id > 0 ){
            return DB::table('user_profile')->where('user_info_id', '=', $user_id)->first();
        }
    }

    /**
     * 获得用户基本信息
     *
     * @param $user_id
     * @return \Illuminate\Support\Collection|null|static
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getUserSimpleInfo($user_id){
       return self::mergeUserInfo(self::find($user_id));
    }

    /**
     * 组合用户信息
     *
     * @param $user_info
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function mergeUserInfo($user_info){
        if(!empty($user_info)){
            load_func('image');
            $user_info->face        = get_user_info_face($user_info->face);
            $user_info->url         = action("User\UserController@getIndex", ['id' => $user_info->id]);
            $user_info->user_name   = !empty($user_info->user_name) ? $user_info->user_name : $user_info->email;
            return $user_info;
        }
    }

    /**
     * 保存用户信息
     *
     * @param $data
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function updateUserProfile($data){
        if(!empty($data)){
            $user_id = Session::get('user_info.id');

            //保存用户资料
            $affected_number = self::where('id', '=', $user_id)->update([
                'email'         => $data['email'],
                'mobile'        => $data['mobile'],
                'user_name'     => $data['user_name'],
                'sex'           => $data['sex'],
                'birthday'      => $data['year'] . '-' . $data['month'] . '-' . $data['day'],
            ]);

            //保存用户其他资料
            $status = self::updateUserOtherProfile($user_id, $data['user_profile']);

            //更新用户等级
            self::DegreeOfCompletion();

            return true;
        }
        return false;
    }

    /**
     * 更新用户其他详细数据
     *
     * @param $user_id
     * @param $data
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function updateUserOtherProfile($user_id, $data){
        if($user_id > 0 && !empty($data)){
            $affected_number = DB::table('user_profile')->where('user_info_id', '=', $user_id)->update([
                'truename'      => $data['truename'],
                'other_email'   => $data['other_email'],
                'qq'            => $data['qq'],
                'wechat'        => $data['wechat'],
                'weibo'         => $data['weibo'],
                'id_card'       => $data['id_card'],
                'marriage'      => $data['marriage'],
                'occupation'    => $data['occupation'],
                'province'      => $data['province'],
                'city'          => $data['city'],
                'area'          => $data['area'],
                'home_province' => $data['home_province'],
                'home_city'     => $data['home_city'],
                'home_area'     => $data['home_area'],
            ]);
            return true;
        }
    }

    /**
     * 更改密码
     *
     * @param $data
     * @return bool|int
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function updatePassword($data){
        $user_id    = Session::get('user_info.id');
        $user_info  = self::find($user_id);
        //验证密码是否正确
        if(password_verify(trim($data['old_password']), $user_info->password) == false){
            return -1;
        }
        $affected_number = self::where('id', '=', $user_id)->update([
            'password'  => bcrypt(trim($data['password'])),
        ]);
        return $affected_number > 0 ? true : false;
    }



    /**
     * 查找添加好友
     *
     * @param $account_number
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function SearchFriend($account_number){
        return self::mergeUserInfo(DB::table('user_info')->where('account_number', '=', $account_number)->where('status', '=', 1)->where('deleted_at', '=', '0000-00-00 00:00:00')->select('id', 'user_name', 'email', 'account_number', 'face')->first());
    }



}
