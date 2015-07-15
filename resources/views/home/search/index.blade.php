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
                    @include('home.block.search')
				  <!---->
		   </div>
		   <div class="seaou">
			   <a href="https://www.baidu.com">搜索</a>
			   <a href="https://www.baidu.com">百度</a>
			   <a href="http://www.glgoo.com/">谷歌</a>
			   <a href="http://www.sogou.com/">搜狗</a>
			   <a href="http://www.youdao.com/">有道</a>
			   <a href="http://cn.bing.com/">必应</a>
			   <a href="https://www.yahoo.com/">雅虎</a>
			   <a href="http://iask.sina.com.cn/">爱问知识</a>
			   <a href="http://www.haosou.com/">奇虎</a>
			   <a href="http://dict.cn/">海词</a>
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
