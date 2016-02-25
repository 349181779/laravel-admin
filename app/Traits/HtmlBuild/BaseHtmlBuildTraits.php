<?php

// +----------------------------------------------------------------------
// | date: 2016-01-27
// +----------------------------------------------------------------------
// | BaseHtmlBuildTraits.php: 后端构建 HTML 基础 Traits
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Traits\HtmlBuild;

use App\Traits\HtmlBuild\Form\FormHtmlBuildTraits;

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
     * 加载js脚本文件（默认采用 elixir 加载，这样会有版本号，如果$type = false 则直接从网站根目录去链接）
     *
     * @param string $scription
     * @param boolean $type 是否采用 elixir
     * @return $this
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function loadScription($scription = '', $type = true)
    {
        $this->scription[] = $type === true ? elixir($scription) : (substr($scription, 0, 1) != '/' ? '/' . $scription : $scription);
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

    //加载表单对象
    use FormHtmlBuildTraits;

}
