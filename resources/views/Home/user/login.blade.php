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
       <div class="login">
	          <div class="l_left">
			        <img src="/site/images/micpanda.png" width="359" height="461" />
			  </div>
			  <div class="l_right">
			        <div ><a href=""><img src="/site/images/logo.png" width="432" height="79" /></a></div>
					<div class="l_form">
					   <form method="post" action="<?php echo action('Home\UserController@postLogin') ;?>" class="ajax-form">
					      <table width="200" border="0">
							  <tr>
								<td colspan="2">
								    <input type="text" name="email" class="txt_login" placeholder="请输入邮箱" />
								</td>
							  </tr>
							  <tr>
								<td colspan="2">
								   <input type="password" name="password" class="txt_login" placeholder="请输入密码"/>
								</td>
							  </tr>
							  <tr>
								<td class="td_lg"> <input type="checkbox" name="readme" class="check_ipt"  /> 10天内免登录</td>
								<td class="td_lg">  <span>忘记密码</span></td>
							  </tr>
							  <tr>
							    <input name="_token" type="hidden" value="<?php echo csrf_token(); ?>" />
								<td><input type="submit" class="lgsubs lrbtn" value="登录" /></td>
								<td style="text-align:right;"><input type="button" class="rgbtns lrbtn" value="注册" /></td>
							  </tr>
						 </table>
                       </form>
					   <div class="hz_span">合作账号登录</div>
					   <div class="other_login">
					        <a href=""></a>
							<a href=""></a>
							<a href=""></a>
							<a href=""></a>
							<a href=""></a>
							<a href=""></a>
					   </div>
					</div>
			  </div>
			  <div class="clear"></div>
	   </div>
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
