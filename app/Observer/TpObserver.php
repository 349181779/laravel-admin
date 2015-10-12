<?php

// +----------------------------------------------------------------------
// | date: 2015-09-18
// +----------------------------------------------------------------------
// | TpObserver.php: 第三方物流观察者
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Observer;

use App\Model\Admin\Tp\TpModel;

class TpObserver
{

    /**
     * 新增第三方物流模型时，操作
     *
     * @param $model
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public function created($model)
    {
        $app_id     = TpModel::createAppId();
        $app_key    = TpModel::createAppKey();

        $model::where('id', '=', $model->id)->update([
            'appid'     => $app_id,
            'appkey'    => $app_key,
        ]);
    }

}