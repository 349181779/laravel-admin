<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
    <link media="all" type="text/css" rel="stylesheet" href="/assets/css/bootstrap.css">
@section('base_header')
@include('home.block.base_header')
    <style>
        input{
            text-indent: 1em;}
    </style>
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
		<div class="chaxun-logo"><a href=""><img src="/site/images/sologo.png" /></a></div>
		<div class="chaxun-box bfff">
			<div class="user-inl">
				<dl class="user-inlmenu">
					<dt>个人资料</dt>
					<dd><a href="" class="select_a">基本资料</a></dd>
                    <dd><a href="">账号安全</a></dd>
					<dd><a href="">好友请求</a></dd>
                    <dd><a href="">头像</a></dd>
				</dl>
			</div>
			<div class="user-inr" >

				<!-- 主体信息 -->
				@include('user.user.profile.profile')

				<!-- 更改密码 -->
				@include('user.user.profile.update_password')

				<!-- 好友请求 -->
				@include('user.user.profile.add_friend')

                <!-- 头像 -->
                @include('user.user.profile.change_avatar')

			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
<!-- end main --><!-- footer -->
@section('footer')
@include('home.block.footer')
<script src="/date/YMDClass.js"></script>
<script src="/city/PCASClass.js"></script>
<script>

    function choseCity(province, city, area){


    }


    $(function(){

        new PCAS("user_profile[province]=<?php echo $user_profile->user_profile->province;?>,请选择省份","user_profile[city]=<?php echo $user_profile->user_profile->city;?>,请选择城市","user_profile[area]=<?php echo $user_profile->user_profile->area;?>,请选择地区");
        new PCAS("user_profile[home_province]=<?php echo $user_profile->user_profile->home_province;?>,请选择省份","user_profile[home_city]=<?php echo $user_profile->user_profile->home_city;?>,请选择城市","user_profile[home_area]=<?php echo $user_profile->user_profile->home_area;?>,请选择地区");

        <?php if(!empty($user_profile->birthday)):?>
            <?php $date = explode('-', $user_profile->birthday);?>
            new YMDselect('year', 'month', 'day', <?php echo $date[0] ;?>, <?php echo $date[1] ;?>, <?php echo $date[2] ;?>);
        <?php endif;?>

        <?php if(!empty($user_profile->sex)):?>
            $('select[name=sex]').val(<?php echo $user_profile->sex ;?>);
        <?php endif;?>

        <?php if(!empty($user_profile->user_profile->marriage)):?>
            $('select[name=marriage]').val(<?php echo $user_profile->user_profile->marriage ;?>);
        <?php endif;?>
    })
</script>
@show
<!-- end footer -->
</body>
</html>
