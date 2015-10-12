/**
 * Created by anywhere1000 on 15/9/22.
 * Author: zhuweijian <zhuweijain@louxia100.com>
 */

/**
 * 更改type 类型
 *
 * @param id
 * @param obj
 */

function confirmVisitor(id, obj, url)
{
    var _this = $(obj);

    layer.confirm('是否确认审核？', {
        btn: ['确认','取消'], //按钮
        area:['auto', 'auto']
    }, function(){
        $.post(url,{'id': id },function(data){
            var _data = $.parseJSON(data);
            if(_data.code == HTTP_CODE.ERROR_CODE){
                layer.alert(_data.msg, {
                    area:['auto', 'auto']
                });

            }else{
                _this.parents("tr").slideUp();
                layer.closeAll();
            }
        });

    }, function(){
        layer.closeAll();
    });

}


/**
 * Created by l on 2015/9/22.
 */
