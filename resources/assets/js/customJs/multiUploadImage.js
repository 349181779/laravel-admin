$(function(){
    layer.config({
        area:['auto', 'auto'],
    });
})

/**
 * 弹出批量上传图片弹出框
 */
function batchUploadImages(obj, id){
    var _this = $(obj);
    layer.open({
        title:'批量上传图片',
        type: 2,
        area:['1024px', '700px'],
        content: [batchUploadImagesUrl + "?id="+ id , 'no'] ,//这里content是一个普通的String
        btn: ['确认'],
        yes: function(layero, index){
            layer.closeAll()
            window.parent.location.href = window.parent.location.href
        },
    });
}
