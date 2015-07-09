<?php

// +----------------------------------------------------------------------
// | date: 2015-07-09
// +----------------------------------------------------------------------
// | MenuRequest.php: 后端菜单表单验证
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Requests\Admin;

class MenuRequest extends BaseFormRequest {

    /**
     * 验证错误规则
     *
     * @return array
     */
    public function rules(){
        return [
            'menu_name' => ['required'],
            'pid'       => ['required', 'numeric'],
            'status'    => ['required', 'in:1,2'],
            'url'       => ['required'],
            'sort'      => ['required', 'digits_between:0,255'],
        ];
    }

    /**
     * 验证错误提示
     *
     * @return array
     */
    public function messages(){
        return [
            'menu_name.required'    => trans('validate.menu_name_require'),
            'pid.required'          => trans('validate.pid_require'),
            'status.required'       => trans('validate.status_require'),
            'status.in'             => trans('validate.status_error'),
            'url.required'          => trans('validate.url_require'),
            'sort.require'          => trans('validate.sort_require'),
            'sort.digits_between'   => trans('validate.sort_error')
        ];
    }

}
