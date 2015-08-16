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

use App\Http\Requests\User\ForumCommentRequest;

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
        //组合数据
        $data['user_info_id']   = Session::get('user_info.id');
        $data['created_at']     = date('Y-m-d H:i:s');
        $data['updated_at']     = date('Y-m-d H:i:s');

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
    public function getSave(Request $requests, $id){
        //获得帖子内容
        $forum_info = ForumModel::getInfo((int)$id);
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
    public function postSave(Request $requests, $id){
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

    /**
     * 评论帖子
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postForumComment(ForumCommentRequest $request){
        $data = $request->only('contents', 'forum_id', 'node');
        //记载函数库
        load_func('common');

        $affected_number = DB::table('forum_comment')->insertGetId([
            'forum_id'      => $data['forum_id'],
            'user_info_id'  => is_user_login(),
            'status'        => 1,
            'created_at'    => date('Y-m-d H:i:s'),
            'contents'      => trim($data['contents']),
            'node'          => $data['node'] > 0 ? (int)$data['node'] : 0,
        ]);
        $affected_number > 0 ? $this->response(200, 'success') : $this->response(400, trans('response.comment_forum_error'));
    }

    /**
     * 删除帖子
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postDel(Request $request){
        $id = intval($request->get('id'));
        if($id > 0 ) DB::table('forum')->where('id', '=', $id)->where('user_info_id', '=', is_user_login())->update(['deleted_at' => date('Y-m-d'), 'status' => 2]);
        return $this->response(200, trans('response.del_forum_success'));
    }


}
