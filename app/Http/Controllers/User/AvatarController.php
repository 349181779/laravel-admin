<?php

// +----------------------------------------------------------------------
// | date: 2015-09-04
// +----------------------------------------------------------------------
// | AvatarController..php: 用户头像控制器
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Http\Controllers\User;

use App\Http\Requests;

use Illuminate\Http\Request;

use App\Model\User\AvatarModel;

use \Storage;

class AvatarController extends BaseController {

    private $disk;//获得硬盘
    private $image;//头像
    private $clientOriginalName;//文件原始名称
    private $user_avatar_prefix;

    /**
     * 构造方法
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function __construct(){
        parent::__construct();
        $this->disk = Storage::disk('qiniu');//获得一块硬盘

        //加载函数库
        load_func('common');
        //设置会员头像保存路径
        $this->user_avatar_prefix = '/avatar/' . is_user_login() . '/';
    }

    /**
     * 更新用户头像
     *
     * @param Requests $requests
     * @author yangyifan <yangyifanphp@gmail.com>
     */
	public function postUploadUserAvatar(Request $requests){
        //检测是否上传图片
        if ($requests->hasFile('image')){
            $this->image = $requests->file('image');

            if($this->image->isValid()){

                //获得文件原始名称
                $this->clientOriginalName = $this->image->getClientOriginalName();

                //上传头像
                $this->image->move('./', $this->clientOriginalName);
                //用户头像地址
                $user_real_avatar = $this->user_avatar_prefix . $this->clientOriginalName;

                if($this->disk->put($user_real_avatar, file_get_contents($this->clientOriginalName))){
                    @unlink($this->clientOriginalName);
                    //保存用户头像
                    if(AvatarModel::saveUserAvatar($this->clientOriginalName) == true){
                        $this->response(200, trans('response.upload_avatar_success'), AvatarModel::getUserRealAvatar($this->clientOriginalName));
                    }

                }
            }
        }
        $this->response(400, trans('response.upload_avatar_error'));
    }

    /**
     * 创建目录
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private function createAratarDir(){
        if(!file_exists('./Uploads/Avatar/')){
            mkdir('./Uploads/Avatar/', 0777);
        }
        return true;
    }

}
