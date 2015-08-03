<?php

// +----------------------------------------------------------------------
// | date: 2015-08-02
// +----------------------------------------------------------------------
// | SendChatRequest.php: 会员发送消息表单验证
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;

class SendChatRequest extends BaseFormRequest {

    /**
     * 验证错误规则
     *
     * @return array
     */
    public function rules(){
        return [
            'content'   => ['required'],
            'id'        => ['required'],
        ];
    }

    /**
     * 验证错误提示
     *
     * @return array
     */
    public function messages(){
        return [
            'content.required'  => trans('validate.send_message_reuqire'),
            'id'                => trans('validate.user_name_require'),
        ];
    }

}
