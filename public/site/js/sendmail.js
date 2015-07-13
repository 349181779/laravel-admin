function clickMail(){

    var gm          = $('#FrLgn')
    var vDomain     = gm.find('select[name=domainss]');
    var vName       = gm.find('input[name=uName]');
    var vPw         = gm.find('input[name=uPw]')
    if(vDomain.val()==""){alert("您没有选择邮箱！")
        vDomain.focus()
        return false}
    if(vName.val()==""){alert("用户名不能为空！")
        vName.focus()
        return false
    }
    if(vPw.val()==""){alert("密码不能为空！")
        vPw.focus()
        return false}
    switch(vDomain.val()){
        case "@163.com":
            gm.attr('action',"http://reg.163.com/CheckUser.jsp" )
            gm.find('input[name=url]').val("http://fm163.163.com/coremail/fcg/ntesdoor2?lightweight=1&verifycookie=1&language=-1&style=15")
            gm.find('input[name=username]').val(vName.val());
            gm.find('input[name=password]').val(vPw.val());
            gm.find('input[name=enterVip]').val('')
            break;
        case "@126.com":
            gm.attr('action',"https://reg.163.com/logins.jsp" )
            gm.find('input[name=domain]').val('126.com');
            gm.find('input[name=username]').val(vName.val()+"@126.com");
            gm.find('input[name=password]').val(vPw.val());
            gm.find('input[name=value]').val("http://entry.mail.126.com/cgi/ntesdoor?lightweight%3D1%26verifycookie%3D1%26language%3D0%26style%3D-1")
            break
        case "@yeah.net":
            gm.attr('action',"https://reg.163.com/logins.jsp")
            gm.find('input[name=domain]').val('yeah.net');
            gm.find('input[name=username]').val(vName.val()+"@yeah.net");
            gm.find('input[name=password]').val(vPw.val());
            gm.find('input[name=value]').val("http://entry.mail.yeah.net/cgi/ntesdoor?lightweight%3D1%26verifycookie%3D1%26style%3D-1")
            break
        case "@188.com":
            gm.attr('action',"http://reg.mail.188.com/servlet/coremail/login?language=0&style=1")
            gm.find('input[name=username]').val(vName.val());
            gm.find('input[name=password]').val(vPw.val());
            break
        case "@sohu.com":
            gm.attr('action',"http://passport.sohu.com/login.jsp")
            gm.find('input[name=url]').val("")
            gm.find('input[name=UserName]').val(vName.val());
            gm.find('input[name=Password]').val(vPw.val());
            gm.find('input[name=id]').val(vName.value);
            gm.find('input[name=username]').val(vName.val()+"@yeah.net");
            gm.find('input[name=password]').val(vPw.val());
            gm.find('input[name=m]').val(vName.val());
            gm.find('input[name=passwd]').val(vPw.val());
            gm.find('input[name=mpass]').val(vPw.val());
            gm.find('input[name=loginid]').val(vName.val()+"@sohu.com");
            gm.find('input[name=fl]').val('1');
            gm.find('input[name=vr]').val('1|1');
            gm.find('input[name=appid]').val('1000');
            gm.find('input[name=ru]').val("http://login.mail.sohu.com/servlet/LoginServlet");
            gm.find('input[name=eru]').val("http://login.mail.sohu.com/login.jsp");
            gm.find('input[name=ct]').val("1173080990");
            gm.find('input[name=sg]').val("5082635c77272088ae7241ccdf7cf062");
            break
        case "yahoo":
            gm.attr('action',"https://edit.bjs.yahoo.com/config/login")
            gm.find('input[name=login]').val(vName.val());
            gm.find('input[name=passwd]').val(vPw.val());
            break
        case "@yahoo.com.cn":
            gm.attr('action',"https://edit.bjs.yahoo.com/config/login")
            gm.find('input[name=login]').val(vName.val()+"@yahoo.cn");
            gm.find('input[name=passwd]').val(vPw.val());
            break
        case "@tom.com":
            gm.attr('action',"http://bjweb.163.net/cgi/163/login_pro.cgi")
            gm.find('input[name=user]').val(vName.val());
            gm.find('input[name=pass]').val(vPw.val());
            break
        case "@21cn.com":
            gm.attr('action',"http://passport.21cn.com/maillogin.jsp")
            gm.find('input[name=LoginName]').val(vName.val());
            gm.find('input[name=passwd]').val(vPw.val());
            gm.find('input[name=domain]').val('21cn.com');
            gm.find('input[name=UserName]').val(vName.val()+'@21cn.com');
            break
        case "@sina.com":
            gm.attr('action',"http://mail.sina.com.cn/cgi-bin/login.cgi")
            gm.find('input[name=u]').val(vName.val());
            gm.find('input[name=psw]').val(vPw.val());
            break
        case "@gmail.com":
            gm.attr('action',"https://www.google.com/accounts/ServiceLoginAuth")
            gm.find('input[name=Email]').val(vName.val());
            gm.find('input[name=Passwd]').val(vPw.val());
            break
        case "chinaren":
            gm.attr('action',"http://passport.sohu.com/login.jsp")
            gm.find('input[name=loginid]').val(vName.val()+"@chinaren.com");
            gm.find('input[name=passwd]').val(vPw.val());
            gm.find('input[name=fl]').val('1');
            gm.find('input[name=vr]').val('1|1');
            gm.find('input[name=appid]').val('1005');
            gm.find('input[name=ru]').val("http://profile.chinaren.com/urs/setcookie.jsp?burl=http://alumni.chinaren.com/");
            gm.find('input[name=ct]').val("1174378209");
            gm.find('input[name=sg]').val("84ff7b2e1d8f3dc46c6d17bb83fe72bd");
            break
        case "tianya":
            gm.attr('action',"http://www.tianya.cn/user/loginsubmit.asp")
            gm.find('input[name=vwriter]').val(vName.val());
            gm.find('input[name=vpassword]').val(vPw.val());
            break
        //case "baidu":
        //    gm.action="http://passport.baidu.com/?login"
        //    gm.attr('action',"http://passport.baidu.com/?login")
        //    gm.u.value="http://passport.baidu.com/center"
        //    gm.username.value=vName.value
        //    gm.password.value=vPw.value
        //    break
        //case "xiaonei":
        //    gm.action="http://login.xiaonei.com/Login.do"
        //    gm.email.value=vName.value
        //    gm.password.value=vPw.value
        //    break
        //case "51com":
        //    gm.action="http://passport.51.com/login.5p"
        //    gm.passport_51_user.value=vName.value
        //    gm.passport_51_password.value=vPw.value
        //    gm.gourl.value="http%3A%2F%2Fmy.51.com%2Fwebim%2Findex.php"
        //    break
    }
    vPw.value=""
    return true}