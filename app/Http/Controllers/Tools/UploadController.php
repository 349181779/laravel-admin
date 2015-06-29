<?php

// +----------------------------------------------------------------------
// | date: 2015-06-28
// +----------------------------------------------------------------------
// | UploadController.php: 上传控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Tools;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class UploadController extends Controller {

	/**
	 * 上传
	 *
	 * @return Response
	 */
	public function getIndex(){
        return View('upload');
	}


    public function getUploadview(){
        return View('uploadview');
    }

}
