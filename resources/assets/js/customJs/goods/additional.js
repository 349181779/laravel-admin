/**
 * Created by zaiseoul on 15/11/25.
 */

/**
 * 选择 输入方式 如果是 1 则显示 父级ID 下拉列表框，如果是2，则不显示 父级ID 下拉列表框
 *
 * @param value
 */
function choseInputType(value) {
    switch  (value) {
        case '1':
            $('select[name=parent_id]').parents('.form-group').show();
            break;
        default :
            $('select[name=parent_id]').parents('.form-group').hide();
            break;
    }
}


$(function (){

    $('input[name=input_type]').on('click', function (){
        choseInputType( $(this).val() )
    })

    //触发事件
    $('input[name=input_type]:checked').trigger('click');
})

