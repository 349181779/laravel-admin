<?php

// +----------------------------------------------------------------------
// | date: 2015-06-06
// +----------------------------------------------------------------------
// | BaseController: 基础控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------


namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Response;
use App\Model\Admin\BaseModel;

class BaseController extends Controller
{

    const SUCCESS_STATE_CODE    = 200;//成功状态码
    const ERROR_STATE_CODE      = 400;//失败状态码
    const REDIRECT_STATE_CODE   = 302;//跳转状态码

    /**
     * 构造方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct(){
        //开启sql调试
        \DB::connection()->enableQueryLog();
        //设置语言
        $this->setLocale();
    }

    /**
     * 响应
     *
     * @param $code     状态码
     * @param $msg      提示文字
     * @param $data     数据
     * @param $target   是否跳转到新页面
     * @prams $href     跳转的网址
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function response($code = self::SUCCESS_STATE_CODE, $msg = '', $data = [], $target = true, $href = '')
    {
        return (new Response($this->responseContent($code, $msg , $data , $target, $href), 200));die;
    }

    /**
     * 获得 响应内容
     *
     * @param int $code
     * @param string $msg
     * @param array $data
     * @param bool|true $target
     * @param string $href
     * @return string
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function responseContent($code = self::SUCCESS_STATE_CODE, $msg = '', $data = [], $target = true, $href = '')
    {
        return json_encode(compact('code', 'msg', 'data', 'target', 'href'));
    }

    /**
     * 设置语言
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function setLocale()
    {
        $locale = \Request::cookie('locale');
        $locale = !empty($locale) ? $locale : 'zh';
        \App::setLocale($locale);
        //设置模型语言
        is_null(BaseModel::$locale) && BaseModel::$locale = $locale;
    }

}
