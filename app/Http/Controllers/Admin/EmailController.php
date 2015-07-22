<?php

// +----------------------------------------------------------------------
// | date: 2015-07-22
// +----------------------------------------------------------------------
// | EmailController.php: 后端邮箱控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Model\Admin\EmailModel;

use App\Http\Requests\Admin\EmailRequest;

class EmailController extends BaseController {

    protected $html_builder;

    /**
     * 构造方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct(HtmlBuilderController $html_builder){
        $this->html_builder = $html_builder;
    }

	/**
	 * 获得菜单列表
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(){
        return  $this->html_builder->
                builderTitle('邮件列表')->
                builderSchema('id', 'id')->
                builderSchema('name', '邮箱名称')->
                builderSchema('status', '状态')->
                builderSchema('sort', '排序')->
                builderSchema('created_at', '创建时间')->
                builderSchema('updated_at', '更新时间')->
                builderSchema('handle', '操作')->
                builderSearchSchema('name', '邮箱名称')->
                builderSearchSchema($name = 'status', $title = '状态', $type = 'select', $class = '', $option = [1=>'开启', '2'=>'关闭'], $option_value_schema = '0')->
                builderAddBotton('增加邮件', url('admin/email/add'))->
                builderJsonDataUrl(url('admin/email/search'))->
                builderList();
	}

    /**
     * 搜索
     *
     * @param Request $request
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function getSearch(Request $request){
        //接受参数
        $search = $request->get('search', '');
        $sort   = $request->get('sort', 'id');
        $order  = $request->get('order', 'asc');
        $limit  = $request->get('limit', 0);
        $offset = $request->get('offset', config('config.page_limit'));

        //解析params
        parse_str($search);

        //组合查询条件
        $map = [];
        if(!empty($name)){
            $map['name'] = ['like', '%'.$name.'%'];
        }
        if(!empty($status)){
            $map['article.status'] = $status;
        }

        $data = EmailModel::search($map, $sort, $order, $limit, $offset);

        echo json_encode([
            'total' => $data['count'],
            'rows'  => $data['data'],
        ]);
    }

    /**
     * 编辑菜单
     *
     * @param  int  $id
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getEdit($id){
        return  $this->html_builder->
                builderTitle('编辑菜单')->
                builderFormSchema('id', 'id', 'hidden')->
                builderFormSchema('name', '邮件名称')->
                builderFormSchema('site_url', '网址url', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'url', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('status', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderFormSchema('sort', '排序', 'text', 255)->
                builderConfirmBotton('确认', url('admin/email/edit'), 'btn btn-success')->
                builderEditData(EmailModel::find($id))->
                builderEdit();
    }

    /**
     * 处理更新菜单
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postEdit(EmailRequest $request){
        $Model = EmailModel::findOrFail($request->get('id'));
        $Model->update($request->all());
        //更新成功
        return $this->response(200, trans('response.update_success'), [], true , url('admin/email/index'));
    }

    /**
     * 增加菜单
     *
     * @param  int  $id
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getAdd(){
        return  $this->html_builder->
                builderTitle('增加菜单')->
                builderFormSchema('name', '邮件名称')->
                builderFormSchema('site_url', '网址url', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'url', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('status', '状态', 'radio', '', '', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderFormSchema('sort', '排序', 'text', 255)->
                builderConfirmBotton('确认', url('admin/email/add'), 'btn btn-success')->
                builderAdd();
    }

    /**
     * 处理新增菜单
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postAdd(EmailRequest $request){
        $affected_number = EmailModel::create($request->all());
        return $affected_number->id > 0 ? $this->response(200, trans('response.add_success'), [], true, url('admin/email/index')) : $this->response(400, trans('response.add_error'), [], true, url('admin/email/index'));
    }

}
