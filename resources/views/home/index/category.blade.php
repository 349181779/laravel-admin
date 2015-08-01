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
                <h1 class="subtt">网址分类<em>·</em></h1>
                <div class="bd">

                    <dl>
                        <dt>[网址分类]</dt>
                        <dd>
                            <ul>
                                <?php if($all_category):?>
                                    <?php foreach($all_category as $category):?>
                                        <li><a href="<?php echo action('Home\IndexController@getInfo', [$category->id]) ;?>" target="_blank"><?php echo $category->cat_name;?></a></li>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </ul>
                        </dd>
                    </dl>
                </div>
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
