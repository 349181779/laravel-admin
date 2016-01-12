<?php
use aa\a\a;
use bb\b\b;

/**
 */
class aaa {

	/**
	 * 验证错误提示
	 */
	public function messages() {
		return [ 
		    'admin_name.required'=> '角色名称不能为空', 
		    'admin_name.aa'=> '', 
		    'password.required'=> '角色名称不能为空', 
		    'mobile.required'=> '角色名称不能为空', 
		    'state.required'=> '角色名称不能为空', 
		    'limit_id.required'=> '角色名称不能为空', 
		];
	}

	/**
	 * 验证错误规则
	 */
	public function rules() {
		if(('id') > 0){ 
		    return [ 
		         'admin_name'=> [ 'required', 'aa',  ], 
		         'password'=> [ 'required',  ], 
		         'mobile'=> [ 'required',  ], 
		         'state'=> [ 'required',  ], 
		         'limit_id'=> [ 'required',  ], 
		    ]; 
		}else{ 
		    return [ 
		         'admin_name'=> [ 'required',  ], 
		         'password'=> [ 'required',  ], 
		         'mobile'=> [ 'required',  ], 
		         'state'=> [ 'required',  ], 
		         'limit_id'=> [ 'required',  ], 
		    ]; 
		}
	}
}
