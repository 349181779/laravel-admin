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
        pageSize        : pageSize,
        queryParams     : function (params) {
            params.search = $('.search_form').serialize()
            return params;
        }
    })


})