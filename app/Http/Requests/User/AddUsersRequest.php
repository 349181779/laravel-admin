<?php

// +----------------------------------------------------------------------
// | date: 2015-08-15
// +----------------------------------------------------------------------
// | AddUsersRequest.php: 会员论坛帖子回复表单验证
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;

class AddUsersRequest extends BaseFormRequest {

    /**
     * 验证错误规则
     *
     * @return array
     */
    public function rules(){
        return [
            'id'      => ['required', 'numeric'],
        ];
    }

    /**
     * 验证错误提示
     *
     * @return array
     */
    public function messages(){
        return [
            'id.required' => trans('validate.account_number_require'),
            'id.numeric'  => trans('validate.account_number_error'),
        ];
    }

}
