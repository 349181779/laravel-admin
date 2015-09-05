<?php

// +----------------------------------------------------------------------
// | date: 2015-08-02
// +----------------------------------------------------------------------
// | ChatController.php: 会员聊天控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\User;

use App\Http\Requests;

use Illuminate\Http\Request;

use App\Http\Requests\User\SendChatRequest;

use Session;

class ChatController extends BaseController {

	/**
	 * 发送信息
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function postSendMessage(SendChatRequest $request){
		//接受消息
		$data = $request->all();

		//加载函数库
		load_func('swoole,instanceof');

		$redis = get_redis();

		//获得发送对象$fb
		$user_info = unserialize($redis->hGet(config('config.user_list_hash_table'), $data['id']));

		//如果当前用户不在登录状态，则保存信息到未读信息
//		if(){
//
//		}

		//发送消息
		send_message_to_swoole_server('', [ 'user_id'=> Session::get('user_info.id'), 'fd'=>$user_info->fd, 'data'=>$data], '');

	}

	/**
	 * 保存当前用户 web socket 的 fd
	 *
	 * @param Request $request
	 * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function postSaveUserWebSocketFd(Request $request){
		//接受消息
		$data = $request->all();

		//加载函数库
		load_func('instanceof');
		$redis = get_redis();

		//获得发送对象$fb
		$user_info = unserialize($redis->hGet(config('config.user_list_hash_table'), Session::get('user_info.id')));

		$user_info->web_socket_fd = $data['fd'];

		//保存当前资料
		$redis->hSet(config('config.user_list_hash_table'), Session::get('user_info.id'), serialize($user_info)) !== false ? $this->response(200 ,'success')  : $this->response(400, trans('response.save_user_socket_to_redis_error'));

	}

	/**
	 * 获得用户web socket fd
	 *
	 * @param Request $request
	 */
	public function postSocketFd(Request $request){
		$user_id = $request->get('id');

		//加载函数库
		load_func('instanceof,image');

		//获得发送对象$fb
		$user_info = unserialize( get_redis()->hGet(config('config.user_list_hash_table'), $user_id));

		if(!empty($user_info)){
			$this->response(200 ,'success', ['fd'=>$user_info->web_socket_fd, 'name' => $user_info->user_name, 'face'=>get_user_info_face($user_info->face)]);
		}else{
			$this->response(400, trans('response.save_user_socket_to_redis_error'));
		}
	}

}
