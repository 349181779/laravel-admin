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

    /**
     * 编辑帖子
     *
     * @param Request $requests
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getSave(Request $requests){
        //获得帖子内容
        $id         = $requests->get('id', 1);
        $forum_info = ForumModel::getInfo($id);
        if(empty($forum_info)) return redirect()->action('Home\ForumController@getIndex');

        return view('home.forum.save', [
            'data'                  => $forum_info,
            'all_category'          => ForumModel::getAllCategory(),
            'all_merge_category'    => ForumCatModel::getAllForSchemaOption('cat_name', 0, false),//表单全部分类
            'title'                 => '编辑帖子',
            'keywords'              => '编辑帖子',
            'description'           => '编辑帖子',
        ]);
    }

    /**
     * 编辑帖子
     *
     * @param Request $requests
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postSave(Request $requests){
        $data = $requests->only('id', 'forum_cat_id', 'contents', 'title');
        $data['user_info_id']   = Session::get('user_info.id');

        if(empty(ForumModel::getInfo((int)$data['id']))){
            $this->response(400, trans('response.page_error'));
        }

        DB::table('forum')->where('id', '=', (int)$data['id'])->update([
            'title'         => $data['title'],
            'contents'      => $data['contents'],
            'forum_cat_id'  => $data['forum_cat_id'],
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
        $this->response(200, 'success', $data = [], $target = true, $href = action('Home\ForumController@getInfo', ['id'=> $data['id']]));
    }


}
