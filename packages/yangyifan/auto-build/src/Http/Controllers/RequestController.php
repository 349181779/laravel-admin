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
    const RULE_FUNC_TITLE       = '验证错误规则';// Rule 函数名称
    const MESSAGE_FUNC_TITLE    = '验证错误提示';// Message 函数名称

    private $all_rule          = [];//全部验证规则

    //测试验证规则
    private $rules = [
        'admin_name'    => ['rule' => ['required', 'url', ["after", "2015-02-01"] , "alpha_num", ["exists", "user_info", "admin_name"]], 'name' => '用户名'],
        'password'      => ['rule' => ['required'], 'name' => '密码'],
        'mobile'        => ['rule' => ['required'], 'name' => '手机号码'],
        'state'         => ['rule' => ['required'], 'name' => '状态'],
        'limit_id'      => ['rule' => ['required'], 'name' => '角色id'],
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

        $this->setQualifiedName()
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
                ->setDescription(self::RULE_FUNC_TITLE)
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
                ->setDescription(self::MESSAGE_FUNC_TITLE)
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
            $body .=    "\t return [ \r\n";
                        foreach ($rules_arr as $key => $rule) {
                            $body .= $this->mergeRule($key, $rule['rule']);
                        }
            $body .=    "\t]; \r\n";
            $body .= "}else{ \r\n";
            $body .=    "\treturn [ \r\n";
                        foreach ($rules_arr as $key => $rule) {
                            $body .= $this->mergeRule($key, $rule['rule']);
                        }
            $body .=    "\t]; \r\n";
            $body .= "} \r\n";
        }
        return $body;
    }

    /**
     * 组合rule 规则
     *
     * @param $schema
     * @param $rule
     * @return string
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function mergeRule($schema, $rule)
    {
        if (!empty($rule)) {
            $str = '';
            if (is_array($rule)) {
                foreach ($rule as $v) {
                    $str .= $this->mergeRuleForOnes($v);
                }
            } else {
                $str .= $this->mergeRuleForOnes($rule);
            }

            return "\t\t '{$schema}'=> [ {$str}], \r\n";
        }
    }

    /**
     * 组合单条rule规则
     *
     * @param $rule
     * @return string
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function mergeRuleForOnes($rule)
    {
        if (!empty($rule)) {
            if (is_array($rule)) {
                $rule_title = $rule[0];
                unset($rule[0]);

                return "'" . $rule_title . ":" . implode(self::EXPLODE, $rule) . "', ";
            }
            return "'" . $rule . "', ";
        }
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
            foreach ($rules_arr as $schema => $rule) {
                if (!empty($rule['rule'])) {
                    foreach ($rule['rule'] as $v) {
                        $body .= $this->mergeMessage($schema, $v, $rule['name']);
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
     * @param $schema
     * @param $rule
     * @param $name
     * @return string
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function mergeMessage($schema, $rule, $name)
    {
        $params = [];

        if (is_array($rule)) {
            $rule_title = $rule[0];
            unset($rule[0]);
            $params = array_merge($params, $rule);
        } else {
            $rule_title = strtolower($rule);
            array_push($params, $name);
        }

        //把 验证规则 转义成小写
        $rule_title = strtolower($rule_title);

        //获得全部验证规则
        $arr = $this->getAllRule();

        if (!empty($rule_title) && array_key_exists($rule_title, $arr)) {

            $rule_value = $arr[$rule_title];

            //如果是 request验证规则 ,则把 当前字段备注名称压入数组
            if ($rule_title == "required") {
                $params = [$name];
            }

            if (is_array($rule_value)) {
                return "\t'{$schema}.{$rule_title}' => '" . vsprintf($rule_value[1], $params) . "', \r\n";
            }
            return "\t'{$schema}.{$rule_title}' => '" . vsprintf($arr[$rule_title], $params) . "', \r\n";
        }
    }

    /**
     * 获得全部验证规则
     * laravel 可用验证规则
     * 规则 => 规则错误时提示文字
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function getAllRule()
    {
        if (empty($this->all_rule)) {
            $this->all_rule = [
                "accepted"          => "请确认接受服务条款",
                "active_url"        => "url格式不正确",
                "after"             => ["after:%s", "当前时间不能小于%s"],
                "before"            => ["before:%s", "当前时间不能大于%s"],
                "alpha"             => "必须全部是数字",
                "alpha_dash"        => "字母、数字、破折号（-）以及底线（_）",
                "alpha_num"         => "必须是字母、数字",
                "array"             => "必须是数组",
                "between"           => ["between:%d,%d", "必须在%d-%d之间"],
                "confirmed"         => ["confirmed_%s", "重复的%s不正确"],
                "date"              => "时间格式不正确",
                "date_format"       => "时间格式不正确",
                "different"         => ["different:%s", "不能和%s相同"],
                "digits"            => ["digits:%d", "字段必须是数字,并且长度为%d"],
                "digits_between"    => ["digits_between:%d,%d", "字段必须是数字,并且长度在%d-%d之间"],
                "boolean"           => "必须是boolean值",
                "email"             => "邮箱格式不正确",
                "exists"            => ["exists:%s,%s", "%s不能重复"],
                "image"             => "必须是图片",
                "in"                => ["in:%s", "必须为%s清单的其中一个值"],
                "integer"           => "必须为整数",
                "ip"                => "当前ip格式不正确",
                "max"               => ["max:%d", "必须大于%d"],
                "mimes"             => ["mimes:%s", "文件的Mime 类型必须要为%s清单的其中一个值"],
                "min"               => ["min:%d", "必须小于%d"],
                "not_in"            => ["not_in:%s", "不能在%s其中"],
                "numeric"           => "必须是数字",
                "regex"             => ["regex:%s", "格式不正确"],
                "required"          => ["required", "%s不能为空"],
                //required_if:field,value
                //required_with:foo,bar,...
                //required_with_all:foo,bar,...
                //required_without:foo,bar,...
                //required_without_all:foo,bar,...
                //same:field
                //size:value
                //timezone
                //unique:table,column,except,idColumn
                "url"               => "url格式不正确",
            ];
        }
        return $this->all_rule;
    }

}
