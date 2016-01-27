<?php

// +----------------------------------------------------------------------
// | date: 2016-01-27
// +----------------------------------------------------------------------
// | BaseHtmlBuildTraits.php: 后端构建 HTML 基础 Traits
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Traits\HtmlBuild;

trait BaseHtmlBuildTraits
{
    public $method              = 'post';//当前表单提交method
    public $scription           = [];//脚本文件数组

    /**
     * 构建网站标题
     *
     * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function builderTitle($title, $description = '', $keywords = '')
    {
        $this->title        = $title;
        $this->description  = $description;
        $this->keywords     = $keywords;
        return $this;
    }

    /**
     * 选择当前表单提交方法
     *
     * @param string $method
     * @return $this
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function builderMethod($method = 'post')
    {
        $method_arr = [
            'get', 'post', 'delete', 'put'
        ];
        if(in_array(strtolower($method), $method_arr)){
            $this->method = $method;
        }
        return $this;
    }

    /**
     * 构建确认按钮
     *
     * @param $title
     * @param $url
     * @param $class
     * @return $this
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function builderConfirmBotton($title, $url, $class)
    {
        $this->confirm_button = [
            'title' => $title,
            'url'   => $url,
            'class' => $class,
        ];
        return $this;
    }

    /**
     * 加载js脚本文件（采用 elixir 加载，这样会有版本号）
     *
     * @param string $scription
     * @return $this
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function loadScription($scription = '')
    {
        $this->scription[] = elixir($scription);
        return $this;
    }

    /**
     * 构建页面按钮组
     *
     * @param  $name    按钮中文名字
     * @param  $class   按钮class
     * @param  $url     按钮跳转url
     * @param  $events  js 事件
     * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function builderBotton($name, $url = '', $class = '', $events = [])
    {
        array_push($this->list_buttons, [
            'name'          => $name,
            'url'           => $url,
            'class'         => $class,
            'events'        => $events,
        ]);
        return $this;
    }

    /**
     * 构建表单字段
     *
     * @param $name                 表单name
     * @param $title                表单名称
     * @param $type                 表单类型
     * @param $default              表单默认值
     * @param $notice               表单提示
     * @param $class                表单class
     * @param $rule                 表单验证规则
     * @param $err_message          表单验证提示文字
     * @param $option               选项
     * @param $option_value_schema  选项默认值
     * @param $attr                 属性 数组格式
     * @return $option_value_name   下拉列表框选项名称
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function builderFormSchema($name, $title, $type = 'text', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', $option = '', $option_value_schema = '', $option_value_name = '', $attr = [])
    {
        array_push($this->form_schema, [
            'name'                  => $name,
            'title'                 => $title,
            'type'                  => $type,
            'default'               => $default,
            'notice'                => $notice,
            'class'                 => $class,
            'rule'                  => $rule,
            'err_message'           => $err_message,
            'option'                => $option,
            'option_value_schema'   => $option_value_schema,
            'option_value_name'     => $option_value_name,
            'attr'                  => $attr,
        ]);
        return $this;
    }
}
