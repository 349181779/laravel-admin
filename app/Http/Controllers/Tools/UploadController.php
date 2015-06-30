<?php

// +----------------------------------------------------------------------
// | date: 2015-06-28
// +----------------------------------------------------------------------
// | UploadController.php: 上传控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\Tools;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Storage;

class UploadController extends Controller {

    private $disk;//获得硬盘
    private $file;//上传文件
    private $clientOriginalName;//文件原始名称

    const IMAGE_GREP = 'imageView2/0/w/500/h/500/format/jpg/interlace/1';//图片处理管道
    const VIDEO_GREP = '';//视频处理管道
    const AUDIO_GREP = '';//音频处理管道

	/**
	 * 上传
	 *
	 * @return Response
	 */
	public function getIndex(){
        return View('upload');
	}


    public function getUploadview(){
        return View('uploadview');
    }

    /**
     * 上传文件
     *
     * @param Request $requests
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    public function postUpload(Request $requests){
        if ($requests->hasFile('file')){
            $this->file = $requests->file('file');
            if($this->file->isValid()){

                $this->disk = Storage::disk('qiniu');//获得一块硬盘
                $this->clientOriginalName = $this->file->getClientOriginalName();//获得文件原始名称

                $this->file->move('./', $this->clientOriginalName);
                if($this->disk->put($this->clientOriginalName, file_get_contents($this->clientOriginalName))){
                    @unlink($this->clientOriginalName);
                    $this->handle();
                }
            }else{
                echo $this->file->getErrorMessage();
            }

        }
    }

    /**
     * 处理文件公共方法
     */
    private function handle(){
        $type       = null;
        $mime_type  = $this->file->getClientMimeType();
        $mime_array = [
            'image' => [
                'handle'    => 'handleImage',
                'values'    => [
                    'image/gif',
                    'image/jpeg',
                    'image/jpeg',
                    'image/jpeg',
                ],
            ],
            'video' => [
                'handle'    => 'handleVideo',
                'values'    => [
                    'video/x-msvideo',
                ],
            ],
            'audio' => [
                'handle'    => 'handleAudio',
                'values'    => [
                    'audio/mpeg',
                    'audio/x-wav',
                ],
            ],
        ];

        foreach($mime_array as $k=>$v){
            if(in_array($mime_type, $v['values'])){
                $this->$v['handle']();
            }
        }

        //抛出异常
        if($type === null) return false;
    }

    /**
     * 处理图片公共方法
     *
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    private function handleImage(){
        $ops[] = 'imageView2/0/w/500/h/500/format/jpg/interlace/1';//图片处理管道
        $ops[] = 'imageView2/5/w/235/h/225/format/jpg/interlace/1' ;//转码成235*225宽高的jpg图片
        $ops[] = 'imageView2/5/w/400/h/400/format/jpg/interlace/1' ;//转码成400*400宽高的jpg图片
        //执行持久化数据处理
        $persistent_fop_id = $this->persistentFop($ops);
    }

    /**
     * 处理视频公共方法
     *
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    private function handleVideo(){
        //加载函数库
        load_func('common');
        $ops[] = 'avthumb/mp4/vb/1m/s/640x480/autoscale/1/wmImage/' . safe_base64_encode(config('config.site_logo')) . '/Gravity/NorthEast';       //转码成标清MP4
        $ops[] = 'avthumb/mp4/vb/1.2m/s/960x720/autoscale/1/wmImage/' . safe_base64_encode(config('config.site_logo')) . '/Gravity/NorthEast';       //转码成高清MP4
        $ops[] = 'avthumb/mp4/vb/1.5m/s/1440x1080/autoscale/1/wmImage/' . safe_base64_encode(config('config.site_logo')) . '/Gravity/NorthEast';       //转码成全高清MP4
        $ops[] = 'vframe/jpg/offset/10/w/1022/h/501';//视频截图
        $persistent_fop_id = $this->persistentFop($ops);
    }

    /**
     * 处理音频公共方法
     *
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    private function handleAudio(){
        $ops[] = 'avthumb/mp3/ab/192k/aq/0/ar/8000';//转码成192k
        $ops[] = 'avthumb/mp3/ab/256k/aq/0/ar/22050';//转码成256k
        $ops[] = 'avthumb/mp3/ab/320k/aq/0/ar/22050';//转码成320k
        $persistent_fop_id = $this->persistentFop($ops);
    }

    /**
     * 执行持久化数据处理
     *
     * @param $ops
     * @return array
     * @auther yangyifan <yangyifanphp@gmail.com>
     */
    private function persistentFop($ops){
        if(!empty($ops)){
            foreach($ops as $v){
                $persistent_fop_id[] = $this->disk->getDriver()->persistentFop($this->clientOriginalName, $v);
            }
            return $persistent_fop_id;
        }
    }

}
