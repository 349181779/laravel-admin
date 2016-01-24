<div class="user-inr1 row" style="display:none;">
    <div class="col-xs-3">
        <p class="text-warning">当前头像</p>

        <div class="thumbnail">
            <img src="<?php echo $user_profile->face;?>" class="avatar-img"/>
        </div>
    </div>
    <div class="col-xs-3">
        &nbsp;
    </div>
    <div class="col-xs-6">
        <p class="text-warning">设置新头像</p>

        <p class="text-muted">支持jpg，png，gif，bmp等格式，可以在大照片中裁剪比较满意的部分</p>

        <form method="post" action="<?php echo action('User\AvatarController@postUploadUserAvatar') ;?>" id="avatar_form" enctype="multipart/form-data">
            <p class="hide">
                <input type="file" name="image"/>
            </p>

            <div class="btn submit_btn btn-info" id="select_file_button">选择文件</div>
            <p class="text-error" id="submitTip"></p>

        </form>
        <p id="upload_tip" class="text-danger"></p>

<!--        <div id="uploaded_image_div" style="display: none;">-->
<!--            <div class="thumbnail">-->
<!--                <img id="uploaded_image" style="width: 100%;" class="thumbnails"/>-->
<!--            </div>-->
<!--            <p class="text-danger" id="save_avatar_tip"></p>-->
<!--            <p>-->
<!--                <a class="submit_btn btn-default" id="save_avatar_button" data-url="{:U('UserCenter/Config/doCropAvatar')}">选区裁剪后保存头像</a>-->
<!--            </p>-->
<!--        </div>-->


    </div>
</div>

<link rel="stylesheet" type="text/css" href="/jcrop/jquery.Jcrop.css"/>
<script src="/jcrop/jquery.Jcrop.js"></script>
<script src="/browser/jquery.browser.js"></script>
<script src="/jquery.iframe-transport.js"></script>
<script>
    var temp;

    $(function () {
        var crop;
        var jcrop_api;
        //选择图片文件之后立即上传表单
        $('[name=image]').change(function () {
            $('#avatar_form').submit();
        });

        $('#avatar_form').submit(function (e) {
            e.preventDefault();



            $.ajax(this.action, {
                type : this.method,
                files: $(":file", this),
                iframe: true,
                dataType: "json",
                processData: true
            }).success(function (data) {
                if(data.code == 200){
                    toastr.success(data.msg);
                    $('.avatar-img').attr('src', data.data)
                }else if(data.code == 400){
                    toastr.warning(data.msg);
                    //$('.text-danger').text(data.message)
                }
                //$('#avatar_form').trigger('onJson', [json])
            });
        });

        //头像上传后显示图片内容
        $('#avatar_form').bind('onJson', function (e, json) {
            //如果发生错误，则显示错误信息
            if (!json.success) {
                $('#upload_tip').text(json.message);
            }

            //隐藏图片上传表单
            $('#avatar_form').hide();

            //显示图片内容
            $('#uploaded_image').attr('src', json.image);
            $('#uploaded_image_div').show();

            //图片加载完之后 开启图片切割
            $('#uploaded_image').load(function () {
                $('#uploaded_image').Jcrop({
                    aspectRatio: 1,
                    onSelect: updateCoordinate,
                    minSize: [64,64],
                    setSelect: [0,0,366,366]
                },function(){
                    jcrop_api=this;
                    crop=jcrop_api.tellScaled();
                });


            })
        });
        function updateCoordinate(c) {
            crop = c;
        }

        //点击选择文件按钮之后显示选择文件对话框
        $('#select_file_button').click(function () {
            $('[name=image]').trigger('click');
        });

        //点击保存头像后
        function showAvatarTip(text) {
            $('#save_avatar_tip').text(text);
        }

        $('#save_avatar_button').click(function () {
            //检查是否已经裁剪过
            if (crop.w == undefined || crop.w == 0) {
                showAvatarTip('请先选出图片中需要的部分');
                return;
            }

            //显示正在保存
            $(this).text('正在保存');
            $(this).addClass('disabled');

            //隐藏错误消息
            showAvatarTip('');

            //提交到服务器
            var url = $(this).attr('data-url');
            var imageWidth = $('.jcrop-holder img').width();
            var imageHeight = $('.jcrop-holder img').height();
            var crop2 = crop.x / imageWidth + ',' + crop.y / imageHeight + ',' + crop.w / imageWidth + ',' + crop.h / imageHeight;
            $.post(url, {crop: crop2}, function (a) {
                if (a.status) {
                    if(a.url){
                        location.href = a.url;
                    }
                } else {
                    showAvatarTip(a.info);

                    //恢复按钮
                    $('#save_avatar_button').text('保存头像');
                    $('#save_avatar_button').removeClass('disabled');
                }
            });
        })
    })
</script>