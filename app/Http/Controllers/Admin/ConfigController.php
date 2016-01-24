<?php

// +----------------------------------------------------------------------
// | date: 2015-07-09
// +----------------------------------------------------------------------
// | ConfigController.php: 后端网站设置控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin;

use App\Http\Requests;

use Illuminate\Http\Request;

use App\Model\Admin\ConfigModel;

use DB;

class ConfigController extends BaseController {

    protected $html_builder;

    /**
     * 构造方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct(HtmlBuilderController $html_builder){
        parent::__construct();
        $this->html_builder = $html_builder;
    }

	/**
	 * 网站配置
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(){
          return $this->html_builder->builderTabSchema(
                    $this->html_builder->
                    builderTitle('基本设置')->
                    builderFormSchema('site_name', '网站名称')->
                    builderFormSchema('keywords', '关键字', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'e', $err_message = '', $option = '', $option_value_schema = '')->
                    builderFormSchema('description', '网站描述', $type = 'text', $default = '',  $notice = '', $class = '', $rule = 'e', $err_message = '', $option = '', $option_value_schema = '')->
                    builderConfirmBotton('确认', url('admin/config/edit'), 'btn btn-success')->
                    builderEditData(ConfigModel::getAll())
                )->builderTabHtml();
	}

    /**
     * 更新网站配置项
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postEdit(Request $request){
        $data   = $request->all();

        if(!empty($data)){
            foreach($data as $k=>$v){
                DB::table('config')->where('name', '=', $k)->update(['value' => $v]);
            }
        }

        //更新成功
        return $this->response(200, trans('response.update_success'), [], false, url('admin/config/index'));
    }




}
