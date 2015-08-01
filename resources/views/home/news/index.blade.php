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
							<?php if(!empty($all_new)):?>
							 	<?php foreach($all_new as $k=>$new_cat):?>
							 		<?php if($k == 0):?>
						    			<li><a href="" class="select_a"><?php echo $new_cat->cat_name ;?></a></li>
									<?php else:?>
										<li><a href=""><?php echo $new_cat->cat_name ;?></a></li>
									<?php endif;?>
								<?php endforeach;?>
							<?php endif;?>
							 <li><a href="" >分类</a></li>
						 </ul>
						 <div class="c_q_set"></div>
						 <div class="clear"></div>
				  </div>
				  <div class="index-box">
				  <!---->
					  <?php if(!empty($all_new)):?>
							<?php foreach($all_new as $k=>$new_cat):?>
								<?php if($k == 0):?>
					  				<div class="c_q_cont" style="display:block;">
										<ul class="new-list-ul">
											<?php if(!empty($new_cat->news)):?>
												<?php foreach($new_cat->news as $new):?>
													<li><a target="_blank" href="<?php echo $new->site_url ;?>"><?php echo $new->title ;?></a></li>
												<?php endforeach;?>
											<?php endif;?>
											<div class="clear"></div>
										</ul>
										<div class="clear"></div>
									</div>
								<?php else:?>
									  <div class="c_q_cont" style="display:none;">
										  <ul class="new-list-ul">
											  <?php if(!empty($new_cat->news)):?>
											  <?php foreach($new_cat->news as $new):?>
											  <li><a target="_blank" href="<?php echo $new->site_url ;?>"><?php echo $new->title ;?></a></li>
											  <?php endforeach;?>
											  <?php endif;?>
											  <div class="clear"></div>
										  </ul>
										  <div class="clear"></div>
									  </div>
								<?php endif;?>

						<?php endforeach;?>
						<?php endif;?>

                        <!-- 分类 -->
                      <div class="c_q_cont" style="display:none;">
                          <div class="subm" style="border:none;margin-top:0;">
                              <div class="subbox subb0 subbfr">
                                  <h1 class="subtt">新闻分类<em>·</em></h1>
                                  <div class="bd">
                                      <?php if(!empty($all_category)):?>
                                      <dl>
                                          <dt>[新闻分类]</dt>
                                          <?php foreach($all_category as $category):?>
                                              <dd class="line" style="width:275px;">

                                                  <ul>
                                                      <li><strong><a href="" target="_blank"><?php echo $category->cat_name;?></a></strong></li>
                                                      <?php if(!empty($category->child)):?>
                                                        <?php for($i=0; $i<5; $i++):?>
                                                            <li><a href="" target="_blank"><?php echo $category->child[$i]->cat_name;?></a></li>
                                                        <?php endfor;?>
                                                      <?php endif;?>
                                                  </ul>
                                              </dd>
                                          <?php endforeach;?>
                                       </dl>
                                      <?php endif;?>

                                  </div>
                              </div>

                          </div>
                      </div>
                      <!-- 分类 -->


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
