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
           <div class="sodiv tubiao">
		          	<div class="so_logo"><img src="/site/images/sologo.png" width="363" height="66" /></div>
			   		@include('home.block.search')
				  <!-- end -->
		   </div>
		   <!-- 新闻 -->
		   <div class="content">
	       <div class="c_qiehuan">
		          <!---->
				  <div class="c_q_title">
				         <ul>
							<?php if(!empty($all_category)):?>
							 	<?php foreach($all_category as $new_cat):?>
							 		<?php if($new_cat->id == (int)$_GET['id']):?>
						    			<li><a href="<?php echo action('Home\NewsController@getIndex', ['id'=> $new_cat->id]);?>" class="select_a"><?php echo $new_cat->cat_name ;?></a></li>
									<?php else:?>
										<li><a href="<?php echo action('Home\NewsController@getIndex', ['id'=> $new_cat->id]);?>"><?php echo $new_cat->cat_name ;?></a></li>
									<?php endif;?>
								<?php endforeach;?>
							<?php endif;?>
							 <li><a href="<?php echo action('Home\NewsController@getCategory');?>" >分类</a></li>
						 </ul>
						 <div class="c_q_set"></div>
						 <div class="clear"></div>
				  </div>
				  <div class="index-box">
				  <!---->
					  <?php if(!empty($all_new)):?>
						  <div class="c_q_cont" style="display:block;">
							  <ul class="new-list-ul">
								  <?php foreach($all_new as $new):?>
									  <li><a target="_blank" href="<?php echo $new->site_url ;?>"><?php echo $new->title ;?></a></li>
								  <?php endforeach;?>
								  <div class="clear"></div>
							  </ul>
							  <div class="clear"></div>
						  </div>
						<?php endif;?>

					  <div class="page_bt">
						  <ul>
							  <?php echo $all_new->render(); ?>
						  </ul>
						  <div class="clear"></div>
					  </div>

		   </div>
	</div>
		   <!-- end 新闻 -->
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
