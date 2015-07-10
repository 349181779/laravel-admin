<?php echo Html::style('/assets/css/loader-style.css');?>
<?php echo Html::style('/assets/css/bootstrap.css');?>
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<?php echo Html::script('http://html5shim.googlecode.com/svn/trunk/html5.js');?>
<![endif]-->
<!-- Fav and touch icons -->
<link rel="shortcut icon" href="assets/ico/minus.png">
<?php echo Html::script('/assets/js/jquery.min.js');?>
<link rel="stylesheet" href="/toastr/toastr.css"/>
{{--<link href='http://fonts.useso.com/css?family=Open+Sans:300,400,600&subset=latin,latin-ext' rel='stylesheet'>--}}

<script>
    //定义全局url
    fileUrl             = '<?php echo config("config.file_url");?>';//资源网址
    choseImageDialog    = "<?php echo url('admin/resource/chose-image-dialog');?>";//弹出选择图片提示框 url
</script>