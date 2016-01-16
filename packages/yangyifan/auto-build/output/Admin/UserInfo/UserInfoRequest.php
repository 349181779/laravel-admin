<?php
namespace Admin\UserInfo;

use aa\a;

/**
 */
class UserInfoRequest {

	/**
	 * 验证错误提示
	 */
	public function messages() {
		return [ 
			'admin_name.required' => '用户名不能为空', 
			'admin_name.url' => 'url格式不正确', 
			'admin_name.after' => '当前时间不能小于2015-02-01', 
			'admin_name.alpha_num' => '必须是字母、数字', 
			'admin_name.exists' => 'user_info不能重复', 
			'password.required' => '密码不能为空', 
			'mobile.required' => '手机号码不能为空', 
			'state.required' => '状态不能为空', 
			'limit_id.required' => '角色id不能为空', 
		];
	}

	/**
	 * 验证错误规则
	 */
	public function rules() {
		if(('id') > 0){ 
			 return [ 
				 'admin_name'=> [ 'required', 'url', 'after:2015-02-01', 'alpha_num', 'exists:user_info,admin_name', ], 
				 'password'=> [ 'required', ], 
				 'mobile'=> [ 'required', ], 
				 'state'=> [ 'required', ], 
				 'limit_id'=> [ 'required', ], 
			]; 
		}else{ 
			return [ 
				 'admin_name'=> [ 'required', 'url', 'after:2015-02-01', 'alpha_num', 'exists:user_info,admin_name', ], 
				 'password'=> [ 'required', ], 
				 'mobile'=> [ 'required', ], 
				 'state'=> [ 'required', ], 
				 'limit_id'=> [ 'required', ], 
			]; 
		}
	}
}
