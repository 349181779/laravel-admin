<?php

// +----------------------------------------------------------------------
// | date: 2016-01-27
// +----------------------------------------------------------------------
// | AddHtmlBuildTraits.php: 后端构建 添加 页面 HTML Traits
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Traits\HtmlBuild;

trait AddHtmlBuildTraits
{
    /**
     * 获取构建 添加 页面 share 到 模板的数据
     *
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function getBuildAddData()
    {
        return [
            'schemas'           => $this->form_schema,//字段
            'title'             => $this->title,//网站标题
            'description'       => $this->description,//网站描述
            'keywords'          => $this->keywords,//网站关键字
            'confirm_button'    => $this->confirm_button,//确认按钮按钮
            'scription_arr'     => $this->scription,//脚本文件
            'method'            => $this->method,//当前表单提交method
            'list_buttons'      => $this->list_buttons,//按钮组
            'build_html_type'   => $this->build_html_type[1],//构建页面类型 为 add
        ];
    }

    /**
     * 构建HTML新增页页面表单
     *
     * @return \Illuminate\View\View
     */
    public function builderAddForm()
    {
        return View('admin/html_builder/add/add_form', $this->getBuildAddData() );
    }

    /**
     * 构建HTML新增页
     *
     * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function builderAdd()
    {
        return View('admin/html_builder/add/add', $this->getBuildAddData() );
    }
}
