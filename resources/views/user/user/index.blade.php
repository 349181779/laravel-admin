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
        var Socket_fd =  '<?php echo action("User\ChatController@postSocketFd") ;?>'
		<?php if(!empty(Session::get('user_info.user_name'))):?>
			var user_name	= "<?php echo Session::get('user_info.user_name');?>"
		<?php else:?>
			var user_name	= "<?php echo Session::get('user_info.email');?>"
		<?php endif;?>
		<?php $face = Session::get('user_info.face');?>
		var user_face	= "<?php echo get_user_info_face($face);?>"
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
<link rel="stylesheet" href="/layim/css/layim.css">
<script src="/layim/lay/layim.js"></script>

<script>
	$(function(){
		if($('.xxim_chatlist:has(li)')){
			$('.xxim_parentname').trigger('click');
			$('.xxim_chatlist li:first-child').trigger('click')
		}

	})

	function addUser(obj){
		var _this = $(obj);

		layer.open({
			type: 2,
			skin: 'layui-layer-rim', //加上边框
			area: ['520px', '440px'], //宽高
			content:'<?php echo action("User\UserController@getAddFriend") ;?>'
		});

	}
</script>
@show
<!-- end footer -->
</body>
</html>
