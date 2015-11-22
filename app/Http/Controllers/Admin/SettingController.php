<?php

// +----------------------------------------------------------------------
// | date: 2015-09-18
// +----------------------------------------------------------------------
// | SettingController.php: 后端商店设置控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Model\Admin\SettingModel;

class SettingController extends BaseController
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
     * 获得商店设置
     *
     * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getIndex()
    {
        return $this->html_builder->builderTabSchema(
            $this->html_builder->
            builderTitle('站点配置')->
            builderFormSchema('1', '运费阀值')->
            builderFormSchema('2', '运费')->
            builderFormSchema('4', '配送天数')->
            builderFormSchema('21', '广告1链接')->
            builderFormSchema('22', '广告1图片')->
            builderFormSchema('23', '广告2链接')->
            builderFormSchema('24', '广告2图片')->
            builderFormSchema('25', '广告3链接')->
            builderFormSchema('26', '广告3图片')->
            builderFormSchema('27', '广告4链接')->
            builderFormSchema('28', '广告4图片')->
            builderFormSchema('29', '广告5链接')->
            builderFormSchema('30', '广告5图片')->
            builderConfirmBotton('确认', createUrl('Admin\SettingController@postAdd'), 'btn btn-success')->
            builderEditData(SettingModel::getSetting())
        )->builderTabSchema(
            $this->html_builder->
            builderTitle('全局站点配置')->
            builderFormSchema('1', '苹果最高版本')->
            builderFormSchema('2', '苹果最低版本')->
            builderFormSchema('11', '安卓最高版本')->
            builderFormSchema('4', '安卓最低版本')->
            builderFormSchema('23', '旺pos门店宝最高版本')->
            builderFormSchema('5', 'APP支付方式')->
            builderFormSchema('3', '配送时间段1')->
            builderFormSchema('6', '配送时间段2')->
            builderFormSchema('7', '配送时间段3')->
            builderFormSchema('13', '配送时间段4')->
            builderFormSchema('14', '配送时间段5')->
            builderFormSchema('15', '配送时间段6')->
            builderFormSchema('16', '苹果商户最高版本')->
            builderFormSchema('17', '安卓商户最高版本')->
            builderFormSchema('18', '苹果配送员最高版本')->
            builderFormSchema('19', '安卓配送员最高版本')->
            builderFormSchema('20', 'app启动广告图')->
            builderFormSchema('21', 'app启动广告图变更（＋1）')->
            builderFormSchema('22', '下午茶全场免邮阀值')->
            builderConfirmBotton('确认', createUrl('Admin\SettingController@postGlobalAdd'), 'btn btn-success')->
            builderEditData(SettingModel::getGlobalSetting())
        )->builderTabHtml();
    }


    /**
     * 处理商店站点配置
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postAdd(Request $request)
    {
        //写入数据
        $affected_number = SettingModel::updateSetting($request->all());
        return  $affected_number === true  ? $this->response(self::SUCCESS_STATE_CODE, trans('response.update_setting_success'), [], false) : $this->response(self::ERROR_STATE_CODE, trans('response.update_setting_error'));
    }

    /**
     * 处理商店全局站点配置
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postGlobalAdd(Request $request)
    {
        //写入数据
        $affected_number = SettingModel::updateGlobalSetting($request->all());
        return  $affected_number === true  ? $this->response(self::SUCCESS_STATE_CODE, trans('response.update_global_setting_success'), [], false) : $this->response(self::ERROR_STATE_CODE, trans('response.update_global_setting_error'));
    }



}
