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
<<<<<<< HEAD
            'admin_name'    => ['required'],
            'password'      => ['required', 'regex:[\S{5,}]'],
=======
            'email'     => ['required', 'email'],
            'password'  => ['required', 'size:6'],
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
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
<<<<<<< HEAD
            'admin_name.required'   => trans('validate.admin_name_require'),
            'password.required'     => trans('validate.password_require'),
            'password.size'         => trans('validate.password_size_error')
=======
            'email.required'    => trans('validate.email_require'),
            'email.email'       => trans('validate.email_error'),
            'password.required' => trans('validate.password_require'),
            'password.size'     => trans('validate.password_size_error')
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
        ];
    }



}
