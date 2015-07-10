<?php

// +----------------------------------------------------------------------
// | date: 2015-06-07
// +----------------------------------------------------------------------
// | HtmlBuilderController.php: 后端构建HTML控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use UEditor;

class HtmlBuilderController extends BaseController {

    const SCHAME_STRING = 1;//字符串
    const SCHAME_IMAGE  = 2;//图片

    public $schemas             = [];//字段
    public $title               = '';//网站标题
    public $description         = '';//网站描述
    public $keywords            = '';//网站关键字
    public $search_schema       = [];//列表页搜索字段

    public $bottuns             = [];//按钮
    public $form_schema         = [];//form表单字段
    public $confirm_button      = '';//确认按钮
    public $add_button          = '';//增加按钮
    public $json_url            = '';//列表页获得json数据url
    public $edit_data           = [];//编辑页面数据

    public $tab_schema          = [];//选项卡字段
    public $tab_data            = [];//选项卡数据
    public $tab_confirm_button  = [];//选项卡确认按钮数据

    public $tree_data           = [];//tree 数据



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
    public function builderTitle($title, $description = '', $keywords = ''){
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
     * @param $is_sort  是否允许排序
     * @return Response
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function builderSchema($schame, $comment, $type = self::SCHAME_STRING, $class = '', $url = '', $is_sort = 'false'){
        $this->schemas[$schame]  = [
            'comment'   => $comment,
            'type'      => $type,
            'class'     => $class,
            'url'       => $url,
            'is_sort'   => $is_sort
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
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function builderSearchSchema($name, $title, $type = 'text', $class = '', $option = '', $option_value_schema = ''){
        array_push($this->search_schema, [
            'name'                  => $name,
            'title'                 => $title,
            'type'                  => $type,
            'class'                 => $class,
            'option'                => $option,
            'option_value_schema'   => $option_value_schema,
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
     * 构建列表页获得json数据url
     *
     * @param  $name    按钮中文名字
     * @param  $class   按钮class
     * @param  $url     按钮跳转url
     * @param  $placeholder 站位
     * @return Response
     */
    public function builderJsonDataUrl($url){
        $this->json_url = $url;
        return $this;
    }

    /**
	 * 构建HTML列表页
	 *
	 * @return Response
     * @auther yangyifan <yangyifanphp@gmail.com>
	 */
	public function builderList($data = [], $urls = []){
        return View('admin/html_builder/list',[
            'schemas'       => $this->schemas,//字段
            'search_schema' => $this->search_schema,//搜索字段
            'urls'          => $urls,
            'title'         => $this->title,//网站标题
            'description'   => $this->description,//网站描述
            'keywords'      => $this->keywords,//网站关键字
            'bottons'       => $this->bottuns,//按钮
            'add_button'    => $this->add_button,//增加按钮
            'get_json_url'  => $this->json_url,//获得json数据url
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
     * 构建编辑页面数据
     *
     * @param array $data
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function builderEditData($data = []){
        $this->edit_data = $data;
        return $this;
    }

    /**
     * 构建HTML编辑页
     *
     * @return Response
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function builderEdit($urls = []){
        return View('admin/html_builder/edit',[
            'schemas'           => $this->form_schema,//字段
            'data'              => $this->edit_data,
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
    public function builderAdd($data = [], $urls = []){
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

    /**
     * 构建Tab 字段
     *
     * @param $obj
     * @return $this
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function builderTabSchema($obj){
        //写入数据
        array_push($this->tab_schema, serialize($obj));
        array_push($this->tab_data, $this->edit_data);
        array_push($this->tab_confirm_button, $this->confirm_button);

        //销毁数据
        $this->form_schema      = [];
        $this->edit_data        = [];
        $this->confirm_button   = [];

        return $this;
    }

    /**
     * 构建Tab HTML页面
     *
     * @param array $data
     * @param array $urls
     * @return \Illuminate\View\View
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function builderTabHtml($data = [], $urls = []){
        return View('admin/html_builder/tab',[
            'tabs_schemas'      => $this->tab_schema,//tab 字段
            'tab_data'          => $this->tab_data,//tab 数据
            'urls'              => $urls,
            'title'             => $this->title,//网站标题
            'description'       => $this->description,//网站描述
            'keywords'          => $this->keywords,//网站关键字
            'tab_confirm_button'=> $this->tab_confirm_button,//tab 确认按钮按钮
        ]);
    }

    /**
     * 构建tree数据
     *
     * @param $data
     * @return \Illuminate\View\View
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function builderTreeData($data){
        //加载函数库
        load_func('common');
        $this->tree_data =  merge_tree_node(obj_to_array($data));
        return $this;
    }

    /**
     * 构建 tree 页面
     *
     * @param array $data
     * @param array $urls
     * @return \Illuminate\View\View
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function builderTree($data = [], $urls = []){
        return View('admin/html_builder/tree',[
            'tree_schemas'      => $this->schemas,//tree 字段
            'tree_data'         => $this->tree_data,//tree 数据
            'urls'              => $urls,
            'title'             => $this->title,//网站标题
            'description'       => $this->description,//网站描述
            'keywords'          => $this->keywords,//网站关键字
            'add_button'        => $this->add_button,//增加按钮
        ]);
    }

}
