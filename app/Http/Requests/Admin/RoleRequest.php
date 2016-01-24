<?php

// +----------------------------------------------------------------------
// | date: 2015-06-22
// +----------------------------------------------------------------------
// | RoleRequest.php: 后端角色表单验证
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseFormRequest;

class RoleRequest extends BaseFormRequest {

    /**
     * 验证错误规则
     *
     * @return array
     */
    public function rules(){
        if($this->get('id') > 0 ){
            return [
                'role_name'     => ['required'],
                'status'        => ['required', 'in:1,2'],
            ];
        }else{
            return [
                'role_name'     => ['required', 'unique:role'],
                'status'        => ['required', 'in:1,2'],
            ];
        }

    }

    /**
     * 验证错误提示
     *
     * @return array
     */
    public function messages(){
        return [
            'role_name.required'    => trans('validate.role_name_require'),
            'role_name.unique'      => trans('validate.role_name_unique'),
            'status.required'       => trans('validate.status_require'),
            'status.in'             => trans('validate.status_error'),
        ];
    }

}
