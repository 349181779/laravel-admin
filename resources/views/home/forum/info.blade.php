<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@section('base_header')
@include('home.block.base_header')
<link rel="stylesheet" href="/site/css/forum.css">
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
        <div class="chaxun-logo"><a href=""><img src="/site/images/sologo.png" /></a></div>
        <!-- 新闻 -->
        <div id="pt" class="bm cl">
            <div class="z">
                <a href="<?php echo action('Home\ForumController@getIndex') ;?>" class="nvhm" title="论坛">论坛</a><em>»</em>
                <?php if(!empty($data->location)):?>
                    <?php foreach($data->location as $location):?>
                        <a href="<?php echo action('Home\ForumController@getIndex', ['cat_id'=> $location['id']]) ;?>"><?php echo $location['cat_name'];?></a> <em>›</em>
                    <?php endforeach;?>
                <?php endif;?>
                <span><?php echo $data->title; ?></span>
            </div>
        </div>
        <div class="content">
            <div class="c_qiehuan">
                <!---->
                <div class="c_q_title">
                    <h2><?php echo $data->title; ?> </h2>
                    <div class="c_q_set">
                        <span>回复</span>
<!--                        <span>收藏</span>-->
                        <span><a href="<?php echo action('User\ForumController@getAdd') ;?>">发贴</a></span>
                        <?php if($data->user_info_id == is_user_login()):?>
                            <span><a href="<?php echo action('User\ForumController@getSave', ['aa' => $data->id]) ;?>">编辑</a></span>
                        <?php endif;?>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="index-box">
                    <!---->
                    <div class="c_q_cont" style="display:block;">

                        <div class="forum_c">
                            <div class="forum_cl">
                                <p><img src="/site/images/ykcanma.jpg" /></p>
                                <p><a href=""> <?php echo $user_profile->user_name ;?> </a></p>
                            </div>
                            <div class="forum_cr">
                                <div class="post_content">
                                    <a class="ribbion-green">楼主</a>
                                    <div class="post_title">

                                        <div class="small sub_title"> <br>
                                            <a href="/usercenter/index/index/uid/1.html" ucard="1" class="text-primary" data-hasqtip="8">
                                                <?php echo $user_profile->user_name ;?></a> <?php echo $data->created_at; ?>
                                                发表在<a href="<?php echo action('Home\ForumController@getIndex', ['cat_id' => $data->category->id]) ;?>">【<?php echo $data->category->cat_name;?>】</a>
                                                <a title="喜欢" class="support_btn" table="post" row="4" uid="1" jump="no">
                                                <i id="ico_like" class="support_nolike"></i>
                                            </a></div>
                                    </div>
                                    <div class="fp_c">
                                        <?php echo $data->contents; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="clear"></div>


                            <?php if(!empty($data->comment)):?>
                                <?php foreach($data->comment as $comment):?>
                                    <hr class="post_line">
                                    <div class="">
                                        <div class="forum_cl">
                                            <p><img src="/site/images/ykcanma.jpg" /></p>
                                            <p><a href=""> <?php echo $comment->user_info->user_name;?> </a></p>
                                        </div>
                                        <div class="forum_cr">
                                            <div class="post_content">
                                                <div class="fp_c">
                                                   <?php echo $comment->contents;?>
                                                </div>
                                                <p class="pull-right text-muted">
                                                    沙发
                                                    发表于 <?php echo $comment->created_at ;?>
                                                    <a href="javascript:" class="reply_btn" args="18" id="reply_btn_18">回复(0)</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <?php endforeach;?>
                            <?php endif;?>

                            <?php if($data->comment->lastPage() > 1):?>
                            <hr class="post_line">
                            <div class="page_bt page_btn">
                                <ul>
                                    <?php echo $data->comment->render() ;?>
                                </ul>
                                <div class="clear"></div>
                            </div>
                            <?php endif;?>

                            <div class="replylogin_forum">
                                <h3><a href="">发表回复</a></h3>

                                    <?php if(is_user_login() <= 0):?>
                                        帐号:<input name="username" type="text" tabindex="11" class="replylogin_input" id="replyloginUsername">
                                        密码:<input name="passowrd" type="password" tabindex="12" class="replylogin_input" id="replyloginPassword">

                                        <label><input name="savelogin" type="checkbox" value="1" tabindex="13">下次自动登录</label>

                                        <a  class="replylogin_submit" onclick="login(this)" >登陆</a>
                                        <a href='<?php echo action("Home\UserController@getRegister") ;?>' target="_blank">注册</a>

                                    <?php endif;?>

                                <form id="replylogin_form" action="<?php echo action('User\ForumController@postForumComment') ;?>" class="ajax-form" method="post">
                                    <div id="ueditor_replace">
                                        @include('UEditor::head')
                                        <!-- 加载编辑器的容器 -->
                                        <script id="contents" name="contents" type="text/plain">

                                        </script>

                                        <!-- 实例化编辑器 -->
                                        <script type="text/javascript">
                                            var ue = UE.getEditor('contents', {
                                                initialFrameHeight : 300
                                            });
                                            ue.ready(function() {
                                                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
                                            });
                                        </script>
                                    </div>
                                    <p class="btns">
                                        <input type="hidden" name="forum_id" value="<?php echo $data->id;?>" >
                                        <input type="hidden" name="node" value="0" >
                                        <input type="submit" value="发表" class="postsubmit">
                                    </p>
                                </form>
                                <!--<p class="text-muted" style="font-size: 3em; padding-top: 2em; padding-bottom: 2em; text-align:center; ">请<a style="font-size: 36px;" href="/home/user/login.html">登录</a>后发帖</p>-->
                            </div>
                        </div>
                        <div class="clear"></div>

                        <!---->
                        <!---->
                    </div>
                    <!---->
                    <div class="c_q_cont" style="display:none;">
                        论坛
                    </div>
                    <!---->
                    <div class="c_q_cont" style="display:none;">聊天室</div>
                    <!---->
                    <div class="c_q_cont" style="display:none;">商店</div>
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
