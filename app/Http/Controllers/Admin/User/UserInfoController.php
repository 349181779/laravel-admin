<?php

// +----------------------------------------------------------------------
// | date: 2015-11-10
// +----------------------------------------------------------------------
// | UserInfoController.php: 用户控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin\User;

use App\Http\Requests;
use App\Model\Admin\User\UserMergeModel;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\User\UserInfoRequest;
use App\Model\Admin\User\UserInfoModel;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Admin\HtmlBuilderController;

class UserInfoController extends BaseController
{

    protected $html_builder;

    /**
     * 构造方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct(HtmlBuilderController $html_builder)
    {
        parent::__construct();
        $this->html_builder = $html_builder;

    }

	/**
	 * 获得前台用户
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex()
    {
        return  $this->html_builder->
                builderTitle('会员列表')->
                builderSchema('id', 'id')->
                builderSchema('email', 'email')->
                builderSchema('mobile','手机')->
                builderSchema('sex', '性别')->
                builderSchema('nickname', '用户昵称')->
                builderSchema('check_email_name', '邮箱验证')->
                builderSchema('check_mobile_name', '手机验证')->
                builderSchema('create_date',  '注册时间')->
                builderSchema('handle', '操作')->
                builderSearchSchema('nickname', '用户昵称')->
                builderSearchSchema('email', '邮箱')->
                builderSearchSchema('mobile', '手机')->
                builderSearchSchema($name = 'check_email', $title = '邮箱是否已验证', $type = 'select', $default = '', $class = '', $option = UserMergeModel::mergeIsCheckUserEmailForSelect(), $option_value_schema = '0', 'name')->
                builderSearchSchema($name = 'check_mobile', $title = '手机是否已验证', $type = 'select', $default = '', $class = '', $option = UserMergeModel::mergeIsCheckUserMobileForSelect(), $option_value_schema = '0', 'name')->
                builderSearchSchema($name = 'create_time_start', $title = '注册时间开始', $type = 'date', $default = "dateFmt:'yyyy-MM-dd'")->
                builderSearchSchema($name = 'create_time_end', $title = '注册时间结束', $type = 'date', $default = "dateFmt:'yyyy-MM-dd'")->
                builderBotton('增加用户', createUrl('Admin\User\UserInfoController@getAdd'))->
                builderJsonDataUrl(createUrl('Admin\User\UserInfoController@getSearch'))->
                builderList();
    }

    /**
     * 搜索
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getSearch(Request $request)
    {
        //接受参数
        $search     = $request->get('search', '');
        $sort       = $request->get('sort', 'id');
        $order      = $request->get('order', 'desc');
        $limit      = $request->get('limit', 0);
        $offset     = $request->get('offset', config('config.page_limit'));

        //解析params
        parse_str($search);

        //组合查询条件
        $map = [];
        if (!empty($loginname)) {
            $map['loginname'] = ['like','%'.$loginname.'%'];
        }
        if (!empty($email)) {
            $map['email'] = ['like','%'.$email.'%'];
        }
        if (!empty($mobile)) {
            $map['mobile'] = ['like','%'.$mobile.'%'];
        }
        if (!empty($check_email)) {
            $map['check_email'] = $check_email;
        }
        if (!empty($check_mobile)) {
            $map['check_mobile'] = $check_mobile;
        }
        if (!empty($sex)) {
            $map['sex'] = $sex;
        }
        if (!empty($birthday)) {
            $map['birthday'] = $birthday;
        }

        if (!empty($create_time_start) && !empty($create_time_end)) {

            $map['create_date'] = ['between', [$create_time_start." 00:00:00", $create_time_end." 23:59:59"]];
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
    public function getEdit(Request $request)
    {

        $user_info = UserInfoModel::getUserInfo($request->get('id'));

        return  $this->html_builder->
                builderTitle('编辑会员')->
                builderFormSchema('email', '电子邮箱', 'text', $default = '',  $notice = '', $class = '', $rule = '')->
                builderFormSchema('mobile','手机号', 'text', $default = '',  $notice = '', $class = '', $rule = '')->
                builderFormSchema('nickname', '用户昵称', 'text', $default = '',  $notice = '', $class = '', $rule = '')->
                builderFormSchema('password', '密码', 'password', $default = '',  $notice = '', $class = '', $rule = '')->
                builderFormSchema('password_confirmation', '确认密码', 'password', $default = '',  $notice = '', $class = '', $rule = '')->
                builderFormSchema('sex', '性别', 'radio', '', '', '', '', '', UserMergeModel::getAllUserSex(), $user_info->sex)->
                builderFormSchema('birthday', '生日', 'text', $default = "dateFmt:'yyyy-MM-dd'",  $notice = '', $class = '', $rule = '')->
                builderFormSchema('check_email', '邮箱验证', 'radio', '', '', '', '', '', UserMergeModel::mergeIsCheckUserEmail(), $user_info->check_email)->
                builderFormSchema('check_mobile', '手机验证', 'radio', '', '', '', '', '', UserMergeModel::mergeIsCheckUserMobile(), $user_info->check_mobile)->
                builderConfirmBotton('确认', createUrl('Admin\User\UserInfoController@postEdit'), 'btn btn-success')->
                builderEditData($user_info)->
                builderEdit();

    }

    /**
     * 处理更新会员
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postEdit(UserInfoRequest $request)
    {
        $data = $request->all();
        $Model = UserInfoModel::findOrFail($data['id']);
        if(empty($data['password'])){
            $data['password'] =$Model->password;
        }else{
            $data['password'] = md5($data['password']);
        }

        $Model->update($request->except('password_confirmation'));

        //更新成功
        return $this->response(self::SUCCESS_STATE_CODE, trans('response.update_success'), [], true,  createUrl('Admin\User\UserInfoController@getIndex'));
    }

    /**
     * 增加会员
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getAdd()
    {
        return  $this->html_builder->
                builderTitle('添加会员')->
                builderFormSchema('nickname', '用户昵称', 'text', $default = '',  $notice = '', $class = '', $rule = '')->
                builderFormSchema('email', '电子邮箱', 'text', $default = '',  $notice = '', $class = '', $rule = '')->
                builderFormSchema('mobile','手机号', 'text', $default = '',  $notice = '', $class = '', $rule = '')->
                builderFormSchema('password', '密码', 'password', $default = '',  $notice = '', $class = '', $rule = '')->
                builderFormSchema('password_confirmation', '确认密码', 'password', $default = '',  $notice = '', $class = '', $rule = '')->
                builderFormSchema('sex', '性别', 'radio', '', '', '', '', '', UserMergeModel::getAllUserSex(), '3')->
                builderFormSchema('birthday', '生日', $type = 'date', $default = "dateFmt:'yyyy-MM-dd'",  $notice = '', $class = '', $rule = '*', $err_message = '', $option = '', $option_value_schema = '')->
                builderFormSchema('check_email', '邮箱验证', 'radio', '', '', '', '', '', UserMergeModel::mergeIsCheckUserEmail(), 2)->
                builderFormSchema('check_mobile', '手机验证', 'radio', '', '', '', '', '', UserMergeModel::mergeIsCheckUserMobile(), 2)->
                builderConfirmBotton('确认', createUrl('Admin\User\UserInfoController@postAdd'), 'btn btn-success')->
                builderAdd();
    }

    /**
     * 添加会员
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postAdd(UserInfoRequest $request)
    {
        $data = $request->all();
        $data['password'] = md5($data['password']);
        //写入数据
        $affected_number = UserInfoModel::create($request->except('password_confirmation'));

        return $affected_number->id > 0 ? $this->response(self::SUCCESS_STATE_CODE, trans('response.add_success'), [], true, createUrl('Admin\User\UserInfoController@getIndex')) : $this->response(self::ERROR_STATE_CODE, trans('response.add_error'), [], true);
    }
}
