<?php

// +----------------------------------------------------------------------
// | date: 2015-08-02
// +----------------------------------------------------------------------
// | ChatController.php: 会员聊天控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\User;

use App\Http\Controllers\User\BaseController;

use App\Http\Requests;

use App\Http\Controllers\Controller;

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

		//获得发送对象$fb
		$user_info = unserialize(get_redis()->hGet(config('config.user_list_hash_table'), $data['id']));

		//发送消息
		send_message_to_swoole_server('', [ 'user_id'=> Session::get('user_info.id'), 'fd'=>$user_info->fd, 'data'=>$data], '');

	}


}
