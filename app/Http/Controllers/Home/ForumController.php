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

use Illuminate\Http\Request;

use App\Model\Home\ForumModel;

use App\Http\Requests\Home\ForumRequest;

use App\Model\Admin\ForumCatModel;

use App\Model\User\UserModel;

use Session;

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
     * 帖子详情
     *
     * @return \Illuminate\View\View
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getInfo(Request $request){
        //获得帖子内容
        $id         = $request->get('id', 1);
        $forum_info = ForumModel::getInfo($id);
        if(empty($forum_info)) return redirect()->action('Home\ForumController@getIndex');

        return view('home.forum.info', [
            'user_profile'          => UserModel::getUserProfile($forum_info->user_info_id),
            'data'                  => $forum_info,
            'title'                 => '论坛-'.$forum_info->title,
            'keywords'              => '论坛-'.$forum_info->title,
            'description'           => '论坛-'.$forum_info->title,
        ]);
    }

}
