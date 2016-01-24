<?php

// +----------------------------------------------------------------------
// | date: 2015-07-14
// +----------------------------------------------------------------------
// | SearchRequest.php: 后端搜索工具导航表单验证
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseFormRequest;

class SearchRequest extends BaseFormRequest {

    /**
     * 验证错误规则
     *
     * @return array
     */
    public function rules(){
        if($this->get('id') > 0 ){
            return [
                'name'              => ['required'],
                'search_cat_id'     => ['required', 'numeric'],
                'search_url'        => ['required', 'url'],
                'status'            => ['required', 'in:1,2'],
                'sort'              => ['required', 'digits_between:0,255'],
            ];
        }else{
            return [
                'name'              => ['required', ],
                'search_cat_id'     => ['required', 'numeric'],
                'search_url'        => ['required', 'url'],
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
            'name.required'             => trans('validate.article_title_require'),
            'name.unique'               => trans('validate.name_unique'),
            'search_cat_id.required'    => trans('validate.cat_name_require'),
            'search_cat_id.numeric'     => trans('validate.cat_name_error'),
            'search_url.required'       => trans('validate.url_require'),
            'search_url.url_error'      => trans('validate.url_error'),
            'status.required'           => trans('validate.status_require'),
            'status.in'                 => trans('validate.status_error'),
            'sort.require'              => trans('validate.sort_require'),
            'sort.digits_between'       => trans('validate.sort_error')
        ];
    }

}
