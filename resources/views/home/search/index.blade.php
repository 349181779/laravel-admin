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
           <div class="sodiv">
		          <div class="so_logo"><a href=""><img src="/site/images/sologo.png" width="363" height="66" /></a></div>
				  <ul class="subnav">
				        <li><a href="" class="liselect">网页</a></li>
						<li><a href="">新闻</a></li>
						<li><a href="">帖吧</a></li>
						<li><a href="">知道</a></li>
						<li><a href="">音乐</a></li>
						<li><a href="">图片</a></li>
						<li><a href="">视频</a></li>
						<li><a href="">地图</a></li>
						<li><a href="">文库</a></li>
				  </ul>
				  <!--  end subnav -->
				  <div>
				     <form method="post" action="" id="search-form">
				        <div class="so_left">

						     <input type="text" class="txt_so" id="search-input" value="" />
							 <div id="search_hotword" class="" style="display: block;"></div>
						</div>
						<input type="submit" class="so_sub" value="搜索一下"  />
						<div class="clear"></div>
				     </form>
					 <div class="search-span" id="search-suggest" style="display:none;">
							        <ul id="search-result">
									    <li class="">是的英文</li>
										<li class="">是的英文1</li>
										<li class="">是的英文2</li>
										<li class="">是的英文3</li>
									</ul>
					 </div>
				  </div>
				  <div  class="so_radio">
				          <span><input type="radio" checked="checked" name="radio" onfocus="" /> 百度 </span>
						  <span><input type="radio" name="radio"/> 谷歌 </span>
						  <span><input type="radio" name="radio"/> 搜狗 </span>
						  <span><input type="radio" name="radio"/> 必应 </span>
						  <span><input type="radio" name="radio"/> 雅虎</span>
				  </div>
				  <!---->
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
