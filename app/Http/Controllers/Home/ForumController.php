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

use App\Model\Home\ForumModel;

class ForumController extends BaseController {

	/**
	 * 论坛首页
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(Request $request){
        $cat_id = $request->get('cat_id', 1);
        return view('home.forum.index', [
            'all_forum'		        => ForumModel::getAllForums($cat_id),
            'all_hot_category'      => ForumModel::getIndexCat(),
            'cat_id'                => $cat_id,
            'title'                 => '论坛',
            'keywords'              => '论坛',
            'description'           => '论坛',
        ]);
	}

    /**
     * 版块分类
     *
     * @return \Illuminate\View\View
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getCategory(){
        return view('home.forum.category', [
            'all_category'          => ForumModel::getAllCategory(),
            'title'                 => '论坛-分类',
            'keywords'              => '论坛-分类',
            'description'           => '论坛-分类',
        ]);
    }

    /**
     * 发表帖子
     *
     * @return \Illuminate\View\View
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getAdd(){
        return view('home.forum.add', [
            'all_category'          => ForumModel::getAllCategory(),
            'title'                 => '发表帖子',
            'keywords'              => '发表帖子',
            'description'           => '发表帖子',
        ]);
    }


}
