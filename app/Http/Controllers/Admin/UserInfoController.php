<?php

// +----------------------------------------------------------------------
// | date: 2015-06-28
// +----------------------------------------------------------------------
// | UserInfoController.php: 前端用户控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests\Admin\UserInfoRequest;

use App\Model\Admin\UserInfoModel;

class UserInfoController extends BaseController {

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
	 * 获得前台用户
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(){
        return  $this->html_builder->
                builderTitle('会员列表')->
                builderSchema('id', 'id')->
                builderSchema('user_name', '昵称')->
                builderSchema('email', '登录名')->
                builderSchema('mobile','手机号码')->
                builderSchema('status', '状态')->
                builderSchema('sex', '性别')->
                builderSchema('birthday', '生日')->
                builderSchema('face', '头像', 2)->
                builderSchema('created_at', '创建时间')->
                builderSchema('handle', '操作')->
                builderSearchSchema('user_name', '昵称')->
                builderSearchSchema('email', '登录名')->
                builderSearchSchema('mobile', '手机号码')->
                builderSearchSchema($name = 'status', $title = '状态', $type = 'select', $class = '', $option = [1=>'开启', '2'=>'关闭'], $option_value_schema = '1')->
                builderSearchSchema($name = 'sex', $title = '性别', $type = 'select', $class = '', $option = [1=>'男', '2'=>'女', '3'=>'未知'], $option_value_schema = '0')->
                builderSearchSchema('birthday', '生日', 'date')->
                builderAddBotton('增加用户', url('admin/userinfo/add'))->
                builderJsonDataUrl(url('admin/userinfo/search'))->
                builderList();
	}

    /**
     * 搜索
     *
     * @param Request $request
     */
    public function getSearch(Request $request){
        //接受参数
        $search     = $request->get('search', '');
        $sort       = $request->get('sort', 'id');
        $order      = $request->get('order', 'asc');
        $limit      = $request->get('limit',0);
        $offset     = $request->get('offset', config('config.page_limit'));

        //解析params
        parse_str($search);

        //组合查询条件
        $map = [];
        if(!empty($user_name)){
            $map['user_name'] = ['like','%'.$user_name.'%'];
        }
        if(!empty($email)){
            $map['email'] = ['like','%'.$email.'%'];
        }
        if(!empty($mobile)){
            $map['mobile'] = ['like','%'.$mobile.'%'];
        }
        if(!empty($status)){
            $map['status'] = $status;
        }
        if(!empty($sex)){
            $map['sex'] = $sex;
        }
        if(!empty($birthday)){
            $map['birthday'] = $birthday;
        }

        $data = UserInfoModel::search($map, $sort, $order, $limit, $offset);
        echo json_encode([
            'total' => $data['count'],
            'rows'  => $data['data'],
        ]);
    }

    /**
     * 编辑会员
     *
     * @param  int  $id
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getEdit($id){
        return  $this->html_builder->
                builderTitle('编辑会员')->
                builderFormSchema('id', 'id', 'hidden')->
                builderFormSchema('user_name', '昵称')->
                builderFormSchema('email', '登录邮箱', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'e', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('password', '登录密码', $type = 'password', $default = '',  $notice = '', $class = '', $rule = '')->
                builderFormSchema('mobile', '手机号码', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'm', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('status', '状态', 'radio', '', '当前角色是否开启，如果关闭，则属于当前角色都不可用', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderFormSchema('sex', '性别', 'radio', '', '', '', '', '', [1=>'男', '2'=>'女', '3'=>'未知'], '3')->
                builderFormSchema('birthday', '生日', 'date')->
                builderFormSchema('face', '头像', 'image')->
                builderConfirmBotton('确认', url('admin/userinfo/edit'), 'btn btn-success')->
                builderEditData(UserInfoModel::find($id))->
                builderEdit();
    }

    /**
     * 处理更新会员
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postEdit(UserInfoRequest $request){
        $data = $request->all();
        $Model = UserInfoModel::findOrFail($data['id']);
        if(empty($data['password'])){
            $data['password'] =$Model->password;
        }else{
            $data['password'] = bcrypt($data['password']);
        }
        $Model->fill($data);
        $Model->save();

        //更新成功
        return $this->response(200, trans('response.update_success'), [], true, url('admin/userinfo/index'));
    }

    /**
     * 增加会员
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getAdd(){
        return  $this->html_builder->
                builderTitle('增加会员')->
                builderFormSchema('user_name', '昵称')->
                builderFormSchema('email', '登录邮箱', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'e', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('password', '登录密码', $type = 'password')->
                builderFormSchema('mobile', '手机号码', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'm', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('status', '状态', 'radio', '', '当前角色是否开启，如果关闭，则属于当前角色都不可用', '', '', '', [1=>'开启', '2'=>'关闭'], '1')->
                builderFormSchema('sex', '性别', 'radio', '', '', '', '', '', [1=>'男', '2'=>'女', '3'=>'未知'], '3')->
                builderFormSchema('birthday', '生日', 'date')->
                builderFormSchema('face', '头像', 'image')->
                builderConfirmBotton('确认', url('admin/userinfo/add'), 'btn btn-success')->
                builderAdd();
    }

    /**
     * 添加会员
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postAdd(UserInfoRequest $request){
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        //写入数据
        $affected_number = UserInfoModel::create($data);

        return $affected_number->id > 0 ? $this->response(200, trans('response.add_success'), [], true, url('admin/userinfo/index')) : $this->response(400, trans('response.add_error'), [], true);
    }
}
