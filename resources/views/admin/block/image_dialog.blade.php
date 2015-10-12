
<script>
    $(function(){

        //伸缩dialog
        $('.images_title span').on('click',function(){
            if($(this).text() == '展开'){
                $('.images_dialog').animate({bottom:47},500);
                $(this).text('收起');
            }else if($(this).text() == '收起'){
                $('.images_dialog').animate({bottom:-253},500);
                $(this).text('展开');
            }
        })
        //伸缩dialog

        //选择图片
        $('.images_main img').live('click',function(){
            //声明变量
            var _this = $(this);

            //循环判断 选中类型是app 还是 pc
            $('input[name=img_input]').each(function(i){

                if($(this).attr('checked') == 'checked'){

                    var _img_dom = $(this).parents('.thmub_img_div').find('img');
                    var _input_dom = $(this).parents('.thmub_img_div').find('.pc_input');

                    _img_dom.attr('src',_this.attr('src'));
                    _input_dom.val(_this.attr('source'));
                }

            })

        })

        //选择图片


    })

    //images_dialog
    function showImageDialogWidget(){
        $('.images_dialog').animate({bottom:47},500);
        $('.images_title span').text('收起');
    }

    /**
     * 搜索图片
     *
     * @param obj
     * @param source
     * @param image_type
     */
    function searchImg(obj,source,image_type){
        //设置变量
        var _this = $(obj);
        var _search_val = _this.parents('.search_img').find('.search_input').val();
        var _ajax_url = '<?php echo U("Admin/Images/ajaxSearchImg") ?>';

        if(_search_val == ''){
            alert('内容不能为空');
        }else{
            //发送ajax
            $.post(_ajax_url,{'image_type':image_type,'image_name':_search_val,'source':source},function(data){
                var _data = eval("("+data+")");

                if(_data.code == 200){
                    show_image_dialog_widget();
                    $('.images_main').empty();
                    $('.images_main').append(_data.data)
                }else if(_data.code == 400){
                    alert(_data.message);
                }
            })
        }
    }

    function choseImage(obj){
        var _this = $(obj);

    }
</script>

<!-- 选择images_dialog 开始 -->
<div class="images_dialog dialog1" >
    <div class="images_title">
        <h3>请选择图片</h3>
        <span>展开</span>
    </div>

    <div class="images_main"></div>

</div>
<!-- 选择images_dialog 结束 -->