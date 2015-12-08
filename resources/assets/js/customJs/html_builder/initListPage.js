/**
 *   初始化表格
 *
 */
$(function(){
    $('#' + tableName).bootstrapTable({
        cookie:true,
        cookieIdTable:tableName
    })
})

/**
 * 组合query params
 *
 * @param params
 * @returns {*}
 */
function queryParams(params){
    params.search = $('.search_form').serialize()
    return params;
}