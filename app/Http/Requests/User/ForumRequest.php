<?php

// +----------------------------------------------------------------------
// | date: 2015-08-09
// +----------------------------------------------------------------------
// | ForumRequest.php: 会员论坛帖子表单验证
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;

class ForumRequest extends BaseFormRequest {

    /**
     * 验证错误规则
     *
     * @return array
     */
    public function rules(){
        return [
            'title'                     => ['required'],
            'forum_cat_id'              => ['required', 'numeric'],
            'contents'                  => ['required']
        ];
    }

    /**
     * 验证错误提示
     *
     * @return array
     */
    public function messages(){
        return [
            'title.required'                    => trans('validate.forum_title_reuquire'),
            'forum_cat_id.required'             => trans('validate.cat_name_require'),
            'forum_cat_id.numeric'              => trans('validate.cat_name_error'),
            'contents.email'                    => trans('validate.forum_contents_reuqire'),

        ];
    }

}
