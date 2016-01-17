<?php

// +----------------------------------------------------------------------
// | date: 2016-01-17
// +----------------------------------------------------------------------
// | ControllerController.php: 自动构建 Controller
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace Yangyifan\AutoBuild\Http\Controllers;

use Illuminate\Http\Request;
use gossi\codegen\model\PhpMethod;
use gossi\codegen\model\PhpParameter;
use Yangyifan\AutoBuild\Http\Requests\BuildControllerRequest;
use Yangyifan\AutoBuild\Model\BuildControllerModel;

class ControllerController extends BaseController
{
    //默认 需要 use 的类
    const USE_ARRAY = [
        'App\Http\Controllers\Admin\HtmlBuilderController',
        'Illuminate\Http\Request',
        'App\Http\Controllers\Admin\BaseController',
    ];

    const DEFAULT_PARENT_CLASS = 'BaseController';//默认 Controller 需要继承的 父级

    const GET_INDEX_FUNCTION_NAME   = 'getIndex';//列表页方法名称
    const GET_INDEX_FUNCTION_TITLE  = '列表页';//列表页方法描述
    const GET_SEARCH_FUNCTION_NAME  = 'getSearch';//搜索方法名称
    const GET_SEARCH_FUNCTION_TITLE = '搜索';//搜索方法描述
    const GET_EDIT_FUNCTION_NAME    = 'getEdit';//编辑方法名称
    const GET_EDIT_FUNCTION_TITLE   = '显示编辑页面';//编辑方法描述
    const POST_EDIT_FUNCTION_NAME   = 'postEdit';//处理编辑方法名称
    const POST_EDIT_FUNCTION_TITLE  = '处理编辑';//处理编辑方法描述
    const GET_ADD_FUNCTION_NAME     = 'getAdd';//处理添加方法名称
    const GET_ADD_FUNCTION_TITLE    = '显示添加页面';//处理添加方法描述
    const POST_ADD_FUNCTION_NAME    = 'postAdd';//处理添加方法名称
    const POST_ADD_FUNCTION_TITLE   = '处理添加';//处理添加方法描述

    private $schema_arr = [
        'admin_name' => [
            'name'                  => 'admin_name',//表字段名称
            'title'                 => '会员名称',//字段中文名称
            'schema_type'           => 'char',//字段类型
            'is_search'             => true,//是否允许搜索
            'is_list'               => true, //是否允许列表页显示
            'type'                  => 'text',//字段类型
            'default'               => '',//默认值
            'notice'                => '',//表单提示(默认会展示在页面上)
            'class'                 => '',//表单需要定义的class
            'rule'                  => '',//表单验证规则
            'err_message'           => '',//表单验证错误提示
            'option'                => '',//选项 (notice:需要生成后去实现)
            'option_value_schema'   => '',//选项值 (notice:需要生成后去实现)
            'option_value_name'     => '',//选项名称 (notice:需要生成后去实现)
        ],

        'brithday' => [
            'name'                  => 'brithday',//表字段名称
            'title'                 => '生日',//字段中文名称
            'schema_type'           => 'date',//字段类型
            'is_search'             => true,//是否允许搜索
            'is_list'               => true, //是否允许列表页显示
            'type'                  => 'date',//字段类型
            'default'               => '',//默认值
            'notice'                => '',//表单提示(默认会展示在页面上)
            'class'                 => '',//表单需要定义的class
            'rule'                  => '',//表单验证规则
            'err_message'           => '',//表单验证错误提示
            'option'                => '',//选项 (notice:需要生成后去实现)
            'option_value_schema'   => '',//选项值 (notice:需要生成后去实现)
            'option_value_name'     => '',//选项名称 (notice:需要生成后去实现)
        ],
    ];//表字段列表

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
            ->setProperty("html_builder", "", "", "protected")//设置构建html对象表名称
            ->buildConstruct()//设置 构造 方法
            ->buildIndex()//设置 列表 方法
            ->buildGetSearch()//设置 搜索 方法
            ->buildGetEdit()//设置 显示编辑页面 方法
            ->buildPostEdit()//设置 处理编辑 方法
            ->buildGetAdd()//设置 处理添加 方法
            ->buildPostAdd()//设置 处理添加 方法
            ->setUse( $this->request['use_array'] )//设置 use文件
        ;
    }

    /**
     * 构建列表页方法
     *
     * @return $this
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function buildConstruct()
    {
        $this->php_class->setMethod(
            PhpMethod::create(self::CONSTRUCT_FUNCTION_NAME)
                ->setDescription(self::GET_INDEX_FUNCTION_TITLE)
                ->addParameter(
                    PhpParameter::create("html_builder")
                    ->setType("HtmlBuilderController")
                )
                ->setLongDescription("@author ".self::AUTHOR_NAME." <".self::AUTHOR_EMILA.">")
                ->setBody(BuildControllerModel::buildConstructBody())
        );
        return $this;
    }

    /**
     * 构建构造方法
     *
     * @return $this
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function buildIndex()
    {
        $request_name   = "request";
        $title_name     = "会员列表页";

        $this->php_class->setMethod(
            PhpMethod::create(self::GET_INDEX_FUNCTION_NAME)
                ->setDescription(self::CONSTRUCT_FUNCTION_TITLE)
                ->addParameter(
                    PhpParameter::create($request_name)
                        ->setType("Request")
                )
                ->setLongDescription("@author ".self::AUTHOR_NAME." <".self::AUTHOR_EMILA.">")
                ->setBody(BuildControllerModel::buildGetIndexBody($title_name, $this->schema_arr))
        );
        return $this;
    }

    /**
     * 构建处理搜索方法
     *
     * @return $this
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function buildGetSearch()
    {
        $request_name   = "request";
        $model_name     = "UserInfoModel";

        $this->php_class->setMethod(
            PhpMethod::create(self::GET_SEARCH_FUNCTION_NAME)
                ->setDescription(self::GET_SEARCH_FUNCTION_TITLE)
                ->addParameter(
                    PhpParameter::create($request_name)
                        ->setType("Request")
                )
                ->setLongDescription("@author ".self::AUTHOR_NAME." <".self::AUTHOR_EMILA.">")
                ->setBody(BuildControllerModel::buildGetSearchBody($model_name, $this->schema_arr))
        );
        return $this;
    }

    /**
     * 构建显示编辑页面方法
     *
     * @return $this
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function buildGetEdit()
    {
        $request_name   = "UserInfoRequest";
        $model_name     = "UserInfoModel";
        $title          = "编辑会员列表";

        $this->php_class->setMethod(
            PhpMethod::create(self::GET_EDIT_FUNCTION_NAME)
                ->setDescription(self::GET_EDIT_FUNCTION_TITLE)
                ->addParameter(
                    PhpParameter::create("request")
                        ->setType($request_name)
                )
                ->setLongDescription("@author ".self::AUTHOR_NAME." <".self::AUTHOR_EMILA.">")
                ->setBody(BuildControllerModel::buildGetEditBody($model_name, $title, $this->schema_arr))
        );
        return $this;
    }

    /**
     * 构建处理编辑方法
     *
     * @return $this
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function buildPostEdit()
    {
        $request_name   = "UserInfoRequest";
        $model_name     = "UserInfoModel";

        $this->php_class->setMethod(
            PhpMethod::create(self::POST_EDIT_FUNCTION_NAME)
                ->setDescription(self::POST_EDIT_FUNCTION_TITLE)
                ->addParameter(
                    PhpParameter::create("request")
                        ->setType($request_name)
                )
                ->setLongDescription("@author ".self::AUTHOR_NAME." <".self::AUTHOR_EMILA.">")
                ->setBody(BuildControllerModel::buildPostEditBody($model_name))
        );
        return $this;
    }

    /**
     * 构建显示添加页面方法
     *
     * @return $this
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function buildGetAdd()
    {
        $request_name   = "Request";
        $title          = "添加会员列表";

        $this->php_class->setMethod(
            PhpMethod::create(self::GET_ADD_FUNCTION_NAME)
                ->setDescription(self::GET_ADD_FUNCTION_TITLE)
                ->addParameter(
                    PhpParameter::create("request")
                        ->setType($request_name)
                )
                ->setLongDescription("@author ".self::AUTHOR_NAME." <".self::AUTHOR_EMILA.">")
                ->setBody(BuildControllerModel::buildGetAddBody($title, $this->schema_arr))
        );
        return $this;
    }

    /**
     * 构建处理添加方法
     *
     * @return $this
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function buildPostAdd()
    {
        $request_name   = "Request";
        $model_name     = "UserInfoModel";

        $this->php_class->setMethod(
            PhpMethod::create(self::POST_ADD_FUNCTION_NAME)
                ->setDescription(self::POST_ADD_FUNCTION_TITLE)
                ->addParameter(
                    PhpParameter::create("request")
                        ->setType($request_name)
                )
                ->setLongDescription("@author ".self::AUTHOR_NAME." <".self::AUTHOR_EMILA.">")
                ->setBody(BuildControllerModel::buildPostAddBody($model_name))
        );
        return $this;
    }

}
