<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@section('base_header')
@include('home.block.base_header')
		<style>
			.mailSelect {
				float: none;
				position: relative;
				top: 16px;
				display: inline-block;
				width: 200px;
				height: 39px;
				border: 1px solid #CCC;
				color: #666;
				cursor: pointer;
				background-color:#e2e2e2;

			}
			.mailSelect em {
				display: block;
				overflow: hidden;
				float: left;
				width: 150px;
				height: 39px;
				line-height: 39px;
				text-align: center; font-style:normal;
				font-size: 14px;
				background-color:#fff;
				font-weight: bold;
			}
			.mailSelect i {
				display: block;
				overflow: hidden;
				float: right;
				width: 50px;
				height: 39px;background:url(/site/images/emailrt.jpg?__inline) right center no-repeat;
				text-indent: -9999px;
			}
			.mail-list{ position:absolute; width: 148px; line-height: 39px; top: 40px; right: 50px; border:1px solid #ccc; border-top:0px; background-color:#fff; z-index:999;}

		</style>
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
				      <form id="mailForm" method="post" action="">
				          账号：<input type="text" name="uName" value="" class="m_txt" id="mailUserName" />
                          邮箱：<div class="mailSelect mailSelectHover">
							  <em>请选择邮箱</em>
							  <i>箭头图标</i>

							  <div class="mail-list" style="display: none;" >
								  <ul>

								  </ul>
							  </div>
						  </div>

                          密码：<input type="password" name="uPw" id="mailPassword"  class="m_txt" />
                          <input type="submit" class="sub_m" value="登 录" />
						  <span id="mailParas" style="display:none;"></span>
                          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
				      </form>

				 </div>
		   </div>         
		   <!-- end 邮箱 -->
		   <ul class="email">
			   <?php if(!empty($all_email)):?>
				   <?php foreach($all_email as $email):?>
				   		<li><a target="_blank" href="<?php echo $email->site_url ;?>"><?php echo $email->name ;?></a></li>
				   <?php endforeach;?>
			   <?php endif;?>
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
