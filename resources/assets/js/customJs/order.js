/**
 * Created by zaiseoul on 15/11/25.
 */

var order_step_arr = [{
    //步骤名称
    title: "未付款",
    //步骤内容(鼠标移动到本步骤节点时，会提示该内容)
    content: "订单创建但是未付款"
},{
    title: "已付款",
    content: "订单已经创建，并且付款完成"
},{
    title: "已确认",
    content: "客服确认订单"
},{
    title: "已完成",
    content: "订单已完成"
},{
    title: "已取消",
    content: "订单已经取消"
}];

//订单状态
var order_state = {
    'order_state_0' : 0,//订单状态未付款
    'order_state_1' : 1,//订单状态已付款
    'order_state_2' : 2,//订单状态已确认
    'order_state_8' : 8,//订单状态已完成
    'order_state_9' : 9,//订单状态已取消
};

/**
 * 加载订单步骤
 *
 * @param step
 */
function loadOrderStep(step){

    //loadStep 方法可以初始化ystep
    $(".ystep1").loadStep({
        //ystep的外观大小
        //可选值：small,large
        size: "large",
        //ystep配色方案
        //可选值：green,blue
        color: "green",
        //ystep中包含的步骤
        steps: order_step_arr
    });

    $(".ystep1").setStep(step);

}

$(function(){
    layer.config({
        area:['auto', 'auto'],
    });
})

/**
 * 取消订单
 *
 * @param order_id
 * @param obj
 */
function cancel(order_id, obj){
    var _this = $(obj);
    var order_remark = _this.parents('form').find('textarea[name=action_textarea]').val();

    if (!order_remark) {
        layer.alert("取消理由不能为空");
        return;
    }

    $('[type=submit]', _this).addClass('disabled');

    //询问框
    layer.confirm('是否取消订单？', {
        btn: ['确定','取消'] //按钮
    }, function(){
        $.ajax(cancel_order_url, {
            type : 'post',
            data:{order_id: order_id},
            dataType: "json",
        }).success(function (data) {
            parseResponseJson(data);
            $('[type=submit]', _this).removeClass('disabled');
            layer.closeAll()
        });
    }, function(){

    });


}

//订单详情页
var order_info = bingo.action(function ($view, $ajax) {
    var map = {'order_id':order_id};

    $view.order_info    = [];
    $view.order_goods   = [];
    $view.order_record  = [];
    $view.order_bbs     = [];
    $view.order_comment = [];

    //获取订单详情
    $view.query_info = function () {
        $ajax(get_order_info_url).async(true).param(map).success(function(r){
            if(r.code == 200){
                $view.order_info = r.data;
                //加载订单步骤状态
                loadOrderStep(r.data.step_state)
            }else{
                toastr.warning(r.msg);
            }
            $view.$update();
        }).get();
    };
    get_order_info_url && $view.onInitData(function () {
        $view.query_info();
    });

    //获取订单商品信息
    $view.query_goods = function () {
        $ajax(get_order_goods_url).async(true).param(map).success(function(r){
            if(r.code == 200){
                $view.order_goods = r.data;
                $view.$update();
            }else{
                toastr.warning(r.msg);
            }
        }).get();
    };
    get_order_goods_url && $view.onInitData(function () {
        $view.query_goods();
    });

    //获取订单评价
    $view.query_comment = function () {
        $ajax(get_order_comment_url).async(true).param(map).success(function(r){
            if(r.code == 200){
                $view.order_comment = r.data;
                $view.$update();
            }else{
                toastr.warning(r.msg);
            }
        }).get();
    };
    get_order_comment_url && $view.onInitData(function () {
        $view.query_comment();
    });

});

/**
 * 提交表单指令
 */
bingo.command('bg-form-ajax', function () {
    return {
        link: ['$attr', '$node', function ($attr, $node) {

            $attr.$init(function (value) {
                $node.on('submit', function () {
                    ajaxForm(this);
                    $node.preventDefault()
                });
            });

        }]
    };
}); //end bg-form-ajax

