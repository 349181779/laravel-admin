<?php

// +----------------------------------------------------------------------
// | date: 2015-07-12
// +----------------------------------------------------------------------
// | QueryRequest.php: 后端网址表单验证
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseFormRequest;

class QueryRequest extends BaseFormRequest {

    /**
     * 验证错误规则
     *
     * @return array
     */
    public function rules(){
        return [
            'name'              => ['required', 'unique:query'],
            'query_cat_id'      => ['required', 'numeric'],
            'site_url'          => ['required', 'unique:query'],
            'status'            => ['required', 'in:1,2'],
            'sort'              => ['required', 'digits_between:0,255'],
        ];
    }

    /**
     * 验证错误提示
     *
     * @return array
     */
    public function messages(){
        return [
            'name.required'                 => trans('validate.name_reuqire'),
            'name.unique'                   => trans('validate.site_name_unique'),
            'query_cat_id.required'         => trans('validate.cat_name_require'),
            'query_cat_id.numeric'          => trans('validate.cat_name_error'),
            'site_url.unique'               => trans('validate.url_unique'),
            'status.required'               => trans('validate.status_require'),
            'status.in'                     => trans('validate.status_error'),
            'sort.require'                  => trans('validate.sort_require'),
            'sort.digits_between'           => trans('validate.sort_error')
        ];
    }

}
