$(function(){
    layer.config({
        area:['auto', 'auto'],
    });

    var $images = $('.image_list_container').sortable({
        items :".image_list",                        //只是li可以拖动
        //cursorAt:"left",
        forceHelperSize:true,
        forcePlaceholderSize:true,
        //grid:[5,5],
        scrollSpeed:1,
        update : function(event, ui){       //更新排序之后
            $.post(postUpdateSortUrl, {sort : $(this).sortable('toArray')}, function(data){

            })
        }
    });
})

/**
 * 弹出批量上传图片弹出框
 */
function batchUploadImages(obj, shop_id){
    var _this = $(obj);
    layer.open({
        title:'批量上传图片',
        type: 2,
        area:['1024px', '700px'],
        content: [batchUploadImagesUrl + "?shop_id="+ shop_id , 'no'] ,//这里content是一个普通的String
        btn: ['确认'],
        yes: function(layero, index){
            layer.closeAll()
            window.parent.location.href = window.parent.location.href
        },
    });
}


/**
 * 设置当前图片为商家默认图片
 *
 * @param obj
 * @param id
 * @param shop_id
 */
function setCurImageToTop(obj, id, product_id)
{
    var _this = $(obj);

    $.ajax(setCurImageToTopUrl, {
        type : 'post',
        data:{id: id, product_id: product_id},
        dataType: "json",
    }).success(function (data) {
        if(data.code == HTTP_CODE.SUCCESS_CODE){
            $('.image_list img').removeClass('top_image')
            toastr.success(data.msg);
            _this.parents('.image_list').find('img').addClass('top_image')
            $('.btn-success').removeAttr('disabled')
            _this.attr('disabled', 'disabled')
        } else{
            layer.closeAll()
            toastr.warning(data.msg);
        }
    });
}

/**
 * 软删除图片
 *
 * @param obj
 * @param id
 * @param product_id
 */
function delImageToTop(obj, id, product_id)
{
    var _this = $(obj);

    //询问框
    layer.confirm('是否删除？', {
        btn: ['确定','取消'] //按钮
    }, function(){
        $.ajax(delImageToTopUrl, {
            type : 'post',
            data:{id: id, product_id: product_id},
            dataType: "json",
        }).success(function (data) {
            if(data.code == HTTP_CODE.SUCCESS_CODE){
                _this.parents('.image_list').remove()
                layer.closeAll()
                toastr.success(data.msg);
            } else{
                layer.closeAll()
                toastr.warning(data.msg);
            }
        });
    }, function(){

    });


}