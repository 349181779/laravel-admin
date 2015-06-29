/**
 * Created by anywhere1000 on 15/6/7.
 */

$(function(){
    layer.config({
        skin:'layer-ext-moon',
        extend:'./skin/mono/style.css',
        closeBtn:1,//关闭按钮
        shift:1,//动画
        shade:[0.9, '#fff'],//遮罩
        shadeClose:true,//是否点击遮罩关闭
        maxmin:true,//最大最小化。
        scrollbar:false//是否禁用浏览器滚动条
    });
})

toastr.options = {
    "closeButton": true,
    "debug": false,
    "positionClass": "toast-top-right",
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "1000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}


/**
 * 解析 Response Json
 *
 * @param data
 */
function parseResponseJson(data){
    var _data = eval("("+data+")");
    if(_data.code == 200){
        //弹出提示框
        toastr.success(_data.msg);

        //如果为true表示跳转到新连接
        _data.target == true && setTimeout(function(){
            location.href = _data.data.href;
        },1000)

    }else{
        toastr.warning(_data.msg);
    }
}

/**
 * 退出登录
 */
function logout(){
    $.get(logout_url, {}, function(data){
        parseResponseJson(data);
    })
}