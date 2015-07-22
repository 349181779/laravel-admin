<?php

// +----------------------------------------------------------------------
// | date: 2015-06-22
// +----------------------------------------------------------------------
// | LoginFormRequest.php: 后端登录表单验证
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseFormRequest;

class LoginFormRequest extends BaseFormRequest  {

	/**
	 * 验证错误规则
	 *
	 * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function rules(){
		return [
            'email'     => ['required', 'email'],
            'password'  => ['required', 'size:6'],
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
            'email.required'    => trans('validate.email_require'),
            'email.email'       => trans('validate.email_error'),
            'password.required' => trans('validate.password_require'),
            'password.size'     => trans('validate.password_size_error')
        ];
    }



}
