<?php

// +----------------------------------------------------------------------
// | date: 2015-08-08
// +----------------------------------------------------------------------
// | Passwordequest.php: 会员保存资料表单验证
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;

class Passwordequest extends BaseFormRequest {

    /**
     * 验证错误规则
     *
     * @return array
     */
    public function rules(){
        return [
            'old_password'              => ['required'],
            'password'                  => ['required', 'confirmed'],
            'password_confirmation'     => ['required'],
        ];
    }

    /**
     * 验证错误提示
     *
     * @return array
     */
    public function messages(){
        return [
            'old_password.required'             => trans('validate.old_password_reuqre'),
            'password.required'                 => trans('validate.password_reuqre'),
            'password.confirmed'                => trans('validate.password_confirmed_error'),
            'password_confirmation.required'    => trans('validate.password_confirmed_require'),
        ];
    }

}
