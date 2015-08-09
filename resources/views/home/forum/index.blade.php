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
            <div class="so_logo"><a href=""><img src="/site/images/sologo.png" width="363" height="66" /></a></div>
            @include('home.block.search')

            <!-- end -->
        </div>
        <!-- 新闻 -->
        <div class="content">
            <div class="c_qiehuan">
                <!---->
                <div class="c_q_title">
                    <ul>
                        <?php if(!empty($all_hot_category)):?>
                            <?php foreach($all_hot_category as $k=>$forum_cat):?>
                                <li><a <?php if($forum_cat->id == (int)$_GET['cat_id']){echo 'class="select_a"';}?> href="<?php echo action('Home\ForumController@getIndex', ['cat_id' => $forum_cat->id]) ;?>" ><?php echo $forum_cat->cat_name;?></a></li>
                            <?php endforeach;?>
                        <?php endif;?>

                        <li><a href="<?php echo action('Home\ForumController@getCategory') ;?>" >其它</a></li>
                    </ul>
                    <div class="c_q_title width">
                          <span><a href="<?php echo action('User\ForumController@getAdd') ;?>">发贴</a></span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="index-box">

                    <div class="c_q_cont" style="display:block;">

                        <table border="0" cellspacing="0" cellpadding="0" class="fl_tb" width="100%">
                            <tr>
                                <th scope="col" class="common"><div align="left">主题</div></th>
                                <th scope="col"><div align="left">作者</div></th>
                                <th scope="col"><div align="left">点击</div></th>
                                <th scope="col"><div align="left">回复</div></th>
                                <th scope="col"><div align="left">最后发表</div></th>
                            </tr>
                            <?php if(!empty($all_forum)):?>
                            <?php foreach($all_forum as $forum):?>
                            <tr>
                                <td class="common"><a href="" target="_blank"><?php echo $forum->title;?></a></td>
                                <td class="by"><a target="_blank" href=""><?php echo $forum->title;?></a></td>
                                <td class="digit"><?php echo $forum->title;?></td>
                                <td class="num"><?php echo $forum->title;?> </td>
                                <td class="by kmhf"><?php echo $forum->created_at;?></td>
                            </tr>
                                <?php endforeach;?>
                            <?php endif;?>

                        </table>

                        <div class="clear"></div>
                        <div class="page_bt">
                            <ul>
                                <?php echo $all_forum->render() ;?>
                            </ul>
                            <div class="clear"></div>
                        </div>
                        <!---->
                    <!---->
                    <div class="c_q_cont" style="display:none;"><!-- 分类 -->
                        <div class="subm" style="border:none;margin-top:0;">
                            <div class="subbox subb0 subbfr">
                                <div class="bd">
                                    <?php if(!empty($all_category)):?>
                                        <dl>
                                            <dt>[论坛版块分类]</dt>
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
                        <!-- 分类 --></div>
                    <!---->
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
