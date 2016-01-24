<?php
namespace App\Http\Controllers\Admin\UserInfo;

use App\Http\Requests\Admin\UserInfo\UserInfo1Request;
use App\Model\Admin\UserInfo\UserInfo1Model;
use App\Http\Controllers\Admin\HtmlBuilderController;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;

/**
 * +----------------------------------------------------------------------
 * | date: 2016-01-24 14:42:34
 * +----------------------------------------------------------------------
 * | UserInfo1Controller.php: 会员控制器
 * +----------------------------------------------------------------------
 * | Author: yangyifan <yangyifanphp@gmail.com>
 * +----------------------------------------------------------------------
 */
class UserInfo1Controller extends BaseController {

	/**
	 * @var string
	 */
	protected $html_builder = '';

	/**
	 * 列表页
	 * 
	 * @author yangyifan <yangyifanphp@gmail.com>
	 * 
	 * @param HtmlBuilderController $html_builder
	 */
	public function __construct(HtmlBuilderController $html_builder) {
		parent::__construct();
		$this->html_builder = $html_builder;
	}

	/**
	 * 显示添加页面
	 * 
	 * @author yangyifan <yangyifanphp@gmail.com>
	 * 
	 * @param Request $request
	 */
	public function getAdd(Request $request) {
		return	 $this->html_builder->
				 builderTitle('添加页面')->
				 builderFormSchema('user_info_id', '邀请者', $type = 'text', $default = '', $notice = '', $class = '', $rule = '', $err_message = '')->
				 builderFormSchema('invitee', '被邀请者', $type = 'text', $default = '', $notice = '', $class = '', $rule = '', $err_message = '')->
				 builderFormSchema('created_at', '创建时间', $type = 'text', $default = '', $notice = '', $class = '', $rule = '', $err_message = '')->
				 builderFormSchema('status', '是否显示【1:未确认；2：已确认】', $type = 'text', $default = '', $notice = '', $class = '', $rule = '', $err_message = '')->
				 builderConfirmBotton('确认', '', 'btn btn-success')->
				 builderAdd();
	}

	/**
	 * 显示编辑页面
	 * 
	 * @author yangyifan <yangyifanphp@gmail.com>
	 * 
	 * @param Request $request
	 */
	public function getEdit(Request $request) {
		$data = UserInfo1Model::find($request->get('id'));
		
		return	 $this->html_builder->
				 builderTitle('编辑页面')->
				 builderFormSchema('user_info_id', '邀请者', $type = 'text', $default = '', $notice = '', $class = '', $rule = '', $err_message = '')->
				 builderFormSchema('invitee', '被邀请者', $type = 'text', $default = '', $notice = '', $class = '', $rule = '', $err_message = '')->
				 builderFormSchema('created_at', '创建时间', $type = 'text', $default = '', $notice = '', $class = '', $rule = '', $err_message = '')->
				 builderFormSchema('status', '是否显示【1:未确认；2：已确认】', $type = 'text', $default = '', $notice = '', $class = '', $rule = '', $err_message = '')->
				 builderEditData($data)->
				 builderConfirmBotton('确认', '', 'btn btn-success')->
				 builderEdit();
	}

	/**
	 * 构造方法
	 * 
	 * @author yangyifan <yangyifanphp@gmail.com>
	 * 
	 * @param Request $request
	 */
	public function getIndex(Request $request) {
		return	 $this->html_builder->
				 builderTitle('列表页')->
				 builderSchema('user_info_id', '邀请者', $type = 'text')->
				 builderSchema('invitee', '被邀请者', $type = 'text')->
				 builderSchema('created_at', '创建时间', $type = 'text')->
				 builderSchema('status', '是否显示【1:未确认；2：已确认】', $type = 'text')->
				 builderSchema('handle', '操作')->
				 builderSearchSchema('user_info_id', '邀请者', $type = 'text')->
				 builderSearchSchema('invitee', '被邀请者', $type = 'text')->
				 builderSearchSchema('created_at', '创建时间', $type = 'text')->
				 builderSearchSchema('status', '是否显示【1:未确认；2：已确认】', $type = 'text')->
				 builderBotton('确认', '')->
				 builderJsonDataUrl(createUrl('Admin\UserInfo\UserInfo1Controller@getSearch'))->
				 builderList();
	}

	/**
	 * 搜索
	 * 
	 * @author yangyifan <yangyifanphp@gmail.com>
	 * 
	 * @param Request $request
	 */
	public function getSearch(Request $request) {
		//接受参数
		$search = $request->get('search', '');
		$sort   = $request->get('sort', 'id');
		$order  = $request->get('order', 'asc');
		$limit  = $request->get('limit',0);
		$offset = $request->get('offset', config('config.page_limit'));
		
		//解析params
		parse_str($search);
		
		//组合查询条件
		$map = [];
		if (!empty($user_info_id)) {
			 $map[''] = $user_info_id; 
		} 
		if (!empty($invitee)) {
			 $map[''] = $invitee; 
		} 
		
		$data = UserInfo1Model::search($map, $sort, $order, $limit, $offset);
		
		echo json_encode([
			'total' => $data['count'],
			'rows'  => $data['data'],
		]);
	}

	/**
	 * 处理添加
	 * 
	 * @author yangyifan <yangyifanphp@gmail.com>
	 * 
	 * @param UserInfo1Request $request
	 */
	public function postAdd(UserInfo1Request $request) {
		$data                = $request->all();
		$affected_number     = UserInfo1Model::create($data);
		return  $affected_number->id > 0  ? $this->response(self::SUCCESS_STATE_CODE, trans('response.add_success')) : $this->response(self::ERROR_STATE_CODE, trans('response.add_error'));
	}

	/**
	 * 处理编辑
	 * 
	 * @author yangyifan <yangyifanphp@gmail.com>
	 * 
	 * @param UserInfo1Request $request
	 */
	public function postEdit(UserInfo1Request $request) {
		$data    = $request->all();
		$Model   = UserInfo1Model::findOrFail($data['id']);
		$Model->update($data);
		$this->response(self::SUCCESS_STATE_CODE, trans('response.update_success'));
	}
}
