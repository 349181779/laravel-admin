<?php

// +----------------------------------------------------------------------
// | date: 2015-08-15
// +----------------------------------------------------------------------
// | LetterModel.php: 会员私信模型
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Model\User;

use Session;

class LetterModel extends BaseModel {

    protected $table    = 'letter';//定义表名
    protected $guarded  = ['id'];//阻挡所有属性被批量赋值

    public $timestamps = false;//不维护时间


    /**
     * 添加私信
     *
     * @param $send_user_id
     * @param $contents
     * @return bool
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function sendLetter($send_user_id, $contents){
        if($send_user_id > 0){
            $affected_number = self::create([
                'user_info_id'  => is_user_login(),
                'contens'       => $contents,
                'created_at'    => date('Y-m-d'),
                'send_uid'      => $send_user_id,
            ]);

            if($affected_number->id > 0 ) return true;
        }
        return false;
    }

    /**
     * 确认私信已读
     *
     * @param $id
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function updateLetterStatus($id){
        return self::where('id', '=', $id)->update(['status' => 1]);
    }

    /**
     * 获得当前用户全部添加好友私信
     *
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function addFriendLetter(){
        return self::mergeLetter(self::where('type', '=', 1)->where('send_uid', '=', is_user_login())->groupBy('send_uid')->paginate(config('config.letter_page_limit')));
    }

    /**
     * 组合私信内容
     *
     * @param $data
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function mergeLetter($data){
        if(!empty($data)){
            foreach($data as $letter){
                $letter->user_info = UserModel::getUserSimpleInfo($letter->user_info_id);
            }
        }
        return $data;
    }

}
