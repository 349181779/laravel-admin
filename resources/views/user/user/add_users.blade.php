<meta name="csrf-token" content="{{ csrf_token() }}" />
<link media="all" type="text/css" rel="stylesheet" href="/assets/css/bootstrap.css">
@include('home.block.style')

<div class="container">
    <form class="form-horizontal bucket-form ajax-form" action="<?php echo action('User\AddFriendController@postSearchFriend') ;?>" method="post">
        <div class="form-group">
            <label class="col-sm-3 control-label"><strong>通过账户查找联系人：</strong></label>
            <div class="col-sm-3">
                <input type="text" name="id" class="form-control" datatype="*" errormsg="" >
                <span class="help-block"></span>

                <div class="alert alert-danger hide" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    <span class="err_message"></span>
                </div>
            </div>
        </div>

        <input type="hidden" name="status" value="false" >
        <input name="_token" type="hidden" value="<?php echo csrf_token(); ?>"/>
        <button type="submit" style="display: block;margin: 0 auto;" class="btn btn btn-success">确认</button>
    </form>


    <div class="media row" style="margin: 50px auto;display:none;">
        <div class="media-left media-middle col-xs-3 col-xs-offset-1">
            <a href="#">
                <img class="media-object" src="" width="100" height="100" alt="">
            </a>
        </div>
        <div class="media-body col-xs-8">
            <h4 class="media-heading"></h4>

            <div class="form-group">
                <label class="col-sm-3 control-label"><strong>附言：</strong></label>
                <div class="col-sm-3">
                    <textarea class="form-control" name="contents" rows="3" placeholder="请输入附言"></textarea>

                </div>
            </div>

            <div class="col-xs-offset-1">
                <button type="button" class="btn btn-default" onclick="addUser(this)">
                    <span class="glyphicon glyphicon-plus" data-user-id=''  aria-hidden="true"></span> 加好友
                </button>
            </div>
        </div>
    </div>

</div>
@include('home.block.js')
<script>
    //验证表单
    checkForm($("form"))

    /**
     * 组合用户信息
     *
     */
    function mergeUserInfo(data){
        console.log(data);
        var _container = $('.media');
        _container.find('img').attr('src', data.face)
        data.user_name != '' ? _container.find('.media-heading').text(data.user_name) : _container.find('.media-heading').text(data.email);
        _container.find('button span').attr('data-user-id', data.id);
        _container.show();
    }

    /**
     * 添加会员
     *
     */
    function addUser(obj){
        var _this = $(obj);
        var id = _this.find('span').attr('data-user-id');
        var contents = $('textarea[name=contents]').val();
        if(id > 0 ){
            $.post("<?php echo action('User\AddFriendController@postAddFriend');?>", {'id':id, 'contents':contents}, function(data){
                var _data = $.parseJSON(data);
                if(_data.code == 200){
                    //组合用户信息
                    toastr.success(_data.msg);
                }else if(_data.code == 400){
                    toastr.warning(_data.msg);
                }
            })
        }

    }

    $(function(){
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
                var _data = $.parseJSON(data);
                if(_data.code == 200){
                    //组合用户信息
                    mergeUserInfo(_data.data);
                }else if(_data.code == 400){
                    toastr.warning(_data.msg);
                }

                $('[type=submit]', form).removeClass('disabled');
            });

            //返回
            return false;
        });
    })
</script>
