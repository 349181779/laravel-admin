<?php

// +----------------------------------------------------------------------
// | date: 2015-07-12
// +----------------------------------------------------------------------
// | UserRegisterRequest.php: 前端会员注册表单验证
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Requests\Home;

use App\Http\Requests\BaseFormRequest;

class UserRegisterRequest extends BaseFormRequest {

    /**
     * 验证错误规则
     *
     * @return array
     */
    public function rules(){
        return [
            'email'                     => ['required', 'email', 'unique:user_info'],
            //'mobile'                    => ['required', 'digits:11', 'unique:user_info'],
            'captcha'                   => ['required', 'captcha'],
            'password'                  => ['required', 'confirmed'],
            'password_confirmation'     => ['required'],
            'agreement'                 => ['accepted'],
        ];
    }

    /**
     * 验证错误提示
     *
     * @return array
     */
    public function messages(){
        return [
            'email.required'                    => trans('validate.email_require'),
            'email.email'                       => trans('validate.email_error'),
            'email.unique'                      => trans('validate.email_unique'),
            'mobile.mobile_require'             => trans('validate.mobile_require'),
            'mobile.digits'                     => trans('validate.mobile_error'),
            'mobile.unique'                     => trans('validate.mobile_unique'),
            'captcha.required'                  => trans('validate.verify_reuqire'),
            'captcha.captcha'                   => trans('validate.captcha_error'),
            'password.required'                 => trans('validate.password_reuqre'),
            'password.confirmed'                => trans('validate.password_confirmed_error'),
            'password_confirmation.required'    => trans('validate.password_confirmed_require'),
        ];
    }

}
