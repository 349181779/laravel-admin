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
                <a href="/" class="nvhm" title="首页">首页</a><em>»</em><a href="/forum/index/index.html">好家长论坛</a> <em>›</em><a href="/forum/index/forum/id/2.html">暖心SPA</a><em>›</em><span>七句话考验你是否真爱孩子</span>
            </div>
        </div>
        <div class="content">
            <div class="c_qiehuan">
                <!---->
                <div class="c_q_title">
                    <h2><?php echo $data->title; ?> </h2>
                    <div class="c_q_set">
                        <span>回复</span>
                        <span>收藏</span>
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
                                <p><a href=""> 春天的阳光 </a></p>
                            </div>
                            <div class="forum_cr">
                                <div class="post_content">
                                    <a class="ribbion-green">楼主</a>
                                    <div class="post_title">

                                        <div class="small sub_title"> <br>
                                            <a href="/usercenter/index/index/uid/1.html" ucard="1" class="text-primary" data-hasqtip="8"><?php echo $user_profile->user_name ;?></a> <?php echo $data->created_at; ?> 发表在<a href="/forum/index/forum/id/2.html">【暖心SPA】</a> <a title="喜欢" class="support_btn" table="post" row="4" uid="1" jump="no">
                                                <i id="ico_like" class="support_nolike"></i>
                                            </a><span id="support_Forum_post_4_pos"><span id="support_Forum_post_4"></span> </span>
                                            <span class="num">0</span>
                                            <script>var SUPPORT_URL ="/index.php?s=/home/addons/execute/_addons/support/_controller/support/_action/dosupport.html";bindSupport();</script> </div>
                                    </div>
                                    <div class="fp_c">
                                        <?php echo $data->contents; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="clear"></div>
                            <hr class="post_line">
                            <div class="">
                                <div class="forum_cl">
                                    <p><img src="/site/images/ykcanma.jpg" /></p>
                                    <p><a href=""> 春天的阳光 </a></p>
                                </div>
                                <div class="forum_cr">
                                    <div class="post_content">
                                        <div class="fp_c">
                                            <p>“你是姐姐，要让着妹妹。”</p>
                                            <img src="/site/images/ding.gif" />
                                            　											<img src="/site/images/ding.gif" />
                                            <img src="/site/images/ding.gif" />
                                        </div>
                                        <p class="pull-right text-muted">
                                            沙发
                                            发表于 2015-06-18 15:15
                                            <a href="javascript:" class="reply_btn" args="18" id="reply_btn_18">回复(0)</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <hr class="post_line">
                            <div class="page_bt page_btn">
                                <ul>
                                    <li class="pagenum"><a>1</a></li>
                                    <li class="pagenum"><a>2</a></li>
                                    <li class="pagenum"><a>3</a></li>
                                    <li class="pagenum"><a>4</a></li>
                                    <li class="pagenum"><a>5</a></li>
                                    <li class="pagenum"><a>6</a></li>
                                    <li class="pagenum"><a>7</a></li>
                                    <li class="pagenum"><a>8</a></li>
                                </ul>
                                <div class="clear"></div>
                            </div>
                            <div class="replylogin_forum">
                                <h3><a href="">发表回复</a></h3>
                                <form id="replylogin_form" action="./logins.jsp" method="post">
                                    <input type="hidden" name="type" value="1">
                                    <input type="hidden" name="url" id="replylogin_url" value="">
                                    <input type="hidden" name="product" value="bbs">
                                    帐号:
                                    <input name="username" type="text" tabindex="11" class="replylogin_input" id="replyloginUsername">
                                    密码:
                                    <input name="password" type="password" tabindex="12" class="replylogin_input" id="replyloginPassword">
                                    <label><input name="savelogin" type="checkbox" value="1" tabindex="13">下次自动登录</label>
                                    <input type="submit" value="登录" class="replylogin_submit">
                                    <a href="" target="_blank">注册</a>
                                    <div id="ueditor_replace"><textarea rows="8" cols="60" class="autosave" name="message" id="message" onkeydown="ctlent(event);" tabindex="2"></textarea></div>
                                    <p class="btns">
                                        <button type="submit" name="replysubmit" id="postsubmit" value="replysubmit" tabindex="2">发表</button>
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
