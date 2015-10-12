/**
 * Created by anywhere1000 on 15/9/22.
 * Author: zhuweijian <zhuweijain@louxia100.com>
 */

/**
 * 更改type 类型
 *
 * @param type
 */
function changeUrlType(type)
{
    if (type == '') {
        return;
    }

    switch (type){
        case '1':
            $('input[name=search_order_sn]').parents('.form-group').hide();
            $('input[name=search_goods_collection]').parents('.form-group').hide();
            $('input[name=search_goods_name]').parents('.form-group').hide();
            $('input[name=search_coupon_name]').parents('.form-group').hide();
            $('input[name=message_key]').parents('.form-group').hide();
            return;
        case '2':
            $('input[name=search_order_sn]').parents('.form-group').show();
            $('input[name=search_goods_collection]').parents('.form-group').hide();
            $('input[name=search_goods_name]').parents('.form-group').hide();
            $('input[name=search_coupon_name]').parents('.form-group').hide();
            $('input[name=message_key]').parents('.form-group').hide();
            return;
        case '3':
            $('input[name=search_order_sn]').parents('.form-group').hide();
            $('input[name=search_goods_collection]').parents('.form-group').show();
            $('input[name=search_goods_name]').parents('.form-group').hide();
            $('input[name=search_coupon_name]').parents('.form-group').hide();
            $('input[name=message_key]').parents('.form-group').hide();
            return;
        case '4':
            $('input[name=search_order_sn]').parents('.form-group').hide();
            $('input[name=search_goods_collection]').parents('.form-group').hide();
            $('input[name=search_goods_name]').parents('.form-group').show();
            $('input[name=search_coupon_name]').parents('.form-group').hide();
            $('input[name=message_key]').parents('.form-group').hide();
            return;
        case '5':
            $('input[name=search_order_sn]').parents('.form-group').hide();
            $('input[name=search_goods_collection]').parents('.form-group').hide();
            $('input[name=search_goods_name]').parents('.form-group').hide();
            $('input[name=search_coupon_name]').parents('.form-group').show();
            $('input[name=message_key]').parents('.form-group').hide();
            return;
        case '6':
            $('input[name=search_order_sn]').parents('.form-group').hide();
            $('input[name=search_goods_collection]').parents('.form-group').hide();
            $('input[name=search_goods_name]').parents('.form-group').hide();
            $('input[name=search_coupon_name]').parents('.form-group').hide();
            $('input[name=message_key]').parents('.form-group').show();
            return;
        default :
            $('input[name=search_order_sn]').parents('.form-group').hide();
            $('input[name=search_goods_collection]').parents('.form-group').hide();
            $('input[name=search_goods_name]').parents('.form-group').hide();
            $('input[name=search_coupon_name]').parents('.form-group').hide();
            $('input[name=message_key]').parents('.form-group').hide();
            return;
    }
}


$(function()
{
    //类型改变的时候
    $('input[name=type]').click(function(){
        changeUrlType($(this).val())
    })

    //触发 “input[name=type]” click 事件
    $('input[name=type]:checked').trigger('click');

})

/**
 * Created by l on 2015/9/22.
 */
