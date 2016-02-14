<?php

// +----------------------------------------------------------------------
// | date: 2016-01-27
// +----------------------------------------------------------------------
// | ListHtmlBuildTraits.php: 后端构建 列表 页面 HTML Traits
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Traits\HtmlBuild;

trait ListHtmlBuildTraits
{
    public $json_url            = '';//列表页获得json数据url

    /**
     * 构建HTML列表页字段
     *
     * @param $schame   字段名称
     * @param $comment  备注
     * @param $is_sort  是否允许排序
     * @param $class    class名称
     * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function builderSchema($schame, $comment, $is_sort = true, $class = '')
    {
        $this->schemas[$schame]  = [
            'comment'   => $comment,
            'is_sort'   => $is_sort === true  ? "true" : "false" ,
            'class'     => $class,
        ];
        return $this;
    }

    /**
     * 构建列表页搜索字段
     *
     * @param $name     表单name
     * @param $title    表单名称
     * @param $type     表单类型
     * @param $default  表单默认值
     * @param $notice   表单提示
     * @param $class    表单class
     * @param $rule     表单验证规则
     * @param $message  表单验证提示文字
     * @return $this
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function builderSearchSchema($name, $title, $type = 'text', $default = '', $class = '', $option = '', $option_value_schema = '', $option_value_name = '')
    {
        array_push($this->search_schema, [
            'name'                  => $name,
            'title'                 => $title,
            'type'                  => $type,
            'default'               => $default,
            'class'                 => $class,
            'option'                => $option,
            'option_value_schema'   => $option_value_schema,
            'option_value_name'     => $option_value_name
        ]);
        return $this;
    }

    /**
     * 构建列表页获得json数据url
     *
     * @param  $name    按钮中文名字
     * @param  $class   按钮class
     * @param  $url     按钮跳转url
     * @param  $placeholder 站位
     * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function builderJsonDataUrl($url)
    {
        $this->json_url = $url;
        return $this;
    }

    /**
     * 获取构建 列表页 页面 share 到 模板的数据
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function getBuilderListData()
    {
        return [
            'schemas'           => $this->schemas,//字段
            'search_schema'     => $this->search_schema,//搜索字段
            'title'             => $this->title,//网站标题
            'description'       => $this->description,//网站描述
            'keywords'          => $this->keywords,//网站关键字
            'bottons'           => $this->bottuns,//按钮
            'list_buttons'      => $this->list_buttons,//按钮组
            'get_json_url'      => $this->json_url,//获得json数据url
            'scription_arr'     => $this->scription,//脚本文件
            'method'            => $this->method,//当前表单提交method
            'table_name'        => md5($this->title),//表单名称
            'build_html_type'   => $this->build_html_type[0],//构建页面类型 为 list
        ];
    }

    /**
     * 分享数据到视图
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function shareListData()
    {
        view()->share($this->getBuilderListData());
    }

    /**
     * 构建HTML列表页
     *
     * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function builderList()
    {
        //分享数据到视图
        $this->shareListData();
        return View('admin/html_builder/list/list');
    }

}
