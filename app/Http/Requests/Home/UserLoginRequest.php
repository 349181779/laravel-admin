<?php

// +----------------------------------------------------------------------
// | date: 2015-07-12
// +----------------------------------------------------------------------
// | UserLoginRequest.php: 前端会员登录表单验证
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Requests\Home;

use App\Http\Requests\BaseFormRequest;

class UserLoginRequest extends BaseFormRequest {

    /**
     * 验证错误规则
     *
     * @return array
     */
    public function rules(){
        return [
            'email'     => ['required', 'email'],
            'password'  => ['required'],
        ];
    }

    /**
     * 验证错误提示
     *
     * @return array
     */
    public function messages(){
        return [
            'email.required'        => trans('validate.email_require'),
            'email.email'           => trans('validate.email_error'),
            'password.required'     => trans('validate.password_reuqre'),
        ];
    }

}
