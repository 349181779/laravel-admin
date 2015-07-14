<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@section('base_header')
@include('home.block.base_header')
@show
</head>

<body>
<!-- top -->
<div class="top">
      @section('header')
          @include('home.block.header')
      @show

</div>
<!-- end top -->
<!-- main -->
<div class="main">
    <div class="wrap">
           <!-- 邮箱 -->
		   <div class="mail">
		         <div class="m_logo"><img src="/site/images/sologo.png" width="363" height="66" /></div>
				 <div class="m_conts">
				      <form name="gomail" id="FrLgn" method="post" onsubmit="return clickMail()" action="">
				          账号：<input type="text" name="uName" value="" class="m_txt" />
                          邮箱：<select class="m_txt" name="domainss">
                                    <option  >请选择邮箱</option>
                                    <option value="@163.com">@163.com</option>
                                    <option value="@126.com">@126.com</option>
                                    <option value="@sina.com">@sina.com</option>
                                    <option value="@yahoo.com">@yahoo.com.cn</option>
                                    <option value="@yahoo.cn">@yahoo.cn</option>
                                    <option value="@gmail.com">@gmail.com</option>
                                    <option value="@sohu.com">@sohu.com 搜狐</option>
                                    <option value="@tom.com">@tom.com</option>
                                    <option value="@188.com">@188.com</option>
                                    <option value="@21cn.com">@21cn.com</option>
                                    <option value="@yeah.net">@yeah.net</option>
                            </select>
                          密码：<input type="password" name="uPw"  class="m_txt" />
                          <input type="submit" class="sub_m" value="登 录" />
                          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
				          @include('home.block.email')
				      </form>

				 </div>
		   </div>         
		   <!-- end 邮箱 -->
		   <ul class="email">
		   <li><a href="">QQ邮箱</a></li>
		   <li><a href="">阿里云邮箱</a></li>
		   <li><a href="">163邮箱</a></li>
		   <li><a href="">162邮箱</a></li>
		   <li><a href="">搜狐邮箱</a></li>
		   <li><a href="">新浪邮箱</a></li>
		   <li><a href="">TOM邮箱</a></li>
		   <li><a href="">Hotmail</a></li>
		   <li><a href="">Outlook</a></li>
		   <li><a href="">263邮箱</a></li>
		    <div class="clear"></div>
		   </ul>
	</div>
</div>
<!-- end main -->
<!-- footer -->
@section('footer')
@include('home.block.footer')
@show
<!-- end footer -->
</body>
</html>
