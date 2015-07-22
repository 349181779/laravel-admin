<?php

// +----------------------------------------------------------------------
// | date: 2015-06-28
// +----------------------------------------------------------------------
// | ResourceController.php: 后端资源控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Model\Admin\Resource;

class ResourceController extends BaseController {


    /**
     * 构造方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct(){
        parent::__construct();
    }

	/**
	 * 资源列表
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(Request $request){
        return View('admin.resource.index', ['title'     => '资源列表']);
	}


    /**
     * 搜索文件
     *
     * @param Request $request
     */
    public function getSearch(Request $request){
        //接受参数
        $search     = $request->get('search');
        $sort       = $request->get('sort', 'id');
        $order      = $request->get('order', 'asc');
        $limit      = $request->get('limit',0);
        $offset     = $request->get('offset', config('config.page_limit'));

        //解析params
        parse_str($search);

        //组合查询条件
        $map = [];
        if(!empty($file_name)){
            $map['file_name'] = ['like', '%'.$file_name.'%'];
        }
        if(!empty($file_type)){
            $map['file_type'] = $file_type;
        }

        $data = Resource::search($map, $sort, $order, $limit, $offset);
        echo json_encode([
            'total' => $data['count'],
            'rows'  => $data['data'],
        ]);
    }

    /**
     * 获得悬着图片弹出框
     *
     * @return \Illuminate\View\View
     */
    public function getChoseImageDialog(){
        return View('tools.image.image_dialog');
    }

    public function getSearchImageDialog(Request $request){
        //接受参数
        $file_type  = $request->get('type');
        $file_name  = $request->get('search', '');
        $sort       = $request->get('sort', 'id');
        $order      = $request->get('order', 'asc');
        $limit      = $request->get('limit',0);
        $offset     = $request->get('offset', config('config.page_limit'));

        //组合查询条件
        $map = [];
        if(!empty($file_type)){
            $map['file_type'] = $file_type;
        }
        if(!empty($file_name)){
            $map['file_name'] = ['like','%'.$file_name.'%'];
        }

        $data = Resource::search($map, $sort, $order, $limit, $offset);
        echo json_encode([
            'total' => $data['count'],
            'rows'  => $data['data'],
        ]);
    }

}
