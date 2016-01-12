<?php

// +----------------------------------------------------------------------
// | date: 2016-01-12
// +----------------------------------------------------------------------
// | RequestController.php: 自动构建request
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace Yangyifan\AutoBuild\Http\Controllers;

use Illuminate\Http\Request;
use gossi\codegen\model\PhpMethod;
use gossi\codegen\model\PhpParameter;
use Yangyifan\AutoBuild\Model\BuildControllerModel;
use Yangyifan\AutoBuild\Http\Requests\BuildControllerRequest;

class RequestController extends BaseController
{
    //默认 需要 use 的类
    const USE_ARRAY = [
        'App\Http\Requests\BaseFormRequest'
    ];

    const RULES_FUNCTION_NAME   = 'rules';//验证规则方法名称
    const MSG_FUNCTION_NAME     = 'messages';//验证规则方法名称

    //测试验证规则
    private $rules = [
        'admin_name'    => ['rule' => ['required', 'aa'], 'name' => '角色名称'],
        'password'      => ['rule' => ['required'], 'name' => '角色名称'],
        'mobile'        => ['rule' => ['required'], 'name' => '角色名称'],
        'state'         => ['rule' => ['required'], 'name' => '角色名称'],
        'limit_id'      => ['rule' => ['required'], 'name' => '角色名称'],
    ];

    /**
     * 构造方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 设置
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getIndex(BuildControllerRequest $request)
    {
        $this->request = $request->all();
        $this
            ->setQualifiedName( $this->request['file_name'] )

            ->buildMessages()->buildRules()
            ->setUse( $this->request['use_array'] )
        ;
    }

    /**
     * 设置验证规则方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function buildRules()
    {
        $this->php_class->setMethod(
            PhpMethod::create(self::RULES_FUNCTION_NAME)
                ->setDescription("验证错误规则")
                ->setBody($this->buildRulesFuncBody($this->rules))
        );
        return $this;
    }

    /**
     * 设置验证规则提示文字
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function buildMessages()
    {
        $this->php_class->setMethod(
            PhpMethod::create(self::MSG_FUNCTION_NAME)
                ->setDescription("验证错误提示")
                ->setBody($this->buildMessageFuncBody($this->rules))
        );
        return $this;
    }

    /**
     * 设置规则函数主体
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function buildRulesFuncBody($rules_arr)
    {
        $body = "";

        if (!empty($rules_arr)) {
            $body .= "if($this->get('id') > 0){ \r\n";
            $body .=    str_repeat(' ', 4) . "return [ \r\n";
                        foreach ($rules_arr as $key => $rule) {
                            if (!empty($rule['rule'])) {
                                $rule_tmp_arr = '';
                                foreach ($rule['rule'] as $v) {
                                    $rule_tmp_arr .= "'{$v}', ";
                                }
                            }
                            $body .= str_repeat(' ', 8) ." '{$key}'=> [ " . $rule_tmp_arr . " ], \r\n";
                        }
            $body .=    str_repeat(' ', 4) . "]; \r\n";
            $body .= "}else{ \r\n";
            $body .=    str_repeat(' ', 4) . "return [ \r\n";
                        foreach ($rules_arr as $key => $rule) {
                            $body .= str_repeat(' ', 8) . " '{$key}'=> [ " . $rule_tmp_arr . " ], \r\n";
                        }
            $body .=    str_repeat(' ', 4) . "]; \r\n";
            $body .= "} \r\n";
        }
        return $body;
    }

    /**
     * 设置错误提示函数主体
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function buildMessageFuncBody($rules_arr)
    {
        $body = "";

        if (!empty($rules_arr)) {
            $body =    "return [ \r\n";
            foreach ($rules_arr as $key => $rule) {
                if (!empty($rule['rule'])) {
                    foreach ($rule['rule'] as $v) {
                        $body .= "    '{$key}.{$v}'=> '" . $this->mergeRule($v, $rule['name']) ."', \r\n";
                    }
                }
            }
            $body .=    "]; \r\n";
        }
        return $body;
    }

    /**
     * 组合错误提示文字
     *
     * @param $rule
     * @param $name
     * @return string
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function mergeRule($rule, $name)
    {
        $rule = strtolower($rule);

        $arr = [
            "required" => "%s不能为空",
        ];

        if (!empty($rule) && array_key_exists($rule, $arr)) {
            return sprintf($arr[$rule], $name);
        }
    }

}
