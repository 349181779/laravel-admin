/**
 * Created by anywhere1000 on 15/6/7.
 */

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