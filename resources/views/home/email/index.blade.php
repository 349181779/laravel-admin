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
				      账号：<input type="text" class="m_txt" />
					  邮箱：<select class="m_sel"><option></option></select>
					  密码：<input type="text"  class="m_txt" />
					  <input type="submit" class="sub_m" value="登 录" />
				 </div>
		   </div>
		   <!-- end 邮箱 -->
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
