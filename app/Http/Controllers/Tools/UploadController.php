<?php

// +----------------------------------------------------------------------
// | date: 2015-06-28
// +----------------------------------------------------------------------
// | UploadController.php: 上传控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\BaseController;
use App\Http\Requests;
use Storage;
use DB;
use Yangyifan\Upload\Upload;
use Yangyifan\Upload\Qiniu\Upload as Qiniu;

class UploadController extends BaseController
{

    /**
     * 构造方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct(Upload $upload, Qiniu $qiniu)
    {
        $this->upload           = $upload;
        $this->upload->drive    = $qiniu;//选择上传引擎
    }

    /**
     * 测试上传
     *
     */
    public function getIndex()
    {
        var_dump($this->upload->write('bb.txt' ,'bb'));
    }

}
