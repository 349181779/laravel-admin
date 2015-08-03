<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('base_header')
@include('home.block.base_header')
	<script>
		var friend = '<?php echo action("User\UserController@postFriend") ;?>';
		var group = '<?php echo action("User\UserController@postGroup") ;?>'
		var chatlog = '<?php echo action("User\UserController@postChatlog") ;?>'
		var groups = '<?php echo action("User\UserController@postGroups") ;?>'
		var sendurl = '<?php echo action("User\ChatController@postSendMessage") ;?>'
	</script>
@show
</head>

<body>
<!-- top -->
<div class="top">
      @section('header')
          @include('user.block.header')
      @show

	
</div>
<!-- end top -->
<!-- main -->
<div class="main">
	<div class="wrap">

		<div class="sodiv tubiao">
			<div class="so_logo"><img src="/site/images/sologo.png" width="363" height="66" /></div>
			@include('home.block.search')
			<!-- end -->
		</div>

		<!-- 个人社区 -->
		<div><a href=""><img src="/site/images/sologo.png" width="200" /></a></div>
		<div class="grsq_div">
			<!--上-->
			<div class="grsq_tle">
				<div class="g_l_nav">

				</div>
				<div class="g_r_say">聊天窗口</div>
				<div class="clear"></div>
			</div>
			<!-- end 上 -->
			<div class="grsq_box">
				<div class="grsp_left">

					<div class="grsp-box" style="display:none;">
						社区
					</div>
					<div class="grsp-box" style="display:none;">
						新闻
					</div>

				</div>
				<div class="grsp_right">

				</div>
				<div class="clear"></div>

			</div>
		</div>
		<!-- end 个人社区 -->

	</div>
</div>
<!-- end main -->
<!-- footer -->
@section('footer')
@include('home.block.footer')
<!--<script src="/layim/lay/layer/layer.min.js"></script>-->
<link rel="stylesheet" href="/layim/css/layim.css">
<script src="/layim/lay/layim.js"></script>
@show
<!-- end footer -->
</body>
</html>
