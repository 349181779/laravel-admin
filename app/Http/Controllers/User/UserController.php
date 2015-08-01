<?php

// +----------------------------------------------------------------------
// | date: 2015-08-01
// +----------------------------------------------------------------------
// | UserController.php: 好友管理页面控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\User;

use App\Http\Controllers\User\BaseController;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Model\Home\IndexModel;

class UserController extends BaseController {

	/**
	 * 好友管理
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(){
        return view('user.user.index', [
            'all_site'      => IndexModel::getAllSite(),
            'title'         => '会员-好友管理',
            'keywords'      => '会员-好友管理',
            'description'   => '会员-好友管理',
        ]);
	}

    /**
     * 获得好友数据
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postFriend(){
        //获得好友数据
        $data = [
            [
                'name'=> '在线好友',
                'nums'=> 4,
                'id'=> 1,
                'item'=> [
                    ['id'=> "100001", 'name'=> 'yangyifan1', 'face'=> 'http://tp1.sinaimg.cn/1571889140/180/40030060651/1'],
                    ['id'=> "100002", 'name'=> 'yangyifan2', 'face'=> 'http://tp1.sinaimg.cn/1571889140/180/40030060651/1'],
                    ['id'=> "100003", 'name'=> 'yangyifan3', 'face'=> 'http://tp1.sinaimg.cn/1571889140/180/40030060651/1'],
                    ['id'=> "100004", 'name'=> 'yangyifan4', 'face'=> 'http://tp1.sinaimg.cn/1571889140/180/40030060651/1'],
                ],
            ]

        ];
        //响应
        return $this->response($code = 200, $msg = '', $data = $data, $target = true, $href = '');
    }

    /**
     * 获得我的群组
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postGroup(){
        //获得我的群组
        $data = [
            [
                'name'=> '我的分组',
                'nums'=> 4,
                'id'=> 1,
                'item'=> [
                    ['id'=> "100001", 'name'=> '分组1', 'face'=> 'http://tp1.sinaimg.cn/1571889140/180/40030060651/1'],
                    ['id'=> "100002", 'name'=> '分组2', 'face'=> 'http://tp1.sinaimg.cn/1571889140/180/40030060651/1'],
                    ['id'=> "100003", 'name'=> '分组3', 'face'=> 'http://tp1.sinaimg.cn/1571889140/180/40030060651/1'],
                    ['id'=> "100004", 'name'=> '分组4', 'face'=> 'http://tp1.sinaimg.cn/1571889140/180/40030060651/1'],
                ],
            ]

        ];
        //响应
        return $this->response($code = 200, $msg = '', $data = $data, $target = true, $href = '');
    }

    /**
     * 获得群组成员
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postGroups(){
        //获得群组成员
        $data = [
            ['id'=> "100001", 'name'=> 'yangyifan1', 'face'=> 'http://tp1.sinaimg.cn/1571889140/180/40030060651/1'],
            ['id'=> "100002", 'name'=> 'yangyifan2', 'face'=> 'http://tp1.sinaimg.cn/1571889140/180/40030060651/1'],
            ['id'=> "100003", 'name'=> 'yangyifan3', 'face'=> 'http://tp1.sinaimg.cn/1571889140/180/40030060651/1'],
            ['id'=> "100004", 'name'=> 'yangyifan4', 'face'=> 'http://tp1.sinaimg.cn/1571889140/180/40030060651/1'],

        ];
        //响应
        return $this->response($code = 200, $msg = '', $data = $data, $target = true, $href = '');
    }

    public function postChatlog(){
        //获得群组成员
        $data = [
            ['id'=> "100001", 'name'=> 'yangyifan1', 'time'=> '10:22', 'face'=> 'http://tp1.sinaimg.cn/1571889140/180/40030060651/1'],
            ['id'=> "100002", 'name'=> 'yangyifan2', 'time'=> '10:22', 'face'=> 'http://tp1.sinaimg.cn/1571889140/180/40030060651/1'],
            ['id'=> "100003", 'name'=> 'yangyifan3', 'time'=> '10:22', 'face'=> 'http://tp1.sinaimg.cn/1571889140/180/40030060651/1'],
            ['id'=> "100004", 'name'=> 'yangyifan4', 'time'=> '10:22', 'face'=> 'http://tp1.sinaimg.cn/1571889140/180/40030060651/1'],

        ];
        //响应
        return $this->response($code = 200, $msg = '', $data = $data, $target = true, $href = '');
    }



    public function postSendurl(){

    }

}
