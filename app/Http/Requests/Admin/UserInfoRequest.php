<?php

// +----------------------------------------------------------------------
// | date: 2015-07-13
// +----------------------------------------------------------------------
// | UserInfoRequest.php: 后端用户表单验证
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseFormRequest;

class UserInfoRequest extends BaseFormRequest {

    /**
     * 验证错误规则
     *
     * @return array
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function rules(){
        return [
            'user_name' => ['required'],
            'email'     => ['required', 'email'],
            'password'  => ['required', 'size:6'],
            'mobile'    => ['required', 'digits:11'],
            'status'    => ['required', 'in:1,2'],
            'sort'      => ['required', 'digits_between:0,255'],
            'sex'       => ['required', 'in:1,2,3'],
            'birthday'  => ['required', 'date_format:Y-m-d'],
        ];
    }

    /**
     * 验证错误提示
     *
     * @return array
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function messages(){
        return [
            'email.required'        => trans('validate.email_require'),
            'email.email'           => trans('validate.email_error'),
            'password.required'     => trans('validate.password_require'),
            'password.size'         => trans('validate.password_size_error'),
            'mobile.mobile_require' => trans('validate.mobile_require'),
            'mobile.digits'         => trans('validate.mobile_error'),
            'status.required'       => trans('validate.status_require'),
            'status.in'             => trans('validate.status_error'),
            'sex.required'          => trans('validate.sex_require'),
            'sex.in'                => trans('validate.sex_error'),
            'birthday.required'     => trans('validate.birthday_require'),
            'birthday.date_format'  => trans('validate.birthday_error')
        ];
    }

}
