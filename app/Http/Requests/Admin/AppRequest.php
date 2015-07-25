<?php

// +----------------------------------------------------------------------
// | date: 2015-07-11
// +----------------------------------------------------------------------
// | AppRequest.php: 后端网址表单验证
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseFormRequest;

class AppRequest extends BaseFormRequest {

    /**
     * 验证错误规则
     *
     * @return array
     */
    public function rules(){
        $id = $this->get('id');
        if($id > 0 ){
            return [
                'name'              => ['required'],
                'app_cat_id'        => ['required', 'numeric'],
                'site_url'          => ['required', 'url'],
                'status'            => ['required', 'in:1,2'],
                'sort'              => ['required', 'digits_between:0,255'],
            ];
        }else{
            return [
                'name'              => ['required', 'unique:app'],
                'app_cat_id'        => ['required', 'numeric'],
                'site_url'          => ['required', 'url', 'unique:site'],
                'status'            => ['required', 'in:1,2'],
                'sort'              => ['required', 'digits_between:0,255'],
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
            'name.required'                 => trans('validate.site_name_require'),
            'name.unique'                   => trans('validate.name_unique'),
            'app_cat_id.required'           => trans('validate.cat_name_require'),
            'app_cat_id.numeric'            => trans('validate.cat_name_error'),
            'site_url.required'             => trans('validate.url_require'),
            'site_url.url_error'            => trans('validate.url_error'),
            'site_url.unique'               => trans('validate.url_unique'),
            'status.required'               => trans('validate.status_require'),
            'status.in'                     => trans('validate.status_error'),
            'sort.require'                  => trans('validate.sort_require'),
            'sort.digits_between'           => trans('validate.sort_error')
        ];
    }

}
