<div class="header">
      <div class="wrap">
	        <div class="nav">
			      <a href="">导航</a>
				  <a href="">新闻</a>
				  <a href="">查询</a>
				  <a href="">邮箱</a>
				  <a href="">搜索</a>
				  <a href="">应用</a>
			</div>
			<div class="set">
			    <?php if(is_user_login() <= 0 ):?>
			        <span class="shezhi">设置</span>
                    <span><a href="<?php echo action('Home\UserController@getRegister') ;?>">注册</a></span>
                    <span><a href="<?php echo action('Home\UserController@getLogin') ;?>">登录</a></span>
                <?php else :?>
			        <span class="shezhi">设置</span>
                    <span><a onclick="logout()" href="javascript::void(0)">退出</a></span>
                    <span>欢迎：<?php echo Session::get('user_info.user_name') ;?></span>
			    <?php endif;?>

			</div>
	  </div>
    </div> 