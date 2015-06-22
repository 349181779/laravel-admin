<?php

// +----------------------------------------------------------------------
// | date: 2015-06-22
// +----------------------------------------------------------------------
// | RoleRequest.php: 后端角色表单验证
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Requests\Admin;

use App\Http\Requests\Admin\BaseFormRequest as BaseFormRequest;

class RoleRequest extends BaseFormRequest {

    /**
	 * 增加角色表单验证规则
	 *
	 * @return array
     * @auther yangyifan <yangyifanphp@gmail.com>
	 */
	public function addRules()
	{
		return [
            'role_name' => ['required'],
            'status'    => ['required'],
        ];
	}

    /**
     * 增加表单验证规则提示文字
     *
     * @return array
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function addMessages(){
        return [];
    }

    /**
     * 增加角色表单验证规则
     *
     * @return array
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function editRules()
    {
        return [
            'role_name' => ['required'],
            'status'    => ['required'],
        ];
    }

    /**
     * 增加表单验证规则提示文字
     *
     * @return array
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function editMessages(){
        return [];
    }

}
