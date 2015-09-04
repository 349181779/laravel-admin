<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@section('base_header')
@include('home.block.base_header')
    <style>
        .c_q_set span{display: inline-block;height: 40px;padding: 0 10px;
            margin-right: 5px: }
    </style>
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
    <div class="content">
	       <div class="c_qiehuan">
		          <!---->
				  <div class="c_q_title">
				         <ul>
						     <li><a href="" class="select_a">综合导航</a></li>
                             <li><a href="<?php echo action('Home\QueryController@getIndex') ;?>">查询</a></li>
                             <li><a href="<?php echo action('Home\AppController@getIndex') ;?>">应用</a></li>
                             <li><a  href="<?php echo action('Home\IndexController@getCategory') ;?>" >分类</a></li>
						 </ul>
                      <?php if(Session::get('admin_info.id') > 0 ):?>
                        <div class="c_q_set"><span style="cursor: pointer;" onclick="addSite(this)">添加网址</span>  <span style="cursor: pointer;" onclick="addSiteCategory(this)">添加网址分类</span> <span style="cursor: pointer;" >设置</span></div>
                      <?php endif;?>

						 <div class="clear"></div>
				  </div>
				  <div class="index-box">
				  <!---->
				    <div class="c_q_cont" style="display:block;">
				        <div class="cq_cent">

						      <ul class="list_hf">
						      <?php if(!empty($all_site)):?>
                                <?php foreach($all_site as $site_cat):?>
                                <li>
                                   <h4 class="l_h_tl"><?php echo $site_cat->cat_name;?></h4>
                                   <div class="l_h_rt">

                                       <?php if(!empty($site_cat->site)):?>
                                        <?php foreach($site_cat->site as $site):?>
                                            <span><a target="_blank" href="<?php echo $site->site_url ;?>"><?php echo $site->site_name ;?></a></span>
                                        <?php endforeach;?>

                                           <?php if(count($site_cat->site) >= 32):?>
                                                <span class="in_more"><a target="_blank" href="<?php echo action('Home\IndexController@getInfo', [$site_cat->id]) ;?>">更多</a></span>
                                           <?php endif;?>

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

    <div class="page_bt">
        <ul>
            <?php echo $all_site->render(); ?>
        </ul>
        <div class="clear"></div>
    </div>

</div>

<!-- end main -->
<!-- footer -->
@section('footer')
@include('home.block.footer')

<script>
    <?php if(Session::get('admin_info.id') > 0 ):?>

    /**
     *  添加网址
     *
     */
    function addSite(obj){
        var _this = $(obj);

        layer.open({
            title: "添加网址",
            type: 2,
            skin: 'layui-layer-rim', //加上边框
            area: ['520px', '440px'], //宽高
            content:'<?php echo action("Home\IndexController@getAddSite") ;?>',
            cancel: function(){
                layer.closeAll();
                window.location.href = window.location.href
            }
        });

    }

    /**
     * 添加网址分类
     *
     * @param obj
     */
    function addSiteCategory(obj){
        var _this = $(obj);

        layer.open({
            title: "添加网址分类",
            type: 2,
            skin: 'layui-layer-rim', //加上边框
            area: ['520px', '440px'], //宽高
            content:'<?php echo action("Home\IndexController@getAddSiteCategory") ;?>',
            cancel: function(){
                layer.closeAll();
                window.location.href = window.location.href
            }
        });

    }
    <?php endif;?>
</script>
@show
<!-- end footer -->
</body>
</html>
