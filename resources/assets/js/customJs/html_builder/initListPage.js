/**
 *   初始化表格
 *
 */
$(function(){
    $('#' + tableName).bootstrapTable({
        cookie          : true,
        cookieIdTable   : tableName,
        sortOrder       : "desc",
        strictSearch    : false,
        queryParams     : function (params) {
            params.search = $('.search_form').serialize()
            return params;
        }
    })


})