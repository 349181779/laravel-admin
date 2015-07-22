<?php

// +----------------------------------------------------------------------
// | date: 2015-07-08
// +----------------------------------------------------------------------
// | AdminInfoRequest.php: 后端用户表单验证
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseFormRequest;

class AdminInfoRequest extends BaseFormRequest {

    /**
     * 验证错误规则
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function rules(){
        return [
            'email'     => ['required', 'email', 'unique:admin_info'],
            'password'  => ['required', 'size:6'],
            'mobile'    => ['required', 'digits:11'],
            'status'    => ['required', 'in:1,2'],
            'role_id'   => ['required', 'numeric'],
        ];
    }

    /**
     * 验证错误提示
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function messages(){
        return [
            'email.required'        => trans('validate.email_require'),
            'email.email'           => trans('validate.email_error'),
            'email.unique'          => trans('validate.email_unique'),
            'password.required'     => trans('validate.password_require'),
            'password.size'         => trans('validate.password_size_error'),
            'mobile.mobile_require' => trans('validate.mobile_require'),
            'mobile.digits'         => trans('validate.mobile_error'),
            'status.required'       => trans('validate.status_require'),
            'status.in'             => trans('validate.status_error'),
            'role_id.required'      => trans('validate.role_id_require'),
            'role_id.numeric'       => trans('validate.role_id_error'),
        ];
    }

}
