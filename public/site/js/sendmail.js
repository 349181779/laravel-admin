var mail = {
    mailData:[
        //{
        //    mail: "163",
        //    name: "@163.com",
        //    action: "http://reg.163.com/CheckUser.jsp",
        //    params: {
        //        url: "http://entry.mail.163.com/coremail/fcg/ntesdoor2?lightweight=1&verifycookie=1&language=-1&from=web&df=webmail163",
        //        username: "_username_",
        //        password: "_password_"
        //    }
        //},
        //{
        //    mail: "126",
        //    name: "@126.com",
        //    action: "https://reg.163.com/logins.jsp",
        //    params: {
        //        domain: "126.com",
        //        username: "_username_@126.com",
        //        password: "_password_",
        //        url: "http://entry.mail.126.com/cgi/ntesdoor?lightweight%3D1%26verifycookie%3D1%26language%3D0%26style%3D-1"
        //    }
        //},
        {
            mail: "sina",
            name: "@sina.com",
            action: "http://mail.sina.com.cn/cgi-bin/login.cgi",
            params: {
                u: "_username_",
                psw: "_password_"
            }
        },
        //{
        //    mail: "yahoocomcn",
        //    name: "@yahoo.com.cn",
        //    action: "https://edit.bjs.yahoo.com/config/login",
        //    params: {
        //        login: "_username_@yahoo.com.cn",
        //        passwd: "_password_",
        //        domainss: "yahoo",
        //        ".intl": "cn",
        //        ".src": "ym"
        //    }
        //},
        //{
        //    mail: "yahoocn",
        //    name: "@yahoo.cn",
        //    action: "https://edit.bjs.yahoo.com/config/login",
        //    params: {
        //        login: "_username_@yahoo.cn",
        //        passwd: "_password_",
        //        domainss: "yahoocn",
        //        ".intl": "cn",
        //        ".done": "http://mail.cn.yahoo.com/inset.html"
        //    }
        //},
        {
            mail: "sohu",
            name: "@sohu.com",
            action: "http://passport.sohu.com/login.jsp",
            params: {
                loginid: "_username_@sohu.com",
                passwd: "_password_",
                fl: "1",
                vr: "1|1",
                appid: "1000",
                ru: "http://login.mail.sohu.com/servlet/LoginServlet",
                ct: "1173080990",
                sg: "5082635c77272088ae7241ccdf7cf062"
            }
        },
        //{
        //    mail: "yeah",
        //    name: "@yeah.net",
        //    action: "https://reg.163.com/logins.jsp",
        //    params: {
        //        domain: "yeah.net",
        //        username: "_username_@yeah.net",
        //        password: "_password_",
        //        url: "http://entry.mail.yeah.net/cgi/ntesdoor?lightweight%3D1%26verifycookie%3D1%26style%3D-1"
        //    }
        //},
        //{
        //    mail: "139",
        //    name: "@139.com",
        //    action: "https://mail.10086.cn/Login/Login.ashx",
        //    params: {
        //        UserName: "_username_",
        //        Password: "_password_",
        //        clientid: "5015"
        //    }
        //},
        //{
        //    mail: "tom",
        //    name: "@tom.com",
        //    action: "http://login.mail.tom.com/cgi/login",
        //    params: {
        //        user: "_username_",
        //        pass: "_password_"
        //    }
        //},
        //{
        //    mail: "21cn",
        //    name: "@21cn.com",
        //    action: "http://passport.21cn.com/maillogin.jsp",
        //    params: {
        //        UserName: "_username_@21cn.com",
        //        passwd: "_password_",
        //        domainname: "21cn.com"
        //    }
        //},
        //{
        //    mail: "renren",
        //    name: "\u4eba\u4eba\u7f51",
        //    action: "http://passport.renren.com/PLogin.do",
        //    params: {
        //        email: "_username_",
        //        password: "_password_",
        //        origURL: "http://www.renren.com/Home.do",
        //        domain: "renren.com"
        //    }
        //},
        //{
        //    mail: "baidu",
        //    name: "\u767b\u5f55\u767e\u5ea6",
        //    action: "https://passport.baidu.com/?login",
        //    params: {
        //        u: "http://passport.baidu.com/center",
        //        username: "_username_",
        //        password: "_password_"
        //    }
        //},
        //{
        //    mail: "51",
        //    name: "51.com",
        //    action: "http://passport.51.com/login.5p",
        //    params: {
        //        passport_51_user: "_username_",
        //        passport_51_password: "_password_",
        //        gourl: "http%3A%2F%2Fmy.51.com%2Fwebim%2Findex.php"
        //    }
        //}
        ],
    init:function(){
        var $mailSelect = $('.mail-list ul');
        var $mailUserName =$('#mailUserName');
        var $mailPassword = $('#mailPassword');
        var $mailParas = $('#mailParas');
        var md = mail.mailData;
        var p=[];
        $mailSelect.empty(); //清空邮箱列表
        for(var i=0;i<md.length;i++){
            $mailSelect.append('<li data="'+md[i].mail+'">'+md[i].name+'</li>');
        }

        $mailSelect.find('li').click(function(){
            var mailName = $(this).attr('data');
            var m = mail.find(mailName,md);
            if(m){
                p = [];
                for(var key in m.params){
                    p.push('<input type="hidden" name="'+ key+'" value="'+m.params[key].replace(/_username_/,$mailUserName.val()).replace(/_password_/,$mailPassword.val())+'" />');
                };
                $mailParas.empty().html(p.join(''));
                $('.mailSelect').find('.mail-list').addClass('hide')
                $('#mailForm').attr('action',m.action);
            }
        }).change();

        $('#mailForm').bind('submit',function(){
            return mail.check();
        });
    },
    check:function(){
        var $mailSelect = $('#mailSelect');
        var $mailUserName =$('#mailUserName');
        var $mailPassword = $('#mailPassword');
        if($mailUserName.val()==''){
            alert('请输入您的邮箱登录名称！');
            return false;
        }else if($mailPassword.val()==''){
            alert('请输入您的登录密码！');
            return false;
        }else{
            $mailSelect.change();
            $mailPassword.val('');
            outWin=window.open('','','scrollbars=yes,menubar=yes,toolbar=yes,location=yes,status=yes,resizable=yes');
            doc=outWin.document;
            doc.open('text/html');
            doc.write('<html><head><meta http-equiv="Content-Type" content="text/html; charset=gb2312"><title>邮箱登录</title></head><body onload="document.tmpForm.submit()">');
            doc.write('<p align="center" style="font-size: 14px; color: #FF0000">正在登录系统，请稍候......</p><form name="tmpForm" action="'+$('#mailForm').attr('action')+'" method="post">'+$('#mailParas').html()+'</form></body></html>');
            doc.close();
            return false;
        }
    },
    find:function(mail,md){ //根据mail名称查找
        for(var i=0;i<md.length;i++){
            if(md[i].mail == mail)
                return md[i];
        }
    }
}

$(function(){
    mail.init();
})