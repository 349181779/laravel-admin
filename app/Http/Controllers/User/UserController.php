<?php

// +----------------------------------------------------------------------
// | date: 2015-08-01
// +----------------------------------------------------------------------
// | UserController.php: 好友管理页面控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\User;

use App\Http\Controllers\User\BaseController;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Model\User\UserModel;

use App\Http\Requests\User\UserProfileRequest;

use App\Http\Requests\User\Passwordequest;

class UserController extends BaseController {

	/**
	 * 好友管理
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(){
        return view('user.user.index', [
            'title'         => '会员-好友管理',
            'keywords'      => '会员-好友管理',
            'description'   => '会员-好友管理',
        ]);
	}


    /**
     * 保用用户信息到redis
     *
     * @param Requests $requests
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getSaveUserInfo(Request $requests){
        $user_info = unserialize(urldecode($requests->get('user_info')));
        //保存用户信息到redis hash表
        load_func('instanceof,swoole');
        //返回状态
        get_redis()->hSet(config('config.user_list_hash_table'), $user_info->id, serialize($user_info)) != false ? $this->response(200, 'success') : $this->response(400, trans('response.save_user_info_to_redis_error'));
    }

    /**
     * 获得好友数据
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postFriend(){
        return $this->response($code = 200, $msg = '', $data = UserModel::onlineUser());
    }

    /**
     * 获得我的群组
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postGroup(){
        //获得我的群组
        $data = [
            [
                'name'=> '我的分组',
                'nums'=> 4,
                'id'=> 1,
                'item'=> [
                    ['id'=> "100001", 'name'=> '分组1', 'face'=> 'http://tp1.sinaimg.cn/1571889140/180/40030060651/1'],
                    ['id'=> "100002", 'name'=> '分组2', 'face'=> 'http://tp1.sinaimg.cn/1571889140/180/40030060651/1'],
                    ['id'=> "100003", 'name'=> '分组3', 'face'=> 'http://tp1.sinaimg.cn/1571889140/180/40030060651/1'],
                    ['id'=> "100004", 'name'=> '分组4', 'face'=> 'http://tp1.sinaimg.cn/1571889140/180/40030060651/1'],
                ],
            ]

        ];
        //响应
        return $this->response($code = 200, $msg = '', $data = $data, $target = true, $href = '');
    }

    /**
     * 获得群组成员
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postGroups(){
        //获得群组成员
        $data = [
            ['id'=> "100001", 'name'=> 'yangyifan1', 'face'=> 'http://tp1.sinaimg.cn/1571889140/180/40030060651/1'],
            ['id'=> "100002", 'name'=> 'yangyifan2', 'face'=> 'http://tp1.sinaimg.cn/1571889140/180/40030060651/1'],
            ['id'=> "100003", 'name'=> 'yangyifan3', 'face'=> 'http://tp1.sinaimg.cn/1571889140/180/40030060651/1'],
            ['id'=> "100004", 'name'=> 'yangyifan4', 'face'=> 'http://tp1.sinaimg.cn/1571889140/180/40030060651/1'],

        ];
        //响应
        return $this->response($code = 200, $msg = '', $data = $data, $target = true, $href = '');
    }

    public function postChatlog(){
        //获得群组成员
        $data = [
            ['id'=> "100001", 'name'=> 'yangyifan1', 'time'=> '10:22', 'face'=> 'http://tp1.sinaimg.cn/1571889140/180/40030060651/1'],
            ['id'=> "100002", 'name'=> 'yangyifan2', 'time'=> '10:22', 'face'=> 'http://tp1.sinaimg.cn/1571889140/180/40030060651/1'],
            ['id'=> "100003", 'name'=> 'yangyifan3', 'time'=> '10:22', 'face'=> 'http://tp1.sinaimg.cn/1571889140/180/40030060651/1'],
            ['id'=> "100004", 'name'=> 'yangyifan4', 'time'=> '10:22', 'face'=> 'http://tp1.sinaimg.cn/1571889140/180/40030060651/1'],

        ];
        //响应
        return $this->response($code = 200, $msg = '', $data = $data, $target = true, $href = '');
    }


    /**
     * 用户详细资料
     *
     * @return \Illuminate\View\View
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getProfile(){
        return view('user.user.profile', [
            'title'         => '会员-详细资料管理',
            'keywords'      => '会员-详细资料管理',
            'description'   => '会员-详细资料管理',
            'user_profile'  => UserModel::getUserProfile(),
        ]);
    }

    /**
     * 保存用户详细资料
     *
     * @param UserProfileRequest $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postProfile(UserProfileRequest $request){
        UserModel::updateUserProfile($request->all()) == true ? $this->response(200, 'success') : $this->response(400, trans('response.update_user_profile_error'));
    }

    /**
     * 更新用户密码
     *
     * @param Passwordequest $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postUpdatePassword(Passwordequest $request){
        $status = UserModel::updatePassword($request->only('old_password', 'password'));

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
