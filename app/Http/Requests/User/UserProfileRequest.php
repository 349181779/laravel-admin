<?php

// +----------------------------------------------------------------------
// | date: 2015-08-08
// +----------------------------------------------------------------------
// | UserProfileRequest.php: 会员保存资料表单验证
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;

class UserProfileRequest extends BaseFormRequest {

    /**
     * 验证错误规则
     *
     * @return array
     */
    public function rules(){
        return [
            'email'                     => ['required', 'email'],
            'user_name'                 => ['required', ],
            'mobile'                    => ['digits:11'],
            'captcha'                   => ['required', 'captcha'],
            'sex'                       => ['required', 'in:1,2,3'],
            'year'                      => ['required', 'date_format:Y'],
            'month'                     => ['required', 'date_format:m'],
            'day'                       => ['required', 'date_format:d'],
            'user_profile.other_email'  => ['required', 'email'],
            'user_profile.truename'     => ['required'],
            'user_profile.qq'           => ['required'],
            'user_profile.wechat'       => ['required'],
            'user_profile.weibo'        => ['required'],
            'user_profile.id_card'      => ['required'],
            'user_profile.occupation'   => ['required'],
        ];
    }

    /**
     * 验证错误提示
     *
     * @return array
     */
    public function messages(){
        return [
            'email.required'                    => trans('validate.email_require'),
            'email.email'                       => trans('validate.email_error'),
            'email.unique'                      => trans('validate.email_unique'),
            'user_name.required'                => trans('validate.user_name_require'),
            'mobile.required'             => trans('validate.mobile_require'),
            'mobile.digits'                     => trans('validate.mobile_error'),
            'mobile.unique'                     => trans('validate.mobile_unique'),
            'captcha.required'                  => trans('validate.verify_reuqire'),
            'captcha.captcha'                   => trans('validate.captcha_error'),
            'sex.required'                      => trans('validate.sex_require'),
            'sex.in'                            => trans('validate.sex_error'),
            'year.required'                     => trans('validate.year_require'),
            'year.date_format'                  => trans('validate.year_error'),
            'month.required'                    => trans('validate.month_require'),
            'month.date_format'                 => trans('validate.month_error'),
            'day.required'                      => trans('validate.day_require'),
            'day.date_format'                   => trans('validate.day_error'),
            'user_profile.other_email.reuqire'  => trans('validate.email_require'),
            'user_profile.other_email.email'    => trans('validate.email_error'),
            'user_profile.truename.required'    => trans('validate.user_profile_truename_require'),
            'user_profile.qq.required'          => trans('validate.user_profile_qq_require'),
            'user_profile.wechat.required'      => trans('validate.user_profile_wechat_require'),
            'user_profile.weibo.required'       => trans('validate.user_profile_weibo_require'),
            'user_profile.id_card.required'     => trans('validate.user_profile_id_card_require'),
            'user_profile.occupation.required'  => trans('validate.user_profile_occupation_require'),
        ];
    }

}
