<?php

// +----------------------------------------------------------------------
// | date: 2016-01-12
// +----------------------------------------------------------------------
// | BaseController.php: 自动构建基础控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace Yangyifan\AutoBuild\Http\Controllers;

use App\Http\Controllers\Controller;
use gossi\codegen\generator\CodeFileGenerator;
use gossi\codegen\model\PhpClass;

class BaseController extends Controller
{
    protected  $code_generator;
    protected  $php_class;
    protected  $php_method;
    protected  $php_parameter;
    protected  $request;

    const CONSTRUCT_FUNCTION_NAME   = '__construct';//构造方法名称
    const OUT_PUT_DIR               = '/output/';//输出文件目录
    const EXT                       = '.php';//文件类型

    /**
     * 构造方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct()
    {
        $this->code_generator   = new CodeFileGenerator();
        $this->php_class        = new PhpClass();
    }

    /**
     * 文件文件全路径
     *
     * @return string
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function getFileName()
    {
        return dirname(dirname(dirname(__DIR__ ))) . self::OUT_PUT_DIR . $this->request['file_name'] . self::EXT;
    }

    /**
     * 析构方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __destruct()
    {
        $file_name  = $this->getFileName();
        $dir_name   = dirname($file_name);

        if (is_dir($dir_name) == false) {
            mkdir($dir_name, 0777, true);
        }

        file_put_contents( dirname(dirname(dirname(__DIR__ ))) . self::OUT_PUT_DIR . $this->request['file_name'] . self::EXT, $this->code_generator->generate($this->php_class));
    }

    /**
     * 设置文件名称(class名称 和 命名空间)
     *
     * @param $file_name
     * @return $this
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    protected function setQualifiedName($file_name)
    {
        $this->php_class->setQualifiedName($file_name);//设置文件全路径
        $this->php_class->setName(mb_substr($file_name, strpos($file_name, '/') + 1));//设置class名称
        return $this;
    }

    /**
     * 导入 class
     *
     * @param array $use_array
     * @return $this
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    protected function setUse($use_array = [])
    {
        //组合
        array_merge( $use_array, static::USE_ARRAY );

        if (!empty(($use_array))) {
            foreach ($use_array as $use) {
                $this->php_class->declareUse($use);
            }
        }
        return $this;
    }
}
