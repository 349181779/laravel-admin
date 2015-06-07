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
    protected $bottuns = '';//按钮


    public function __construct(){
        parent::__construct();
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
        ]);
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
	 * 构建网站按钮
	 *
	 * @param  $name    按钮中文名字
     * @param  $class   按钮class
     * @param  $url     按钮跳转url
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
        if($placeholder == '###'){
            //$this->bottuns .= '<a target="_blank" class="'.$class.'" href="'.url($url, ['role_id'=>]).'">'.$name.'</a>';
        }else{
            $this->bottuns .= '<a target="_blank" class="'.$class.'" href="'.url($url).'">'.$name.'</a>';
        }

        return $this;
	}

    /**
     * 构建HTML新增页
     *
     * @return Response
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function builderEdit($data = [], $urls = [])
    {
        return View('admin/html_builder/edit',[
            'schemas'       => $this->schemas,//字段
            'data'          => $data,
            'urls'          => $urls,
            'title'         => $this->title,//网站标题
            'description'   => $this->description,//网站描述
            'keywords'      => $this->keywords,//网站关键字
            'bottons'       => $this->bottuns,//按钮
        ]);
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
