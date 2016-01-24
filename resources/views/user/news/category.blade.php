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
                            <?php foreach($all_category as $k=>$new_cat):?>
                                <li><a href="<?php echo action('User\NewsController@getIndex', ['id'=> $new_cat->id]);?>"><?php echo $new_cat->cat_name ;?></a></li>
                            <?php endforeach;?>
                        <?php endif;?>
                        <li><a href="" class="select_a" >分类</a></li>
                        <li><a href="javascript:void(0)" onclick="chose(this)" class="select_a" >选择分类</a></li>
                    </ul>
                    <div class="c_q_set"></div>
                    <div class="clear"></div>
                </div>
                <div class="index-box">
                    <!-- 分类 -->
                    <div class="c_q_cont" >
                        <div class="subm" style="border:none;margin-top:0;">
                            <div class="subbox subb0 subbfr">
                                <div class="bd">
                                    <?php if(!empty($all_category)):?>
                                        <dl>
                                            <dt>[新闻分类]</dt>
                                            <?php foreach($all_category as $category):?>
                                                <dd class="line" style="width:275px;">

                                                    <ul>
                                                        <li><strong><a href="<?php echo action('Home\NewsController@getIndex', ['id'=> $category->id]);?>" target="_blank"><?php echo $category->cat_name;?></a></strong></li>
                                                        <?php if(!empty($category->child)):?>
                                                            <?php for($i=0; $i<5; $i++):?>
                                                                <li><a href="<?php echo action('Home\NewsController@getIndex', ['id'=> $category->child[$i]->id]);?>" target="_blank"><?php echo $category->child[$i]->cat_name;?></a></li>
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

    <script>
        /**
         * 选择分类
         *
         * @param obj
         */
        function chose(obj){
            var _this = $(obj);

            layer.open({
                title: "选择新闻分类",
                type: 2,
                content: '<?php echo action("User\NewsController@getChoseCategory") ;?>',
                cancel: function(){
                    layer.closeAll();
                    window.location.href = window.location.href
                }
            });
        }


    </script>
    @show
    <!-- end footer -->
</body>
</html>
