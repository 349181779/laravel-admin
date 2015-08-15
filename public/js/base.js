/**
 * Created by anywhere1000 on 15/6/7.
 */

$(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    /**
     * 初始化弹出框属性
     */
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

    /**
     * 初始化 消息提示框信息
     * @type {{closeButton: boolean, debug: boolean, positionClass: string, onclick: null, showDuration: string, hideDuration: string, timeOut: string, extendedTimeOut: string, showEasing: string, hideEasing: string, showMethod: string, hideMethod: string}}
     */
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "positionClass": "toast-top-right",
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "1500",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    /**
     * ajax-form
     * 通过ajax提交表单，通过oneplus提示消息
     * 示例：<form class="ajax-form" method="post" action="xxx">
     */
    $(document).on('submit', 'form.ajax-form', function (e) {
        //取消默认动作，防止表单两次提交
        e.preventDefault();

        //禁用提交按钮，防止重复提交
        var form = $(this);

        //如果禁止base.js 解析 则跳过
        if(form.find('input[name=status]').val() == 'false'){
            return;
        }

        $('[type=submit]', form).addClass('disabled');

        //获取提交地址，方式
        var action = $(this).attr('action');
        var method = $(this).attr('method');

        //检测提交地址
        if (!action) {
            return false;
        }

        //默认提交方式为get
        if (!method) {
            method = 'get';
        }

        //获取表单内容
        var formContent = $(this).serialize();

        //发送提交请求
        var callable;
        if (method == 'post') {
            callable = $.post;
        } else {
            callable = $.get;
        }

        callable(action, formContent, function (data) {
            parseResponseJson(data);
            $('[type=submit]', form).removeClass('disabled');
        });

        //返回
        return false;
    });

})




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
            layer.closeAll()
        }
    });
}

/**
 * 验证表单
 */
function checkForm(obj){
    obj.Validform({
        tiptype:function(msg, o, cssctl){
            switch(o.type){
                case 3:
                    o.obj.parents('.form-group').find('.alert').removeClass('hide').find('.err_message').text(msg);
                    break;
                case 2:
                    o.obj.parents('.form-group').find('.alert').addClass('hide').find('.err_message').text('');
                    break;
            }
        }

    });
}

/**
 * 加载验证码
 *
 * @param obj
 */
function loadCaptchaImg(obj){
    var _this = $(obj);
    var src = _this.find('img').attr('src');
    _this.find('img').attr('src', src+"?"+Math.round())
}

/**
 * 登陆
 *
 * @param obj
 */
function login(obj){

    var _this = $(obj);
    var email = $.trim(_this.parent().find('input[name=username]').val());
    var password = $.trim(_this.parent().find('input[name=passowrd]').val());
    //var token = _this.parent().find('input[name=_token]');

    if(email == ''){
        toastr.warning('用户名不能为空');
        return;
    }else if(password == ''){
        toastr.warning('密码不能为空');
        return;
    }

    console.log(email);

    $.post(login_url, {email: email, password:password}, function(data){
        var _data = $.parseJSON(data);

        if(_data.code == 200){
            //弹出提示框
            toastr.success(_data.msg);

            //如果为true表示跳转到新连接
            _data.target == true && setTimeout(function(){
                location.href = location.href;
            },1000)

        }else{
            toastr.warning(_data.msg);
        }
    });


}