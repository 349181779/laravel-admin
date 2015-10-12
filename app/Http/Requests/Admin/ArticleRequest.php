<?php

// +----------------------------------------------------------------------
// | date: 2015-07-10
// +----------------------------------------------------------------------
// | ArticleRequest.php: 后端文章表单验证
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseFormRequest;

class ArticleRequest extends BaseFormRequest {

    /**
     * 验证错误规则
     *
     * @return array
     */
    public function rules(){
        if($this->get('id') > 0 ){
            return [
                'title'             => ['required'],
                'article_cat_id'    => ['required', 'numeric'],
                'state'             => ['required', 'in:1,2'],
                'sort'              => ['required', 'between:0,255'],
            ];
        }else{
            return [
                'title'             => ['required', 'unique:article'],
                'article_cat_id'    => ['required', 'numeric'],
                'state'             => ['required', 'in:1,2'],
                'sort'              => ['required', 'between:0,255'],
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
            'title.required'            => trans('validate.article_title_require'),
            'title.unique'              => trans('validate.article_title_unique'),
            'article_cat_id.required'   => trans('validate.cat_name_require'),
            'article_cat_id.numeric'    => trans('validate.cat_name_error'),
            'state.required'            => trans('validate.status_require'),
            'state.in'                  => trans('validate.status_error'),
            'sort.require'              => trans('validate.sort_require'),
            'sort.between'       => trans('validate.sort_error')
        ];
    }

}
