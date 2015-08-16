<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@section('base_header')
@include('home.block.base_header')
@show
<script type="text/javascript">

</script>
</head>

<body>
<!-- top -->
<div class="top">
      @section('header')
          	@include('home.block.header')
			@include('home.block.top')
      @show

</div>
<!-- end top -->
<!-- main -->
<div class="main">
	<div class="content">
		<div class="c_qiehuan">
			<!---->
			<div class="c_q_title">
				<ul>

					<li><a href="<?php echo action('Home\IndexController@getIndex') ;?>" >综合导航</a></li>

					<li><a href="" class="select_a">查询导航</a></li>
					<li><a href="<?php echo action('Home\AppController@getIndex') ;?>">应用</a></li>
					<li><a href="<?php echo action('Home\IndexController@getCategory') ;?>">分类</a></li>
				</ul>
				<div class="clear"></div>
			</div>
			<div class="index-box">
				<!---->
				<div class="c_q_cont" style="display:block;">
					<div class="cq_cent">

						<ul class="list_hf">
							<?php if(!empty($all_query)):?>
								<?php foreach($all_query as $query_cat):?>
									<li>
										<h4 class="l_h_tl"><?php echo $query_cat->cat_name;?></h4>
										<div class="l_h_rt">

											<?php if(!empty($query_cat->query)):?>
												<?php foreach($query_cat->query as $query):?>
													<span><a target="_blank" href="<?php echo $query->site_url ;?>"><?php echo $query->name ;?></a></span>
												<?php endforeach;?>
												<span class="in_more"><a target="_blank" href="<?php echo action('Home\IndexController@getInfo', [$query->id]) ;?>">更多</a></span>
											<?php endif;?>
										</div>
										<div class="clear"></div>
									</li>
								<?php endforeach;?>
							<?php endif;?>
						</ul>
						<div class="clear"></div>
					</div>

					<!---->
				</div>
				<!---->

				<!---->
			</div>
		</div>
	</div>
</div>
<div class="page_bt">
	<ul>
		<?php echo $all_query->render(); ?>
	</ul>
	<div class="clear"></div>
</div>
<!-- end main -->
<!-- footer -->
@section('footer')
@include('home.block.footer')
@show
<!-- end footer -->
</body>
</html>
