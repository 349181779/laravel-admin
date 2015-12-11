/**
 * Created by zaiseoul on 15/11/25.
 */

/**
 * 选择 输入方式 如果是 1 则显示 有效开始时间 和 有效结束时间 否则显示 当前日期可往后销售天数
 *
 * @param value
 */
function choseInputType(value) {

    switch  (value) {
        case '1':
            $('input[name=valid_sales_number]').parents('.form-group').hide();
            $('input[name=valid_date_from]').parents('.form-group').show();
            $('input[name=valid_date_to]').parents('.form-group').show();
            break;
        default :
            $('input[name=valid_sales_number]').parents('.form-group').show();
            $('input[name=valid_date_from]').parents('.form-group').hide();
            $('input[name=valid_date_to]').parents('.form-group').hide();
            break;
    }
}


$(function (){

    $('input[name=is_valid_date]').on('click', function (){
        choseInputType( $(this).val() )
    })

    //触发事件
    $('input[name=is_valid_date]:checked').trigger('click');
})

