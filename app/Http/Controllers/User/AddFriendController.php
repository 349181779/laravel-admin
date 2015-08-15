<?php

// +----------------------------------------------------------------------
// | date: 2015-08-15
// +----------------------------------------------------------------------
// | AddFriendController.php: 添加好友控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\User;

use App\Http\Controllers\User\BaseController;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Model\User\UserModel;

use App\Model\User\FriendsModel;

use App\Http\Requests\User\AddUsersRequest;

class AddFriendController extends BaseController {

    /**
     * 构造方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct(){
        parent::__construct();
    }

	/**
     * 添加好友页面
     *
     * @return \Illuminate\View\View
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getAddFriend(){
        return view('user.user.add_users', [
            'title'         => '会员-添加好友',
            'keywords'      => '会员-添加好友',
            'description'   => '会员-添加好友',
        ]);
    }

    /**
     * 处理查找会员
     *
     * @param AddUsersRequest $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postSearchFriend(AddUsersRequest $request){
        //添加好友
        $user_list = UserModel::SearchFriend(intval($request->get('id')));
        return !empty($user_list) ? $this->response($code = 200, $msg = '', $data = $user_list) : $this->response(400, trans('response.search_empty'));
    }

    /**
     * 处理添加好友
     *
     * @param AddUsersRequest $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postAddFriend(AddUsersRequest $request){
        $user_id = intval($request->get('id'));

        //搜索内容不能是自己
        if($user_id == is_user_login()) $this->response(400, trans('response.can_not_add_their_own_friends'));

        FriendsModel::addFriend($user_id, trim($request->get('contents')) );
        $this->response(200, trans('response.send_add_user_message_success'));
    }

    /**
     * 确认添加好友请求
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postConfirmAddFriend(Request $request){
        $status = FriendsModel::confirmAddFriend(intval($request->get('user_id')), intval($request->get('letter_id')) );
        $status == true ? $this->response(200,  trans('response.confirm_add_friend_success')) : $this->response(400,  trans('response.page_error'));
    }

}
