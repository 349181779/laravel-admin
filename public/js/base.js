/**
 * Created by anywhere1000 on 15/6/7.
 */

$(function(){
    layer.config({
        skin:'layer-ext-moon',
        extend:'./skin/mono/style.css',
        closeBtn:1,//关闭按钮
        shift:1,//动画
        shade:[0.9, '#ccc'],//遮罩
        shadeClose:true,//是否点击遮罩关闭
        maxmin:true,//最大最小化。
        area:['1024px', '700px'],
        scrollbar:true//是否禁用浏览器滚动条
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
            location.href = _data.href;
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


/**
 * 弹出选择图片提示框
 */
function showChoseImageDialog(obj){
    var _this = $(obj);
    layer.open({
        type: 2,
        content: [choseImageDialog, 'no'] ,//这里content是一个普通的String
        zIndex: layer.zIndex,
        btn: ['确认', '取消'],
        yes: function(layero, index){
            var body = layer.getChildFrame('body', 0);

            var size = body.find('.chose_img').size();//选中数量
            if(size <= 0){
                alert('请选择图片');
                return;
            }

            //设置图片
            var imagePath = body.find('.chose_img').find('img').attr('data-src');
            //设置input值
            _this.parents('.form-group').find('input[type=hidden]').val(imagePath);
            //修改图片src属性
            _this.parents('.form-group').find('img').attr('src', fileUrl+imagePath);
            layer.closeAll()

        },
        cancel: function(layero, index){
            layer.closeAll(type)
        }
    });
}