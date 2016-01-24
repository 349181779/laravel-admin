/**
 * Created by anywhere1000 on 15/6/7.
 */

<<<<<<< HEAD
//网络请求状态码
var HTTP_CODE = {
    'SUCCESS_CODE'  : 200,//请求成功
    'ERROR_CODE'    : 400 //请求失败
}



=======
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
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
<<<<<<< HEAD

        //获取提交地址，方式
        var action = $(this).attr('action');
        var method = $(this).attr('method');

        if(method.toLocaleLowerCase() == 'get'){
            return;
        }

=======
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
        //取消默认动作，防止表单两次提交
        e.preventDefault();

        //禁用提交按钮，防止重复提交
        var form = $(this);

<<<<<<< HEAD


=======
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
        //如果禁止base.js 解析 则跳过
        if(form.find('input[name=status]').val() == 'false'){
            return;
        }

<<<<<<< HEAD
        //$('[type=submit]', form).addClass('disabled');


=======
        $('[type=submit]', form).addClass('disabled');

        //获取提交地址，方式
        var action = $(this).attr('action');
        var method = $(this).attr('method');
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1

        //检测提交地址
        if (!action) {
            return false;
        }

        //默认提交方式为get
        if (!method) {
            method = 'get';
        }

        //获取表单内容
<<<<<<< HEAD
        var formContent = filterFormContents($(this).serialize());
=======
        var formContent = $(this).serialize();
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1

        //发送提交请求
        var callable;
        if (method == 'post') {
            callable = $.post;
        } else {
            callable = $.get;
        }

<<<<<<< HEAD
        $.ajax(action, {
            type : method,
            files: $(":file", this),
            data:formContent,
            iframe: true,
            dataType: "json",
            processData: true
        }).success(function (data) {
=======
        callable(action, formContent, function (data) {
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
            parseResponseJson(data);
            $('[type=submit]', form).removeClass('disabled');
        });

<<<<<<< HEAD
        //callable(action, formContent, function (data) {
        //    parseResponseJson(data);
        //    $('[type=submit]', form).removeClass('disabled');
        //});

=======
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
        //返回
        return false;
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


})

<<<<<<< HEAD

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

=======
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
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
            parseResponseJson(data);
            _this.parents('tr').slideUp();
        })
    }
}


/**
 * 解析 Response Json
 *
 * @param data
 */
function parseResponseJson(data){
<<<<<<< HEAD
    if(data.code == HTTP_CODE.SUCCESS_CODE){
        //弹出提示框
        toastr.success(data.msg);
        //如果为true表示跳转到新连接
        data.target == true && setTimeout(function(){
            location.href = data.href;
        },1000)

    }else{
        toastr.warning(data.msg);
=======
    var _data = $.parseJSON(data);
    if(_data.code == 200){
        //弹出提示框
        toastr.success(_data.msg);
        //如果为true表示跳转到新连接
        _data.target == true && setTimeout(function(){
            location.href = _data.href;
        },1000)

    }else{
        toastr.warning(_data.msg);
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
    }
}

/**
 * 退出登录
 */
function logout(){
    $.get(logout_url, {}, function(data){
<<<<<<< HEAD
        parseResponseJson($.parseJSON(data));
=======
        parseResponseJson(data);
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
    })
}


/**
 * 弹出选择图片提示框
 */
<<<<<<< HEAD
function showChoseImageDialog(obj, source, image_type){
    var _this = $(obj);
    console.log(choseImageDialog+"?source="+source+"&image_type="+image_type)
    layer.open({
        title:'搜索图片',
        type: 2,
        content: [choseImageDialog+"?source="+source+"&image_type="+image_type, 'no'] ,//这里content是一个普通的String
=======
function showChoseImageDialog(obj){
    var _this = $(obj);
    layer.open({
        type: 2,
        content: [choseImageDialog, 'no'] ,//这里content是一个普通的String
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
        zIndex: layer.zIndex,
        btn: ['确认', '取消'],
        yes: function(layero, index){
            var body = layer.getChildFrame('body', 0);
<<<<<<< HEAD
            var size = body.find('.chose_icon').size();//选中数量
=======

            var size = body.find('.chose_img').size();//选中数量
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
            if(size <= 0){
                alert('请选择图片');
                return;
            }

            //设置图片
<<<<<<< HEAD
            var imagePath       = body.find('.chose_icon').parents('.imagebox').find('img').attr('data-src');
            var imageRealPath   = body.find('.chose_icon').parents('.imagebox').find('img').attr('src');
            //设置input值
            _this.parents('.form-group').find('input[type=hidden]').val(imagePath);
            //修改图片src属性
            _this.parents('.form-group').find('img').attr('src', imageRealPath);
=======
            var imagePath = body.find('.chose_img').find('img').attr('data-src');
            //设置input值
            _this.parents('.form-group').find('input[type=hidden]').val(imagePath);
            //修改图片src属性
            _this.parents('.form-group').find('img').attr('src', fileUrl+imagePath);
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
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

<<<<<<< HEAD
        if(_data.code == HTTP_CODE.SUCCESS_CODE){
=======
        if(_data.code == 200){
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
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


<<<<<<< HEAD
}

/**
 * 获得全部地址
 *
 */
function getAllCity()
{
    var _data = {};
    $.ajax({
        url         : getCityUlr,
        async       :false,
        dataType    :'json',
        success:function(data){
            if(data.code == HTTP_CODE.SUCCESS_CODE){
                //弹出提示框
                _data =  data.data;

            }else{
                toastr.warning(data.msg);
            }
        }
    });
    return _data;
}

/**
 * 获得当前区域
 *
 */
function getCurrentArea(city_id)
{
    var _data = {};
    $.ajax({
        url         : getAreaUlr,
        async       : false,
        dataType    : 'json',
        data        : {'city_id' : city_id},
        success:function(data){
            if(data.code == HTTP_CODE.SUCCESS_CODE){
                _data =  data.data;
            }else{
                toastr.warning(data.msg);
            }
        }
    });
    return _data;
}

/**
 * 搜索后台用户名称
 *
 * @param obj
 */
function searchAdmin(obj){
    var _this       = $(obj);
    var admin_name  = _this.prev('input').val()
    var _data       = {};
    if (admin_name == ''){
        alert('请选择搜索的名称');
        return;
    }

    $.ajax({
        url         : getAdminUrl,
        async       : false,
        dataType    : 'json',
        data        : {'admin_name' : admin_name},
        success:function(data){
            if(data.code == HTTP_CODE.SUCCESS_CODE){
                _data =  data.data;
            }else{
                toastr.warning(data.msg);
            }
        }
    });

    return _data;
}

/**
 * 搜索后台用户名称【展现模板】
 *
 * @param obj
 */
function searchAdminForSelect(obj){
    var admin_list = searchAdmin(obj)

    if (admin_list){
        var html = '';
        for(admin in admin_list){
            html += '<option value="' + admin_list[admin].id + '" >' + admin_list[admin].admin_name + '</option>'
        }
        $(obj).next('select').append(html)
    }
}

/**
 * 选择管理员
 *
 * @param obj
 */
function selectAdmin(obj){
    var _this        = $(obj)
    var admin_id     = _this.val();

    if(admin_id){
        _this.next('input:hidden').val(admin_id);
    }
}

/**
 * 编辑时间区域
 *
 * @param obj
 */
function editHours(obj){
    var _this               =  $(obj);
    var _shop_hours_val     =  _this.next('input').val().split(',');
    var _start_time         =  _this.parents('.form-group').find('select[name=start_time]').val();
    var _end_time           =  _this.parents('.form-group').find('select[name=end_time]').val();
    var _value              = _start_time +'-'+ _end_time;
    if(_start_time == ''){
        alert('开始时间不能为空');
        return;
    }else if(_end_time == ''){
        alert('开始时间不能为空');
        return;
    }else if(_shop_hours_val.indexOf(_value) > 0 ){
        alert('营业时间不能重复');
        return;
    }
    _this.next('input').val(_shop_hours_val == '' ? _value : _shop_hours_val.join(',') + ',' + _value);
}

/**
 * 弹出选择地图提示框
 */
function showChoseMapDialog(obj, city){
    var _this = $(obj);
    console.log(getMapUlr+"?city="+city)
    layer.open({
        title:'地图',
        type: 2,
        content: [getMapUlr+"?city="+city] ,//这里content是一个普通的String
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
=======
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
}