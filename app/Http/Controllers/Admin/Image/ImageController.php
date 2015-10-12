<?php

// +----------------------------------------------------------------------
// | date: 2015-09-26
// +----------------------------------------------------------------------
// | ImageController.php: 图片控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin\Image;

use App\Http\Controllers\BaseController;
use App\Http\Requests;
use Yangyifan\Upload\Upload;
use Yangyifan\Upload\Upyun\Upload as Upyun;
use App\Http\Controllers\Admin\HtmlBuilderController;
use Illuminate\Http\Request;
use App\Model\Admin\Image\ImageModel;

class ImageController extends BaseController
{
    protected   $html_builder;
    private     $file;//上传文件

    /**
     * 构造方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct(Upload $upload, Upyun $upyun, HtmlBuilderController $html_builder)
    {
        parent::__construct();
        $this->upload           = $upload;
        $this->upload->drive    = $upyun;//选择上传引擎
        $this->html_builder     = $html_builder;
    }

    /**
     * 图片列表
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getIndex()
    {
        return  $this->html_builder->
                builderTitle('图片列表')->
                builderSchema('id', 'id')->
                builderSchema('image', '图片')->
                builderSchema('image_name', '图片名称', 'image')->
                builderSchema('image_type', '图片类型', 'image')->
                builderSchema('state', '状态')->
                builderSchema('source', '来源')->
                builderSchema('create_date', '创建时间')->
                builderSchema('handle', '操作')->
                builderSearchSchema($name = 'source', $title = '来源 ', $type = 'select', $default = '', $class = '', $option = ImageModel::mergeImageSourceForSelect(), $option_value_schema = '1', 'name')->
                builderSearchSchema($name = 'image_type', $title = '图片类型', $type = 'select', $default = '', $class = '', $option = ImageModel::mergeImageTypeForSelect(), $option_value_schema = '1', 'name')->
                builderSearchSchema('image_name', '图片名称')->
                builderBotton('上传图片', '', 'icon-arrow-up', ImageModel::uploadJsEvent())->
                builderJsonDataUrl(createUrl('Admin\Image\ImageController@getSearch'))->
                loadScription('/js/image/index.js')->
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
        $search = $request->get('search', '');
        $sort   = $request->get('sort', 'id');
        $order  = $request->get('order', 'DESC');
        $limit  = $request->get('limit', 0);
        $offset = $request->get('offset', config('config.page_limit'));

        //解析params
        parse_str($search);

        //组合查询条件
        $map = [];
        if (!empty($source)) {
            $map['source'] = $source;
        } else {
            $map['source'] = 1;
        }

        if (!empty($image_type)) {
            $map['image_type'] = $image_type;
        } else {
            $map['image_type'] = 1;
        }

        if (!empty($image_name)) {
            $map['image_name'] = ['LIKE', '%'.$image_name.'%'];
        }


        $data = ImageModel::search($map, $sort, $order, $limit, $offset);
        //var_dump(ImageModel::getLastSql());die;
        echo json_encode([
            'total' => $data['count'],
            'rows'  => $data['data'],
        ]);
    }

    /**
     * 获得上传框
     *
     * @return \Illuminate\View\View
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getUploadView()
    {
        return View('admin.image.upload_view', [
            'title'             => '上传文件',
            'all_image_source'  => ImageModel::mergeImageSourceForSelect(),//图片来源
            'all_image_type'    => ImageModel::mergeImageTypeForSelect(),//图片类型
            'upload_url'        => createUrl('Admin\Image\ImageController@postUpload'),//上传地址
        ]);
    }

    /**
     * 上传文件
     *
     * @param Request $requests
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postUpload(Request $requests)
    {
        set_time_limit(0);
        if ($requests->hasFile('file')) {
            $this->file = $requests->file('file');
            if ($this->file->isValid()) {
                //组合文件名称
                $file_name = '/' . $this->file->getClientOriginalName();

                //判断图片是否已经存在
                if (ImageModel::exists($this->file->getClientOriginalName()) == true ) {
                    return $this->response(self::ERROR_STATE_CODE, trans('response.image_exists'));
                }

                $status = $this->upload->write($file_name, $requests->file('file') );

                //上传完成回调
                if ($status > 0 && ImageModel::uploadSuccessCallback($this->file->getClientOriginalName(), $requests->get('source'), $requests->get('image_type')) > 0) {
                    return $this->response(self::SUCCESS_STATE_CODE, trans('response.upload_image_success'));
                }
            } else {
                echo $this->file->getErrorMessage();
            }


        }
        return $this->response(self::ERROR_STATE_CODE, trans('response.upload_image_error'));
    }

    /**
     * 获得选择图片弹出框
     *
     * @return \Illuminate\View\View
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getChoseImage(Request $request)
    {
        return view('admin.image.image_dialog', [
            'title'         => '选择图片',
            'source'        => $request->get('source'),//图片资源
            'image_type'    => $request->get('image_type'),//图片类型
            'get_json_url'  => createUrl('Admin\Image\ImageController@getSearch'),//搜索图片url
        ]);
    }

    public function getTest(){

       var_dump( $this->upload->listFiles('/'));die;
    }

}
