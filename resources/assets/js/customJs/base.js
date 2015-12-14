/**
 * Created by anywhere1000 on 15/6/7.
 */

//网络请求状态码
var HTTP_CODE = {
    'SUCCESS_CODE'  : 200,//请求成功
    'ERROR_CODE'    : 400, //请求失败
    'REDIRECT_CODE' : 302, //跳转
}




$(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'X-Requested-With' : 'XMLHttpRequest'
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





    $('.ajax-form').on('submit', function (e) {
        ajaxForm(this);
        //取消默认动作，防止表单两次提交
        e.preventDefault();
    });

    //双向选择器
    var leftSel = $("#selectL");
    var rightSel = $("#selectR");
    $("#toright").bind("click",function(){
        leftSel.find("option:selected").each(function(){
            $(this).remove().appendTo(rightSel);
            setMultiSelectVal(rightSel, $(this))
        });
    });
    $("#toleft").bind("click",function(){
        rightSel.find("option:selected").each(function(){
            $(this).remove().appendTo(leftSel);
        });
    });
    leftSel.dblclick(function(){
        $(this).find("option:selected").each(function(){
            $(this).remove().appendTo(rightSel);
        });
    });
    rightSel.dblclick(function(){
        $(this).find("option:selected").each(function(){
            $(this).remove().appendTo(leftSel);
        });
    });
    $("#sub").click(function(){
        setMultiSelectVal(rightSel, $(this))
    });
    //双向选择器

    //菜单折叠
    $(document).on('click','.tooltip-tip',function(){
        var css = $(this).next('ul').css('display');
        if(css == 'none'){
            //再展示点击的菜单
            $(this).next('ul').slideDown('normal');
            //给当前菜单添加选中状态
            $('.menu-div a').removeClass('topnav_hover');
        }else{
            $(this).next('ul').slideUp('normal');
        }
    });
    //菜单折叠

})

/**
 * 更新 Ckeditor
 *
 */
function updateCkeditroData(){
    try {
        for (instance  in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
            return true;
        }
    }catch(e){
    }

}

//启用按钮动画
function startButtonAnmate()
{
	try {
		l = $( '.ladda-button' ).ladda();
    	//开启按钮动画
    	l.ladda( 'start' );	
	} catch(e){
	}
}

//关闭按钮动画
function stopButtonAnmate()
{
	try {
		console.log(l);
		l.ladda( 'stop' );
	} catch(e){
	}
}

/**
 * ajax-form
 * 通过ajax提交表单，通过oneplus提示消息
 * 示例：<form class="ajax-form" method="post" action="xxx">
 */
function ajaxForm(obj)
{
    var _this = $(obj);
    //获取提交地址，方式
    var action = _this.attr('action');
    var method = _this.attr('method');

    if(method.toLocaleLowerCase() == 'get'){
        return;
    }

    //更新 Ckeditor
    updateCkeditroData()

	startButtonAnmate();
    
	//禁用提交按钮，防止重复提交
    var form = _this;	
	
    //如果禁止base.js 解析 则跳过
    if(form.find('input[name=status]').val() == 'false'){
        return;
    }

    //检测提交地址
    if (!action) {
        return false;
    }
    //默认提交方式为get
    if (!method) {
        method = 'get';
    }
    //获取表单内容
    var formContent = filterFormContents(_this.serialize());
	
    //发送提交请求
    var callable;
    if (method == 'post') {
        callable = $.post;
    } else {
        callable = $.get;
    }
	
	
    if ($(':file').size() > 0 ) {
        $.ajax(action, {
            type : method,
            files: $(":file", obj),
            data :formContent,
            iframe: true,
            dataType: "json",
            processData: true
        }).success(function (data) {
            parseResponseJson(data, ajaxFormCallback);
            //关闭按钮事件
            stopButtonAnmate()
        });
    } else {
        $.ajax(action, {
            type : method,
            files: $(":file", obj),
            data :formContent,
            dataType: "json",
            processData: true
        }).success(function (data) {
            parseResponseJson(data, ajaxFormCallback);
            //关闭按钮事件
            stopButtonAnmate()
        });
    }
	
    
    //返回
    return false;
}

/**
 * ajax form 回调方法
 *
 * @param data
 */
function ajaxFormCallback(data)
{
    console.log('这里是回调');
}

/**
 * 过滤 表单提交内容
 *
 * @param content
 * @returns {*}
 */
function filterFormContents(content)
{
    if (!content) {
        return content;
    }

    //反序列化
    var params = content.split('&');
    for (var i=0; i < params.length; i++) {
        if ( params[i].indexOf('search_name_xxxxx') >= 0){
            params.splice(i, 1);
        }
    }

    return params.join('&');
}

/**
 * 反序列化
 *
 * @param content
 * @returns {*}
 */
function unserialize(content)
{
    var data = content.split('&');
    var json = [];
    data.forEach(function(param){
        param = param.split('=');
        var value = "'"+param[0]+"' : " + "'"+(param[1])+"'";
        json.push(value);
    })
    return $.parseJSON("{" + json.join(',') + "}");
}

/**
 * 把url 参数字符串 解析成 json
 *
 * @param url
 * @returns {{}}
 */
function parseQueryString(url)
{
    var obj={};
    var keyvalue=[];
    var key="",value="";
    var paraString=url.substring(0,url.length).split("&");
    for(var i in paraString)
    {
        keyvalue=paraString[i].split("=");
        key=keyvalue[0];
        value=decodeURIComponent(keyvalue[1]);
        value = decodeURIComponent(value.replace(/\+/g, ' '));
        obj[key]=value;
    }
    return obj;
}

/**
 * 设置双向选择器值
 *
 * @param rightSel
 * @param obj
 */
function setMultiSelectVal(rightSel, obj){
    var selVal = [];
    rightSel.find("option").each(function(){
        selVal.push(this.value);
    });
    selVals = selVal.join(",");
    obj.parents('.form-group').find('input[type=hidden]').val(selVals);
}



/**
 * 删除信息
 *
 */
function del(obj, url){
    var _this = $(obj);

    if(url != ''){
        $.get(url, {}, function (data) {
            parseResponseJson(data, ajaxFormCallback);
            _this.parents('tr').slideUp();
        })
    }
}


/**
 * 解析 Response Json
 *
 * @param data
 */
function parseResponseJson(data, callback){
    if(data.code == HTTP_CODE.SUCCESS_CODE){
        //弹出提示框
        toastr.success(data.msg);
        //如果为true表示跳转到新连接
        data.target == true && setTimeout(function(){
            location.href = data.href;
        },1000)

    } else if (data.code == HTTP_CODE.REDIRECT_CODE) {
        location.href = data.href;
    } else{
        toastr.warning(data.msg);
    }

    //如果有回调方法，则执行回调方法
    $.isFunction(callback) && callback(data);
}

/**
 * 退出登录
 */
function logout(){
    $.get(logout_url, {}, function(data){
        parseResponseJson($.parseJSON(data), ajaxFormCallback);
    })
}


/**
 * 弹出选择图片提示框
 */
function showChoseImageDialog(obj, source, image_type){
    var _this = $(obj);
    console.log(choseImageDialog+"?source="+source+"&image_type="+image_type)
    layer.open({
        title:'搜索图片',
        type: 2,
        content: [choseImageDialog+"?source="+source+"&image_type="+image_type, 'no'] ,//这里content是一个普通的String
        zIndex: layer.zIndex,
        btn: ['确认', '取消'],
        yes: function(layero, index){
            var body = layer.getChildFrame('body', 0);
            var size = body.find('.chose_icon').size();//选中数量
            if(size <= 0){
                alert('请选择图片');
                return;
            }

            //设置图片
            var imagePath       = body.find('.chose_icon').parents('.imagebox').find('img').attr('data-src');
            var imageRealPath   = body.find('.chose_icon').parents('.imagebox').find('img').attr('src');
            //设置input值
            _this.parents('.form-group').find('input[type=hidden]').val(imagePath);
            //修改图片src属性
            _this.parents('.form-group').find('img').attr('src', imageRealPath);
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

    $.post(login_url, {email: email, password:password}, function(data){
        var _data = $.parseJSON(data);

        if(_data.code == HTTP_CODE.SUCCESS_CODE){
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
