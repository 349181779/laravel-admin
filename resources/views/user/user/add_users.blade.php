<link media="all" type="text/css" rel="stylesheet" href="/assets/css/bootstrap.css">
@include('home.block.style')

<div class="container">
    <form class="form-horizontal bucket-form ajax-form" action="<?php echo action('User\UserController@postAddFriend') ;?>" method="post">
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


        <input name="_token" type="hidden" value="<?php echo csrf_token(); ?>"/>
        <button type="submit" style="display: block;margin: 0 auto;" class="btn btn btn-success">确认</button>
    </form>

</div>
@include('home.block.js')
<script>
    //验证表单
    checkForm($("form"))

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
                console.log(_data);return;
                $('[type=submit]', form).removeClass('disabled');
            });

            //返回
            return false;
        });
    })
</script>
