<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>管理系统</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
@include('admin.block.base_header')<?php echo Html::style('/assets/css/signin.css');?>
<link rel="stylesheet" href="http://static.womenshuo.com/@/womenshuo/lib/notice/toastr/toastr.css"/>
<script>
    $(function(){
        //验证表单
        $('form').Validform({
            label:".label",
            showAllError:true,
            tiptype:3

        });

        //提交表单
        $('form').ajaxForm({
            url : '<?php echo url("admin/login/login") ;?>',
            type : 'post',
            success : function(data){
                parseResponseJson(data);
            }
        })

    })
    </script>
</head>
<body>
<!-- Preloader -->
<div id="preloader">
  <div id="status">&nbsp;</div>
</div>
<div class="container">
  <div class="" id="login-wrapper">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div id="logo-login">
          <h1>管理系统 <span><?php echo Config::get('version.version') ;?></span> </h1>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="account-box">
          <form action="">
            <div>
              <div class="form-group">
                {{--<a href="#" class="pull-right label-forgot">Forgot email?</a>--}}
                <label for="inputUsernameEmail">用户名</label>
                <input type="text" name="email" id="inputUsernameEmail" class="form-control" datatype="e" placeholder="请输入用户名" >
                <p class="bg-warning Validform_checktip"></p>
              </div>
              <div class="form-group">
                {{--<a href="#" class="pull-right label-forgot">Forgot password?</a>--}}
                <label for="inputPassword">密码</label>
                <input type="password" name="password" id="inputPassword" class="form-control" datatype="*6-16"  placeholder="请输入密码">
                <p class="bg-warning Validform_checktip"></p>
              </div>
              <div class="checkbox pull-left">
                <label>
                  <input name="remember_me" type="checkbox">
                  记住用户名 </label>
              </div>
              <div class="row-block">
                <div class="row">
                  <div class="col-md-12 row-block">
                    <button class="btn btn btn-primary btn-block pull-cnter " type="submit"> 登 录 </button>
                  </div>
                </div>
              </div>
              <div class="row-block">
                <div class="row"> </div>
              </div>
            </div>
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
          </form>
        </div>
      </div>
    </div>
    <p>&nbsp;</p>
    <div style="text-align:center;margin:0 auto;">
      <h6 style="color:#fff;">Copyright(C)2014 womenshuo.com All Rights Reserved<br />
        womenshuo</h6>
    </div>
  </div>
</div>
@include('admin.block.base_js') 
<script src="http://static.womenshuo.com/jquery.form-3.50.min.js"></script> 
<script src="http://static.womenshuo.com/@/womenshuo/lib/validateValidform_v5.3.2_min.js"></script>
</body>
</html>
