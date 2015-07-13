<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@section('base_header')
@include('home.block.base_header')
@show
<script type="text/javascript">
function bgChange(){
 var lis= document.getElementsByTagName('li');
 for(var i=0; i<lis.length; i+=2)
 lis[i].style.background = '#fff';
}
window.onload = bgChange;
</script>
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
	       <div class="chaxun-logo"><a href="/"><img src="/site/images/sologo.png" /></a></div>
	       <div class="chaxun-box">
		           <p class="chaxun-p">查询</p>
					<div class="query">
					    <?php if(!empty($all_query)):?>
					    <?php foreach($all_query as $query_cat):?>
						<div class="item">
							<ul class="list">
							  <li><?php echo $query_cat->cat_name;?></li>
							    <?php for($i = 0; $i<=10; $i++):?>
							        <li><a target="_blank" href="<?php echo $query_cat->query[$i]->site_url ;?>"><?php echo $query_cat->query[$i]->name ;?></a></li>
							    <?php endfor;?>
                              <li><a href="" class="more">更多</a></li>
							</ul>
						</div>
						<?php endforeach;?>
                        <?php endif;?>

						<div class="clear"></div>
					</div>

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
