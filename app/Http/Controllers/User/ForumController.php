<?php

// +----------------------------------------------------------------------
// | date: 2015-08-05
// +----------------------------------------------------------------------
// | ForumController.php: 会员论坛控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\User;

use App\Http\Controllers\User\BaseController;

use App\Http\Requests;

use Illuminate\Http\Request;

use App\Model\Home\ForumModel;

use App\Http\Requests\User\ForumRequest;

use App\Model\Admin\ForumCatModel;

use Session;

use DB;

class ForumController extends BaseController {


    /**
     * 发表帖子
     *
     * @return \Illuminate\View\View
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getAdd(){
        return view('home.forum.add', [
            'all_category'          => ForumModel::getAllCategory(),
            'all_merge_category'    => ForumCatModel::getAllForSchemaOption('cat_name', 0, false),//表单全部分类
            'title'                 => '发表帖子',
            'keywords'              => '发表帖子',
            'description'           => '发表帖子',
        ]);
    }

    /**
     * 发表帖子
     *
     * @param ForumRequest $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postAdd(ForumRequest $request){
        $data = $request->only('title', 'contents', 'forum_cat_id');
        $data['user_info_id']   = Session::get('user_info.id');

        $affected_number = DB::table('forum')->insertGetId($data);
        return  $affected_number > 0  ? $this->response(200, trans('response.add_success'), [], true, action('Home\ForumController@getIndex')) : $this->response(400, trans('response.add_error'), [], false);

    }


}
