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

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Storage;

use DB;

class UploadController extends BaseController {

    private $disk;//获得硬盘
    private $file;//上传文件
    private $clientOriginalName;//文件原始名称


    /**
     * 构造方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct(){
        $this->disk = Storage::disk('qiniu');//获得一块硬盘
    }

	/**
	 * 获得选择文件框
	 *
	 * @return Response
     * @author yangyifan <yangyifanphp@gmail.com>
	 */
	public function getIndex(){
        return View('tools.upload.upload');
	}

    /**
     * 获得上传框
     *
     * @return \Illuminate\View\View
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getUploadview(){
        return View('tools.upload.uploadView');
    }

    /**
     * 上传文件
     *
     * @param Request $requests
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postUpload(Request $requests){
        if ($requests->hasFile('file')){
            $this->file = $requests->file('file');
            if($this->file->isValid()){

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
            'audio' => [
                'handle'    => 'handleAudio',
                'values'    => [
                    'audio/mpeg',
                    'audio/x-wav',
                ],
            ],
            'video' => [
                'handle'    => 'handleVideo',
                'values'    => [
                    'video/x-msvideo',
                    'video/mp4',
                ],
            ],
        ];

        foreach($mime_array as $k=>$v){
            if(in_array($mime_type, $v['values'])){
                $persistent_fop_ids = $this->$v['handle']();

                //如果触发持久化成功，则把当前上传数据写入数据库
                if(!empty($persistent_fop_ids)){
                    $file_types = config('config.file_type');//资源类型
                    if(in_array($k, $file_types)){
                        $current_file_type = array_search($k, $file_types);

                        //操作数据库
                        $id = DB::table(config('table_name.resource_table_name'))->insertGetId([
                            'file_name'         => $this->clientOriginalName,
                            'file_type'         => $current_file_type,
                            'created_at'        => date('Y-m-d H:i:s'),
                        ]);

                        if($id > 0 ){
                            $this->response(200);
                        }
                        //上传失败错误提示
                        $this->response(400,trans('response.upload_file_error'));
                    }
                }
            }
        }

        //抛出异常
        if($type === null) return false;
    }

    /**
     * 处理图片公共方法
     *
     * @return array 触发处理“持久化处理的进程ID”数组几个
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function handleImage(){
        $ops[] = 'imageView2/0/w/500/h/500/format/jpg/interlace/1';//图片处理管道
        $ops[] = 'imageView2/5/w/235/h/225/format/jpg/interlace/1' ;//转码成235*225宽高的jpg图片
        $ops[] = 'imageView2/5/w/400/h/400/format/jpg/interlace/1' ;//转码成400*400宽高的jpg图片
        //执行持久化数据处理
        return $this->persistentFop($ops);
    }

    /**
     * 处理视频公共方法
     *
     * @return array 触发处理“持久化处理的进程ID”数组几个
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function handleVideo(){
        //加载函数库
        load_func('common');
        $ops[] = 'avthumb/mp4/vb/1m/s/640x480/autoscale/1/wmImage/' . safe_base64_encode(config('config.site_logo')) . '/Gravity/NorthEast';       //转码成标清MP4
        $ops[] = 'avthumb/mp4/vb/1.2m/s/960x720/autoscale/1/wmImage/' . safe_base64_encode(config('config.site_logo')) . '/Gravity/NorthEast';       //转码成高清MP4
        $ops[] = 'avthumb/mp4/vb/1.5m/s/1440x1080/autoscale/1/wmImage/' . safe_base64_encode(config('config.site_logo')) . '/Gravity/NorthEast';       //转码成全高清MP4
        $ops[] = 'vframe/jpg/offset/10/w/1022/h/501';//视频截图
        return $this->persistentFop($ops);
    }

    /**
     * 处理音频公共方法
     *
     * @return array 触发处理“持久化处理的进程ID”数组几个
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function handleAudio(){
        $ops[] = 'avthumb/mp3/ab/192k/aq/0/ar/8000';//转码成192k
        $ops[] = 'avthumb/mp3/ab/256k/aq/0/ar/22050';//转码成256k
        $ops[] = 'avthumb/mp3/ab/320k/aq/0/ar/22050';//转码成320k
        return $this->persistentFop($ops);
    }

    /**
     * 执行持久化数据处理
     *
     * @param $ops
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function persistentFop($ops){
        if(!empty($ops)){
            $persistent_fop_ids = [];
            foreach($ops as $v){
                $persistent_fop_id = $this->disk->getDriver()->persistentFop($this->clientOriginalName, $v);

                //引入函数库
                load_func('swoole');

                //写入队列
                $redis = get_redis();
                $redis->rPush(config('queue.queue_name.qiniu_persistentFop'), $persistent_fop_id);

                //发送task
                send_task_to_swoole_server(url('tools/upload/persistent-status'), ['persistent_fop_id'=>$persistent_fop_id], url('tools/upload/persistent-success-callback'));

                array_push($persistent_fop_ids, $persistent_fop_id);
            }
            return $persistent_fop_ids;
        }
    }

    /**
     * 查看持久化数据处理的状态
     *
     * @description
     * [{
     * "code":0,
     * "desc":"The fop was completed successfully",
     * "id":"z0.5593e0cd7823de5a49899df3",
     * "inputBucket":"test",
     * "inputKey":
     * "404page1.jpg",
     * "items":[{"cmd":"imageView2\/0\/w\/500\/h\/500\/format\/jpg\/interlace\/1","code":0,"desc":"The fop was completed successfully","hash":"FtOgVYG5iCkGEYLVZULjh4TcSCPY","key":"XDe2Q5SJ_c60FKdtSCDwNNMILNs=\/Fg398W8DmOEu0o_Q_OB3isc6917H"}],
     * "pipeline":"0.default",
     * "reqid":"d3AAADvcrkBL0-wT"},null]
     * @param $persistent_fop_id
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function getPersistentStatus(Request $request){

        $status = $this->disk->getDriver()->persistentStatus($request->get('persistent_fop_id'));
        if($status[0]['code'] == 0){
            //写入数据库
            $id = DB::table(config('table_name.resource_slave_table_name'))->insertGetId([
                'file_name'             => $status[0]['items'][0]['key'],
                'persistent_fop_id'     => $status[0]['id'],
                'bucket'                => $status[0]['inputBucket'],
                'reqid'                 => $status[0]['reqid'],
                'cmd'                   => $status[0]['items'][0]['cmd'],
                'created_at'            => date('Y-m-d H:i:s'),
            ]);

            if($id > 0 ){
                echo $this->response(200);
            }
            //上传失败错误提示
            echo $this->response(400, trans('response.upload_file_error'));
        }else{
            //引入函数库
            load_func('instanceof,swoole');
            //任务不能标记成功，继续投递当前任务
            send_task_to_swoole_server(url('tools/upload/persistent-status'), ['persistent_fop_id'=>$request->get('persistent_fop_id')], url('tools/upload/persistent-success-callback'));
            echo $this->response(400);
        }
    }


    /**
     * 转码成功回调
     *
     * @param $persistent_fop_id
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function postPersistentSuccessCallback(Request $request){
        //引入函数库
        load_func('instanceof,swoole');

        send_default_to_swoole_server('', ['data'=>$request->get('persistent_fop_id').'转码成功'], '');
    }

}
