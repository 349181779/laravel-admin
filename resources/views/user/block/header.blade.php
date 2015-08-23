<script>
    var socket_prot = <?php echo config('swoole.web_socket_port');?>;
    var save_user_socket = "<?php echo action('User\ChatController@postSaveUserWebSocketFd') ;?>";
</script>
<script src="/js/user_base.js"></script>

<div class="header">
      <div class="wrap">
	        <div class="nav">
				<a href="/">首页</a>
			      	<a href="<?php echo action('User\IndexController@getIndex') ;?>">导航</a>
					<a href="<?php echo action('Home\NewsController@getIndex') ;?>">新闻</a>
					<a href="<?php echo action('Home\EmailController@getIndex') ;?>">邮箱</a>
					<a href="<?php echo action('Home\SearchController@getIndex') ;?>">搜索</a>
					<a href="<?php echo action('Home\ForumController@getIndex') ;?>">论坛</a>
				  	<a href="<?php echo action('User\UserController@getIndex') ;?>">聊天</a>
			</div>
			<div class="set">
			    <?php if(is_user_login() <= 0 ):?>
			        <span><a href="<?php echo action('Home\UserController@getRegister') ;?>">注册</a></span>
                    <span><a href="<?php echo action('Home\UserController@getLogin') ;?>">登录</a></span>
                <?php else :?>
					<span class="shezhi"><a href="<?php echo action('User\UserController@getProfile') ;?>">设置</a></span>
                    <span><a onclick="logout()" href="javascript::void(0)">退出</a></span>
					<span>欢迎：<a href="<?php echo action('User\IndexController@getIndex') ;?>">
							<?php if(!empty(Session::get('user_info.user_name'))):?>
								<?php echo Session::get('user_info.user_name');?>
							<?php else:?>
								<?php echo Session::get('user_info.email');?>
							<?php endif;?>
						</a></span>
				<?php endif;?>

			</div>
	  </div>
    </div>

