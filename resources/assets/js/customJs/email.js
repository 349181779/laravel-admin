$(function (){
    //获得邮件内容
    getEmailContent(0, 0);
})

/**
 * 获得邮件内容
 *
 * @param obj
 */
function getEmailContent(is_host){

    $.ajax(getEmailContentUrl, {
        type : 'post',
        data: {'order_id' : order_id, is_host : is_host},
        dataType: "html",
    }).success(function (data) {
        $('.email_content').html(data);
    });

}

/**
 * 发送邮件内容
 *
 * @param obj
 */
function sendEmailContent(is_host){

    $.ajax(sendEmailContentUrl, {
        type : 'post',
        data: {'order_id' : order_id, is_host : is_host},
        dataType: "json",
    }).success(function (data) {
        parseResponseJson(data);;
    });

}