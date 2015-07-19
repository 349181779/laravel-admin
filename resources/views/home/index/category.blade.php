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
          @include('home.block.top')
      @show

	
</div>
<!-- end top -->
<!-- main -->
<div class="main">
    <div class="wrap">

        <div class="subm">
            <div class="subbox subb0 subbfr">
                <h2 class="subtt"><?php echo $all_site->cat_info->cat_name;?></h2>
                <ul class="subul">
                    <?php if(!empty($all_site->all_site)):?>
                    <?php foreach($all_site->all_site as $site_cat):?>
                    <li>
                        <a target="_blank" href="<?php echo $site_cat->site_url ;?>"><?php echo $site_cat->site_name ;?></a>
                    </li>
                    <?php endforeach;?>
                    <?php endif;?>
                    <div class="clear"></div>
                </ul>
            </div>
            <div class="page_bt">
                <ul>
                    <?php echo $all_site->all_site->render(); ?>
                </ul>
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
