<?php

// +----------------------------------------------------------------------
// | date: 2015-09-15
// +----------------------------------------------------------------------
// | JpushController.php: 后端极光推送控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use \DB;
use App\Library\Jpush;
use JPush\Model as M;
use Maatwebsite\Excel\Facades\Excel;

class JpushController extends BaseController
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
     * 推送
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getIndex()
    {
        //全部城市
        $all_city = config('config.city_ids');

        return  $this->html_builder->
                builderTitle('推送信息')->
                builderFormSchema('alert', '通知内容')->
                builderFormSchema('type', '消息类型', 'radio', '', '', '', '', '', ['1' => '下午茶首页', '2' => '蛋糕首页'], 1)->
                builderFormSchema('platform[]', '设备', 'checkbox', '', '', '', '', '', ['ios' => 'ios', 'android' => 'android'], ['ios', 'android'])->
                builderFormSchema('city_id[]', '城市id', 'checkbox', '', '', '', '', '', $all_city, array_keys($all_city))->
                builderConfirmBotton('确认', createUrl('Admin\JpushController@postPush'), 'btn btn-success')->
                builderEdit();
    }

    /**
     * 处理推送
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postPush(Request $request)
    {
        $city_ids = $request->get('city_id');

        if(count($city_ids) == count(config('config.city_ids'))){
            $audience = 'all';
        }else{
            $audience = M\audience(M\alias($city_ids));
        }

        $status = Jpush::push($request->get('alert'), $request->get('type'), $request->get('platform'), $audience);

        return $status == true ? $this->response(self::SUCCESS_STATE_CODE, trans('response.push_success'), [], false) : $this->response(self::ERROR_STATE_CODE, trans('response.push_error'), [], false);
    }

    /**
     * 批量推送会员
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getPushToUser()
    {
        return  $this->html_builder->
                builderTitle('批量推送会员')->
                builderFormSchema('alert', '通知内容')->
                builderFormSchema('type', '消息类型', 'radio', '', '', '', '', '', ['1' => '下午茶首页', '2' => '蛋糕首页'], 1)->
                builderFormSchema('user_type', '类型', 'radio', '', '', '', '', '', ['1' => '会员id', '2' => '会员名称'], 1)->
                builderFormSchema('file_name', '选择文件', 'file')->
                builderConfirmBotton('确认', createUrl('Admin\JpushController@postPushToUser'), 'btn btn-success')->
                builderEdit();
    }

    /**
     * 处理批量推送会员
     *
     * @param Request $request
     * @param Excel $excel
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postPushToUser(Request $request, Excel $excel)
    {
        $alert      = $request->get('alert');
        $type       = $request->get('type', 1);
        $user_type  = $request->get('user_type', '2');


        //加载excel
        $excel::selectSheetsByIndex(0)->load($_FILES["file_name"]["tmp_name"], function($reader) use($alert, $type, $user_type) {
            //获得数据
            $data = $reader->get()->toArray();

            if (!empty($data)) {

                foreach ($data as $v) {
                    $user = trim($v[0]);

                    if ($user) {
                        if ($user_type == 1) {
                            $registration_id = DB::table('message_push')->where('user_id', '=', $user)->pluck('registration_id');
                        } else {
                            $registration_id =  DB::table('message_push AS m')->
                                                join('user_info AS u', 'm.user_id', '=', 'u.id')->
                                                where('u.loginname', '=', $user )->
                                                pluck('registration_id');
                        }

                        if (!empty($registration_id)) {
                            Jpush::push($alert, $type, 'all', M\audience(M\registration_id([$registration_id])) );
                        } else {
                            continue;
                        }
                    }
                }
                return true;
            }
            return false;
        });
    }
}
