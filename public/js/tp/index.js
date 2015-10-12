/**
 * Created by anywhere1000 on 15/9/18.
 */

/**
 * 更改type 类型
 *
 * @param type
 */
function changeUrlType(type)
{
    if (type == '') {
        return;
    }

    switch (type){
        case '1':
            $('input[name=url_update]').parents('.form-group').hide();
            $('input[name=url_cancel]').parents('.form-group').hide();
            $('input[name=push_url]').parents('.form-group').show();
            return;
        default :
            $('input[name=url_update]').parents('.form-group').show();
            $('input[name=url_cancel]').parents('.form-group').show();
            $('input[name=push_url]').parents('.form-group').hide();
            return;
    }
}


$(function()
{

    //类型改变的时候
    $('input[name=url_type]').click(function(){
        changeUrlType($(this).val())
    })

    //触发 “input[name=url_type]” click 事件
    $('input[name=url_type]:checked').trigger('click');

})