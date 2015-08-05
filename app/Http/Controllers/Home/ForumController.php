<?php

// +----------------------------------------------------------------------
// | date: 2015-08-05
// +----------------------------------------------------------------------
// | ForumController.php: 前台论坛控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Home\BaseController;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ForumController extends BaseController {

	/**
	 * 论坛首页
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(){
        return view('home.forum.index', [
            'title'                 => '论坛',
            'keywords'              => '论坛',
            'description'           => '论坛',
        ]);
	}


}
