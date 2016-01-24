<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@section('base_header')
    <link media="all" type="text/css" rel="stylesheet" href="/assets/css/bootstrap.css">
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
                        <?php if(!empty($all_category)):?>
                            <?php foreach($all_category as $forum_cat):?>
                                <li><a href="<?php echo action('Home\ForumController@getIndex', ['cat_id' => $forum_cat->id]) ;?>" ><?php echo $forum_cat->cat_name;?></a></li>
                            <?php endforeach;?>
                        <?php endif;?>

                        <li><a href="<?php echo action('Home\ForumController@getCategory') ;?>" class="select_a">其它</a></li>
                    </ul>
                    <div class="c_q_title width">
                          <span>发贴</span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="index-box">

                    <!---->
                    <div class="c_q_cont container-fluid" style="display:block;">

                        <div style="margin: 50px 0;">
                            <form class="form-horizontal bucket-form ajax-form" action="<?php echo action('User\ForumController@postAdd') ;?>" method="post">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><strong>标题：</strong></label>
                                    <div class="col-sm-3">
                                        <input type="text" name="title" class="form-control" datatype="*" errormsg="" >
                                        <span class="help-block"></span>

                                        <div class="alert alert-danger hide" role="alert">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span class="sr-only">Error:</span>
                                            <span class="err_message"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><strong>所属分类：</strong></label>
                                    <div class="col-sm-3">

                                        <select name="forum_cat_id" >
                                            <?php if($all_merge_category):?>
                                                <?php foreach($all_merge_category as $k=>$category):?>
                                                    <option value="<?php echo $category['id'];?>"   >
                                                        <?php if($category['level'] > 0 ){echo str_repeat('&nbsp;==', $category['level']);}?>
                                                        <?php echo $category['cat_name'];?>
                                                    </option>
                                                <?php endforeach;?>
                                            <?php endif;?>
                                        </select>

                                        <span class="help-block"></span>

                                        <div class="alert alert-danger hide" role="alert">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span class="sr-only">Error:</span>
                                            <span class="err_message"></span>
                                        </div>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><strong>内容：</strong></label>
                                    <div class="col-sm-8">
                                        @include('UEditor::head')
                                        <!-- 加载编辑器的容器 -->
                                        <script id="contents" name="contents" type="text/plain">

                                        </script>

                                        <!-- 实例化编辑器 -->
                                        <script type="text/javascript">
                                            var ue = UE.getEditor('contents', {
                                                initialFrameHeight : 500
                                            });
                                            ue.ready(function() {
                                                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
                                            });
                                        </script>

                                        <span class="help-block"></span>

                                        <div class="alert alert-danger hide" role="alert">
                                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                            <span class="sr-only">Error:</span>
                                            <span class="err_message"></span>
                                        </div>
                                    </div>
                                </div>


                                <input name="_token" type="hidden" value="<?php echo csrf_token(); ?>"/>
                                <button type="submit" style="display: block;margin: 0 auto;" class="btn btn btn-success">确认</button>
                            </form>
                        </div>


                    </div>
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
