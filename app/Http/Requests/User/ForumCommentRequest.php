<?php

// +----------------------------------------------------------------------
// | date: 2015-08-15
// +----------------------------------------------------------------------
// | ForumCommentRequest.php: 会员论坛帖子回复表单验证
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;

class ForumCommentRequest extends BaseFormRequest {

    /**
     * 验证错误规则
     *
     * @return array
     */
    public function rules(){
        return [
            'contents'      => ['required'],
            'forum_id'      => ['required', 'numeric'],
        ];
    }

    /**
     * 验证错误提示
     *
     * @return array
     */
    public function messages(){
        return [
            'contents.required' => trans('validate.comment_contents_reuqire'),
            'forum_id.required' => trans('validate.forum_require'),
            'forum_id.numeric'  => trans('validate.forum_error'),
        ];
    }

}
