<?php

// +----------------------------------------------------------------------
// | date: 2016-01-12
// +----------------------------------------------------------------------
// | IndexController.php: 自动构建控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace Yangyifan\AutoBuild\Http\Controllers;

use Illuminate\Http\Request;
use gossi\codegen\model\PhpMethod;
use gossi\codegen\model\PhpParameter;
use Yangyifan\AutoBuild\Model\BuildControllerModel;
use Yangyifan\AutoBuild\Http\Requests\BuildControllerRequest;

class IndexController extends BaseController
{
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
    public function getBuildController(BuildControllerRequest $request)
    {
        $this->request = $request->all();
        $this
            ->setQualifiedName( $this->request['file_name'] )
            ->buildConstruct()
            ->setUse( $this->request['use_array'] )
        ;
    }

    /**
     * 设置构造方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function buildConstruct()
    {
        $this->php_class->setMethod(
            PhpMethod::create(self::CONSTRUCT_FUNCTION_NAME)
                ->addParameter(
                    PhpParameter::create('html_builder')
                        ->setType('HtmlBuilderController')
                        ->setDescription('构造方法')
                )->setBody("parent::__construct();\r\n \$this->html_builder = \$html_builder;")
        );
        return $this;
    }

    /**
     * 构建列表页
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function buildIndex()
    {
        BuildControllerModel::buildIndex($this->php_class);
        return $this;
    }

}
