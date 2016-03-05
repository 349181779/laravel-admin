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

class UploadController extends BaseController
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
     * 测试上传
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getIndex()
    {
        //测试七牛上传
        //$this->qiniuUpload();

        //测试Upyun上传
        $this->upyunUpload();
    }

    /**
     * 测试Upyun上传
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    protected function upyunUpload()
    {
        $image  = "11/22/33/7125_yangxiansen.jpg";
        $image2 = "/email.png";

        $drive = \Storage::drive('upyun');                                  //选择upyun上传引擎

        //dump($drive->has($image2));                                         //判断文件是否存在
        //dump($drive->listContents('/'));                                    //列出文件列表
        //dump($drive->getSize($image2));                                     //获得图片大小
        //dump($drive->getMimetype($image2));                                 //获得图片mime类型
        //dump($drive->getTimestamp($image2));                                //获得图片上传时间戳
        //dump($drive->rename($image2, 'git.jpg'));                         //重命名文件
        //dump($drive->copy($image2, 'git.bak.jpg'));                       //复制文件
        dump($drive->delete('/sequelpro.dmg'));                              //删除文件
        //dump($drive->deleteDir('/test'));                             //删除文件夹
        //dump($drive->write($image, $drive->read('7125_yangxiansen.jpg')));//上传文件,直接读取七牛远程文件方式
    }

    /**
     * 测试七牛上传
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    protected function qiniuUpload()
    {
        $image  = "11/22/33/7125_yangxiansen.jpg";
        $image2 = "git.jpg";

        $drive = \Storage::drive('qiniu');                                  //选择七牛存储引擎

        //dump($drive->has($image));                                        //判断文件是否存在
        //dump($drive->listContents(''));                                    //列出文件列表
        //dump($drive->getSize($image));                                    //获得图片大小
        //dump($drive->getMimetype($image));                                //获得图片mime类型
        //dump($drive->getTimestamp($image));                               //获得图片上传时间戳
        //dump($drive->rename($image2, 'git.jpg'));                         //重命名文件
        //dump($drive->copy($image2, 'git.bak.jpg'));                       //复制文件
        //dump($drive->delete('git.bak.jpg'));                              //删除文件
        //dump($drive->deleteDir('11/22/33/'));                             //删除文件夹
        //dump($drive->write($image, $drive->read('7125_yangxiansen.jpg')));//上传文件,直接读取七牛远程文件方式

        /**
         *
         * 普通上传
         *
         */

        //设置内存
        ini_set('memory_limit', '1200M');
        //echo ini_get('memory_limit');die;
        $a = microtime(true);

        //分片上传文件
        $file_path = '/tmp/soft1.dmg';//要上传的文件
        $file_name = 'soft1.dmg';//上传后需要命名的文件名称

        dump( $drive->write($file_name, fread(fopen($file_path, 'r'), filesize($file_path))) );
        $b = microtime(true);

        echo $b - $a;

        /**
         *
         * 分片上传
         *
         */
//
//        $a = microtime(true);
//
//        //分片上传文件
//        $file_path = '/tmp/soft1.dmg';//要上传的文件
//        $file_name = 'soft1.dmg';//上传后需要命名的文件名称
//
//        dump( $drive->writeStream($file_name, fopen($file_path, 'r'), ['file_path' => $file_path]) );
//        $b = microtime(true);
//
//        echo $b - $a;
    }

}
