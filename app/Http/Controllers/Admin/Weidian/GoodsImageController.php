<?php

// +----------------------------------------------------------------------
// | date: 2016-03-18
// +----------------------------------------------------------------------
// | GoodsSKUController.php: 微店商品SKU控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Admin\Weidian;

use App\Http\Controllers\Admin\HtmlBuilderController;
use App\Model\Admin\Weidian\GoodsDescModel;
use Illuminate\Http\Request;
use App\Model\Admin\Weidian\GoodsSKUModel;
use App\Model\Admin\Weidian\CategoryModel;
use App\Model\Admin\Weidian\GoodsImageModel;
use App\Http\Requests\Admin\Weidian\GoodsRequest;
use App\Http\Requests\Admin\Weidian\DeleteGoodsRequest;
use App\Model\Admin\MergeModel;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

class GoodsImageController extends BaseController
{
    /**
     * 构造方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 上传商品图片页面
     *
     * @param Request $request
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getUploadImage(Request $request)
    {
        //商品 id
        $goods_id = intval($request->get('goods_id'));

        return view('admin.weidian.goods_images.image', [
            'title'             => '商品图片',
            'goods_id'          => $goods_id,
            'image_arr'         => GoodsImageModel::getGoodsImage($goods_id),
        ]);
    }

    /**
     * 获得批量上传弹出框
     *
     * @return \Illuminate\View\View
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getUploadView(Request $request)
    {
        return View('admin.image.upload_view', [
            'title'             => trans('shop.image_title1'),
            'id'                => intval($request->get('id')),//id
            'input_name'        => GoodsImageModel::INPUT_NAME,//表单名称
            'upload_url'        => createUrl('Admin\Weidian\GoodsImageController@postUpload'),//上传地址
        ]);
    }

    /**
     * 处理批量上传文件
     *
     * @param Request $requests
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postUpload(Request $request)
    {
        try {
            $file                   = $request->file(GoodsImageModel::INPUT_NAME);
            $fields['access_token'] = $this->token;

            //图像
            $dir_path   = storage_path('upload/goods_image/');
            $file_name  = $file->getClientOriginalName();

            $file->move($dir_path, $file_name);

            if(version_compare(phpversion(),'5.5.0') >= 0 && class_exists('CURLFile')){
                $fields['media'] = new \CURLFile($dir_path . $file_name);
            }else{
                $fields['media'] = '@'. $dir_path. $file_name;//加@符号curl就会把它当成是文件上传处理
            }

            //发送数据
            $data = $this->parseResponse(curlPost(self::GET_UPLOAD_IMAGE_URL, $fields));

            if ($data !== false) {
                //删除原文件
                unlink($dir_path . $file_name);

                //更新数据库
                if (GoodsImageModel::updateImageToShop($data, $request->get('_id'))) {
                    return $this->response(self::SUCCESS_STATE_CODE, trans('response.update_success'));
                }
            }
        } catch(\Exception $e) {

        } catch (FileException $e) {

        }
        return $this->response(self::ERROR_STATE_CODE, trans('response.update_error'));
    }

    /**
     * 更新商品图片到数据库
     *
     * @param $image_name
     * @param $request
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function updateDatabase($image_name, $request)
    {

    }
}
