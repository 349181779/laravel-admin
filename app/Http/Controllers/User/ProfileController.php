<?php

// +----------------------------------------------------------------------
// | date: 2015-08-01
// +----------------------------------------------------------------------
// | ProfileController.php: 用户资料页面控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\User;

use App\Http\Requests;

use App\Model\User\LetterModel;

use App\Model\User\ProfileModel;

use App\Http\Requests\User\UserProfileRequest;

use App\Http\Requests\User\Passwordequest;

class ProfileController extends BaseController {

    /**
     * 构造方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct(){
        parent::__construct();
    }

	/**
     * 用户详细资料
     *
     * @return \Illuminate\View\View
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getProfile(){
        return view('user.user.profile', [
            'title'             => '会员-详细资料管理',
            'keywords'          => '会员-详细资料管理',
            'description'       => '会员-详细资料管理',
            'user_profile'      => ProfileModel::getUserProfile(),
            'add_friend_letter' => LetterModel::addFriendLetter(),
        ]);
    }

    /**
     * 保存用户详细资料
     *
     * @param UserProfileRequest $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postProfile(UserProfileRequest $request){
        ProfileModel::updateUserProfile($request->all()) == true ? $this->response(200, trans('response.update_profile_success')) : $this->response(400, trans('response.update_user_profile_error'));
    }

    /**
     * 更新用户密码
     *
     * @param Passwordequest $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postUpdatePassword(Passwordequest $request){
        $status = ProfileModel::updatePassword($request->only('old_password', 'password'));

        if($status === true){
            $this->response(200, trans('response.update_user_password_success'));
        }else{
            if($status == -1){
                $this->response(400, trans('response.old_password_error'));
            }else if($status === false){
                $this->response(400, trans('response.update_user_password_error'));
            }
        }
    }

}
