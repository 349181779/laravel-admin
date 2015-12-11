<?php

// +----------------------------------------------------------------------
// | date: 2015-11-27
// +----------------------------------------------------------------------
// | Email.php: 邮件
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace App\Library;

use App\Model\Admin\Order\OrderInfo\OrderInfoModel AS HotelOrderInfoModel;
use App\Model\Admin\Order\OrderInfo\OrderRoomModel;
use App\Model\Admin\Hotel\HotelInfoModel;
use App\Model\Admin\Hotel\HotelAroundModel;
use App\Model\Admin\Goods\Order\OrderInfo\OrderInfoModel AS GoodsOrderInfoModel;
use App\Model\Admin\Goods\Order\OrderInfo\OrderGoodsModel;
use App\Model\Admin\Order\MergeModel;

class Email
{
    /**
     * 获得商品订单 邮件内容
     *
     * @param $order_id
     * @param int $is_host
     * @param int $is_cancel
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getGoodsEmailContents($order_id, $is_host = 0, $is_cancel = 0)
    {
        return self::getViewForGoods( self::getEmailDataForGoods($order_id, $is_host, $is_cancel) );
    }

    /**
     * 获得邮件数据
     *
     * @param $order_id
     * @param int $is_host
     * @param int $is_cancel
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getEmailDataForGoods($order_id, $is_host = 0, $is_cancel = 0)
    {
        $order_info = GoodsOrderInfoModel::findOrFail($order_id);

        if (!empty($order_info)) {
            //组合订单商品信息
            $order_info->options    = OrderGoodsModel::getOrderGoods($order_id);
            //组合订单信息
            $order_info->is_host    = $is_host;
            $order_info->is_cancel  = $is_cancel;
        }
        return $order_info;
    }

    /**
     * 获得 邮件视图
     *
     * @param $order_info
     * @return \Illuminate\View\View
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function getViewForGoods($order_info)
    {
        //获得邮件模板
        $view_str = self::getTemplateForGoods($order_info->is_host);

        //判断视图是否存在
        if(\View::exists( $view_str.'_'. $order_info->size_id )){
            $contents = view($view_str . '_' . $order_info->size_id, $order_info);
        } else {
            $contents =  view($view_str, $order_info);
        }
        return $contents;
    }

    /**
     * 获得邮件模板
     *
     * @param $is_host
     * @return string
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getTemplateForGoods($is_host)
    {
        if ($is_host) {
            return 'emails.admin.order.goods.host';
        } else {
            return 'emails.admin.order.goods.email';
        }
    }

    /**
     * 获得酒店订单 邮件内容
     *
     * @param $order_id
     * @param int $is_host
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getHotelEmailContents($order_id, $is_host = 0)
    {
        return self::getViewForHotel( self::getEmailDataForHotel($order_id, $is_host) );
    }

    /**
     * 获得邮件数据
     *
     * @param $order_id
     * @param int $is_host
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getEmailDataForHotel($order_id, $is_host = 0)
    {
        $order_info = HotelOrderInfoModel::findOrFail($order_id);

        if (!empty($order_info)) {
            //组合订单房间信息
            $order_info->options        = OrderRoomModel::getOrderRoom($order_info->id);
            //组合入住天数
            $order_info->date_number    = MergeModel::mergeOrderTotelDay($order_info->info_date_start, $order_info->info_date_end);
            //组合酒店信息
            $order_info->hotel_info     = HotelInfoModel::getHotelInfo($order_info->hotel_id);
            //组合酒店周边信息
            $order_info->traffic        = HotelAroundModel::getHotelTraffic($order_info->hotel_id);
            //组合订单信息
            $order_info->is_host        = $is_host;
        }
        return $order_info;
    }

    /**
     * 获得 邮件视图
     *
     * @param $order_info
     * @return \Illuminate\View\View
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function getViewForHotel($order_info)
    {
        //获得邮件模板
        $view_str = self::getTemplateForHotel($order_info->is_host);
        //dd($order_info->toArray());
        //判断视图是否存在
        if(\View::exists( $view_str.'_'. $order_info->size_id )){
            $contents = view($view_str . '_' . $order_info->size_id, $order_info);
        } else {
            $contents =  view($view_str, $order_info);
        }
        return $contents;
    }

    /**
     * 获得邮件模板
     *
     * @param $is_host
     * @return string
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getTemplateForHotel($is_host)
    {
        if ($is_host) {
            return 'emails.admin.order.hotel.host';
        } else {
            return 'emails.admin.order.hotel.email';
        }
    }


    /**
     * 发送邮件
     *
     * @param $to
     * @param $title
     * @param $template
     * @param $data
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function sendEmail($to, $title, $template, $data)
    {
        return \Mail::send($template, $data->toArray(), function($message) use($to, $title){
            $message->to($to)->subject($title);
        }) == 1 ? true : false;
    }

}