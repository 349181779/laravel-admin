<?php

// +----------------------------------------------------------------------
// | date: 2015-06-07
// +----------------------------------------------------------------------
// | AdminHtmlBuilderController.php: 后端构建HTML控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminHtmlBuilderController extends AdminBaseController {

    const SCHAME_STRING = 1;//字符串
    const SCHAME_IMAGE  = 2;//图片

    protected $schemas = [];//字段
    protected $title;//网站标题
    protected $description;//网站描述
    protected $keywords;//网站关键字
    protected $bottuns = [];//按钮
    protected $form_schema = [];//form表单字段
    protected $confirm_button;//确认按钮
    protected $add_button;//增加按钮


    /**
     * 构造方法
     *
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * 构建网站标题
     *
     * @return Response
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function builderTitle($title, $description = '', $keywords = '')
    {
        $this->title        = $title;
        $this->description  = $description;
        $this->keywords     = $keywords;
        return $this;
    }

    /**
     * 构建HTML列表页字段
     *
     * @param $schame   字段名称
     * @param $comment  备注
     * @param $type     字段类型
     * @param $class    class名称
     * @param $url      url
     * @return Response
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function builderSchema($schame, $comment, $type = self::SCHAME_STRING, $class = '', $url = '')
    {
        $this->schemas[$schame]  = [
            'comment'   => $comment,
            'type'      => $type,
            'class'     => $class,
            'url'       => $url,
        ];
        return $this;
    }

    /**
     * 构建网站按钮
     *
     * @param  $name    按钮中文名字
     * @param  $class   按钮class
     * @param  $url     按钮跳转url
     * @param  $placeholder 站位
     * @return Response
     */
    public function builderBotton($name, $url, $class = '', $placeholder = '')
    {
        array_push($this->bottuns, [
            'name'          => $name,
            'url'           => $url,
            'class'         => $class,
            'placeholder'   => $placeholder,
        ]);
        return $this;
    }

    /**
     * 构建列表页增加按钮
     *
     * @param  $name    按钮中文名字
     * @param  $class   按钮class
     * @param  $url     按钮跳转url
     * @param  $placeholder 站位
     * @return Response
     */
    public function builderAddBotton($name, $url, $class = '', $placeholder = ''){
        $this->add_button = [
            'name'          => $name,
            'url'           => $url,
            'class'         => $class,
            'placeholder'   => $placeholder,
        ];
        return $this;
    }
	/**
	 * 构建HTML列表页
	 *
	 * @return Response
     * @auther yangyifan <yangyifanphp@gmail.com>
	 */
	public function builderList($data = [], $urls = [])
	{

        return View('admin/html_builder/index',[
            'schemas'       => $this->schemas,//字段
            'data'          => $data,
            'urls'          => $urls,
            'title'         => $this->title,//网站标题
            'description'   => $this->description,//网站描述
            'keywords'      => $this->keywords,//网站关键字
            'bottons'       => $this->bottuns,//按钮
            'add_button'    => $this->add_button,//增加按钮
        ]);
	}

    /**
     * 构建表单字段
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
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function builderFormSchema($name, $title, $type = 'text', $default = '',  $notice = '', $class = '', $rule = '*', $err_message = '', $option = '', $option_value_schema = ''){
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
        ]);
        return $this;
    }

    /**
     * 构建确认按钮
     *
     * @param $title
     * @param $url
     * @param $class
     * @return $this
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function builderConfirmBotton($title, $url, $class){
        $this->confirm_button = [
            'title' => $title,
            'url'   => $url,
            'class' => $class,
        ];
        return $this;
    }

    /**
     * 构建HTML编辑页
     *
     * @return Response
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function builderEdit($data = [], $urls = [])
    {
        return View('admin/html_builder/edit',[
            'schemas'           => $this->form_schema,//字段
            'data'              => $data,
            'urls'              => $urls,
            'title'             => $this->title,//网站标题
            'description'       => $this->description,//网站描述
            'keywords'          => $this->keywords,//网站关键字
            'confirm_button'    => $this->confirm_button,//确认按钮按钮
        ]);
    }

    /**
     * 构建HTML新增页
     *
     * @return Response
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function builderAdd($data = [], $urls = [])
    {
        return View('admin/html_builder/add',[
            'schemas'           => $this->form_schema,//字段
            'data'              => $data,
            'urls'              => $urls,
            'title'             => $this->title,//网站标题
            'description'       => $this->description,//网站描述
            'keywords'          => $this->keywords,//网站关键字
            'confirm_button'    => $this->confirm_button,//确认按钮按钮
        ]);
    }

}
