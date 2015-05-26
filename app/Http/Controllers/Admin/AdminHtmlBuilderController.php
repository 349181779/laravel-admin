<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminHtmlBuilderController extends AdminBaseController {

    const SCHAME_STRING = 1;//字符串
    const SCHAME_IMAGE  = 2;//图片
    const SCHME_BUTTON  = 3;//按钮

    protected $schemas = [];//字段

    public function __construct(){
        parent::__construct();
    }

	/**
	 * 构建HTML列表页
	 *
	 * @return Response
	 */
	public function builderList($data = [], $urls = [])
	{
        return View('admin/html_builder/index',[
            'schemas'   => $this->schemas,
            'data'      => $data,
            'urls'      => $urls,
        ]);
	}

	/**
	 * 构建HTML列表页字段
	 *
	 * @return Response
	 */
	public function builderSchema($schame,$comment,$type = self::SCHAME_STRING,$class = '',$url = '')
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
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
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
