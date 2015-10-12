<?php

// +----------------------------------------------------------------------
// | date: 2015-10-02
// +----------------------------------------------------------------------
// | ShopUserInfoObserver.php: 门店用户观察者
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Observer;

use App\Model\Admin\Goods\Shop\ShopUserInfoModel;

class ShopUserInfoObserver
{

    /**
     * 新增门店用户模型时，操作密码
     *
     * @param $model
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function created($model)
    {
        if (!empty($_POST['user_info']['password']) && $_POST['user_info']['password'] == $_POST['user_info']['repassword']){
            ShopUserInfoModel::multiwhere(['shop_id' => $model->id])->update([
                'password'     => md5($_POST['user_info']['password']),
            ]);
        }
    }

    /**
     * 更新门店用户模型时，操作密码
     *
     * @param $model
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function updated($model)
    {
        if (!empty($_POST['user_info']['password']) && $_POST['user_info']['password'] == $_POST['user_info']['repassword']){
            ShopUserInfoModel::multiwhere(['shop_id' => $model->id])->update([
                'password'     => md5($_POST['user_info']['password']),
            ]);
        }
    }

}