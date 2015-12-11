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
use App\Model\Admin\Goods\Order\OrderInfo\OrderInfoModel AS GoodsOrderInfoModel;
use App\Model\Admin\Goods\Order\OrderInfo\OrderGoodsModel;

class Email
{
    const NANTA_SEAT_1 = 1;
    const NANTA_SEAT_2 = 2;

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
        $order_info = GoodsOrderInfoModel::findOrFail($order_id);

        if (!empty($order_info)) {
            //组合订单商品信息
            $order_info->options    = OrderGoodsModel::getOrderGoods($order_id);
            //组合订单信息
            $order_info->is_host    = $is_host;
            $order_info->is_cancel  = $is_cancel;
            //组合订单信息
            //$order_info = self::mergeOrderOption($option, $order_info);
        }
        return self::getEmailContents($order_info, $is_host, $is_cancel);
    }

    /**
     * 组合图片选项信息
     *
     * @param $order_goods_option
     * @param $order_info
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function mergeOrderOption($order_goods_option, $order_info)
    {
        if (!empty($order_goods_option) && !empty($order_info)) {

            $order_info->goods_id = $order_goods_option[0]->size_id;//商品id
            $order_info->goods_type = $order_goods_option[0]->category_id;//商品分类id

            $option_prices      = [];//商品价格(人民币)
            $options_name       = [];//选项中文名称
            $options_name_kr    = [];//选项韩文名称

            foreach ($order_goods_option as $option) {

            //没有做
//            $option_cnts[] = $option_row->option_cnts;
//            $order_rows[0]->option_cnts = $option_cnts;

                $option_prices[]    = $option->price_sales;
                $options_name[]     = $option->size_name;
                $options_name_kr[]  = $option->size_name_kr;

                //没有做
//                if($option_row->reserve_id_view==''){ //no pin
//                    $option_reserve_ids[] = $order_rows[0]->reserve_id;
//                    $order_rows[0]->option_reserve_ids = $option_reserve_ids;
//                    $order_rows[0]->reserve_id_view = $order_rows[0]->reserve_id;
//                } else{
//                    $option_reserve_ids[] = $option_row->reserve_id_view;
//                    $order_rows[0]->option_reserve_ids = $option_reserve_ids;
//                    $order_rows[0]->reserve_id_view = $option_row->reserve_id_view;
//                }

                if($order_info->is_need_date == '1'){
                    $order_info->start_date = $option->date_start;
                } elseif ($order_info->goods_type == '3') { // for egg
                    if (isset($option->date_start)) {
                        $order_info->start_date = $option->date_start;
                    }
                    if (isset($option->date_end)) {
                        $order_info->end_date = $option->date_end;
                    }
                }

            }
            $order_info->options = $order_goods_option;
//            $order_info->option_prices  = $option_prices;//选项价格(人民币)
//            $order_info->options        = $options_name;//选项中文名称
//            $order_info->options_kr     = $options_name_kr;//选项韩文名称

            if( $order_goods_option[0]->is_send_email == '0'){
                $order_info->email_sent = 'n';
            } else{
                //send mail later (in 24 hours)
                $order_info->email_sent = 'y';
            }

            if ($order_info->is_refund == 0) {
                $order_info->refund = false;
            } elseif (isset($order_info->refund_date_due)) {
                $cancel_due     = new \DateTime($order_info->refund_date_due, new \DateTimeZone('Asia/Shanghai'));
                $converted_due  = $cancel_due->setTimezone(new \DateTimeZone(config('app.timezone')))->format("Y-m-d H:i:s");
                $current_dtm    = date('Y-m-d H:i:s');

                if ($converted_due <= $current_dtm) {
                    $order_info->refund = false;
                } else {
                    $order_info->refund = true;
                }
            } else {
                $order_info->refund = true;
            }

            $order_info->result = 'success';
        }

        return $order_info;
    }



    /**
     * 获得email html 内容
     *
     * @param $order_id
     * @param $is_host
     * @param $is_cancel
     * @param null $order_id_overwrite
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function getEmailContents($order_info, $is_host, $is_cancel, $order_id_overwrite = null)
    {
//        //组合订单 overwrite 信息
//        $order_info                         = self::mergeOrderOverwrite($order_id_overwrite, $order_info);
//        //组合订单 option
//        //$order_info->options                = self::mergeOrderOpation($order_info, $order_id_overwrite);
//        //组合订单 egg_time 时间信息
//        $order_info                         = self::mergeEggTime($order_info);
//        //初始化订单备注
//        $order_info->remark                 = '';
//        //组合订单信息
//        $order_info                         = self::mergeOrderGoodsFields($order_info);
//        //组合订单酒店信息
//        $order_info                         = self::mergOrderHotelInfo($order_info);
//        //组合订单取消信息
//        $order_info                         = self::mergeOrderCancel($order_info, $is_cancel);
//        $order_info->user_infos             = json_decode($order_info->user_infos);
//        $order_info->required_field_rows    = (object)$order_info->required_field_rows;
//
//        //组合商品信息
//        if( in_array($order_info->size_id, [84, 168] ) ){
//            $order_info = self::mergeGoodsInfo($order_info);
//        }

        return self::getView($order_info, $is_host);
    }

    /**
     * 组合订单 option 信息
     *
     * @param $order_info
     * @param $order_id_overwrite
     * @return array
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function mergeOrderOpation($order_info, $order_id_overwrite)
    {
        $options    = [];
        $option_all = 0;

        for ($i = 0; $i < (count($order_info->options)); $i++) {

            $item = [];

            if(isset($order_id_overwrite)) {
                $item['option_reserve_id'] = str_replace(",", "<br>", $order_id_overwrite);
            } else {
                $item['option_reserve_id'] = str_replace(",", "<br>", $order_info['option_reserve_ids'][$i]);
            }

            $item['name']       = $order_info->options[$i];
            $item['name_kr']    = $order_info->options_kr[$i];
            $item['count']      = $order_info->option_cnts[$i];
            $item['price']      = $order_info->option_prices[$i];
            $option_all         += $order_info->option_prices[$i];

            array_push($options, $item);
        }
        return $options;
    }

    /**
     * 组合订单 overwrite 信息
     *
     * @param $order_id_overwrite
     * @param $order_info
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function mergeOrderOverwrite($order_id_overwrite, $order_info)
    {
        if (isset($order_id_overwrite)) {
            $order_info->reserve_id_view = $order_id_overwrite;
        }
        return $order_info;
    }

    /**
     * 组合订单 egg_time 时间信息
     *
     * @param $order_info
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function mergeEggTime($order_info)
    {
        $order_info->egg_time   = isset($order_info->start_date) && isset($order_info->end_date) ? $order_info->start_date.' ~ '.$order_info->end_date : '';
        return $order_info;
    }

    private static function mergeOrderGoodsType($order_info)
    {
        //$order_info->goods_type = $order_info->
    }

    /**
     * 组合订单酒店信息
     *
     * @param $order_info
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function mergOrderHotelInfo($order_info)
    {
        $hotelnow_id_arr = [147, 149, 151, 153, 155];

        if(in_array($order_info->size_id, $hotelnow_id_arr)){
            $order_info->is_hotelnow = true;
        } else {
            $order_info->is_hotelnow = false;
        }
        return $order_info;
    }

    /**
     * 组合订单取消信息
     *
     * @param $order_info
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function mergeOrderCancel($order_info, $is_cancel)
    {
        $order_info->is_cancel = $is_cancel;

        if($is_cancel){
            $order_info->color = '#183c65';
        } else {
            $order_info->color = '#1076bc';
        }

        return $order_info;
    }

    /**
     * 组合订单信息
     *
     * @param $goods_fields
     * @param $order_info
     * @return mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function mergeOrderGoodsFields($order_info)
    {
        if (!empty($order_info->goods_fields)) {
            foreach ($order_info->goods_fields as $fields ) {

                if ( !isset($fields->name) ) {
                    continue;
                }

                switch ( $fields->name ) {
                    case '取消退款':
                    case '주의사항':
                        $order_info->warning        = $fields->contents;
                        break;
                    case '투어일정소개':
                        $order_info->tour_plan      = DB::select("select * from product_email_field where parent_id='{$fields['id']}' ");
                        break;
                    case '티켓수령안내':
                    case '수령방법':
                        $order_info->ticket_get     = $fields->contents;
                        break;
                    case '찾아가는길':
                        $order_info->howtogo        = $fields->contents;
                        break;
                    case '환불정책':
                    case '취소정책':
                        $order_info->refund_policy  = $fields->contents;
                        break;
                }
            }
        }
        return $order_info;

    }

    /**
     * 组合订单商品信息
     *
     * @param $good_id
     * @param $order_info
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function mergeGoodsInfo($order_info)
    {
        // nanta param
        $nanta_types    = ['PRE席', 'VIP席', 'S席', 'A席'];
        $checked        = [0, 0, 0, 0];
        $nanta_seat     = ['', '', '', ''];
        $remark         = '';

        foreach ($order_info->options as $idx => $value) {

            if( !isset($order_info->nanta_show_time) ) {

                $pattern    = '/[0-9]{2}:[0-9]{2}/';
                $reg_rslt   = preg_match($pattern, $value['name'], $match);

                if($reg_rslt > 0){
                    $order_info->nanta_show_time = $match[0];
                } else {
                    $order_info->nanta_show_time = '20:00';
                }
            }

            for($i = 0; $i < count($nanta_types); $i++) {
                if (strstr($value['name'], $nanta_types[$i]) != false) {
                    $checked[$i] = 1;
                    $remark     .= substr($nanta_types[$i], 0, 1).$value['count'].' ';
                    break;
                }
            }
        }

        for($i = 0; $i < count($checked); $i++) {
            $nanta_seat[$i] = self::getNantaSeat($checked[$i], $nanta_types[$i]);
        }

        $order_info->nanta_seat    = $nanta_seat;
        $order_info->nanta_remark  = $remark;

        return $order_info;
    }

    /**
     * 获得 nanta_seat 图片地址
     *
     * @param $type
     * @return string
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function getNantaSeat($type, $nanta_types)
    {
        switch ($type) {
            case self::NANTA_SEAT_1:
                return "http://s3.zaiseoul.com/image/travel_goods/84/images/class_".strtolower(mb_substr($nanta_types, 0, -1))."_check.png";
            default :
                return "http://s3.zaiseoul.com/image/travel_goods/84/images/20150514/images/class_".strtolower(mb_substr($nanta_types, 0, -1)).".png";
        }
    }

    /**
     * 获得 邮件视图
     *
     * @param $order_info
     * @param $is_host
     * @return \Illuminate\View\View
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function getView($order_info, $is_host)
    {
        switch ($order_info->goods_type) {
            case 2:
                $mid_str = "tour";
                break;
            case 1:
                $mid_str = "ticket";
                break;
            case 3:
                $mid_str = "egg";
                break;
            case 4:
                $mid_str = "prepay";
                break;
            default :
                $mid_str = "special";
                break;
        }

        //获得邮件模板
        $view_str = self::getTemplate($is_host, $mid_str);

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
     * @param $mid_str
     * @return string
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    private static function getTemplate($is_host, $mid_str)
    {
        if ($is_host) {
            return 'emails.admin.order.host';
        } else {
            return 'emails.admin.order.email';
        }
    }


}