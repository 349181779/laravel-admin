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

       <?php if(!empty($all_site)):?>
      <?php foreach($all_site as $site_cat):?>
		   <div class="seaou">
          <a href="javascript:void(0)"><?php echo $site_cat->cat_name;?></a>
            <?php if(!empty($site_cat->site)):?>
						<?php foreach($site_cat->site as $site):?>
				   			<a target="_blank" href="<?php echo $site->site_url ;?>"><?php echo $site->site_name ;?></a>
						<?php endforeach;?>
					  <?php endif;?>
       </div>
       <?php endforeach;?>
       <?php endif;?>
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
