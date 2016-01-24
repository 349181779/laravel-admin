<<<<<<< HEAD
<?php echo Html::style('/assets/css/loader-style.css'); ?>
<?php echo Html::style('/assets/css/bootstrap.css'); ?>
=======
<?php echo Html::style('/assets/css/loader-style.css');?>
<?php echo Html::style('/assets/css/bootstrap.css');?>
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<?php echo Html::script('http://html5shim.googlecode.com/svn/trunk/html5.js');?>
<![endif]-->
<<<<<<< HEAD

<?php echo Html::script('/assets/js/jquery.min.js'); ?>
<?php echo Html::script('/cookie/cookie.js'); ?>
<script>
    //定义全局url
    choseImageDialog    = "<?php echo createUrl('Admin\Image\ImageController@getChoseImage');?>";//弹出选择图片提示框 url
    getCityUlr          = "<?php echo createUrl('Admin\RegionController@getAllRegion') ?>";//获得全部地址
    getAreaUlr          = "<?php echo createUrl('Admin\RegionController@getCurrentArea') ?>";//获得全部区域
    getMapUlr          = "<?php echo createUrl('Admin\Tools\MapController@getIndex') ?>";//获得地图区域
=======
<!-- Fav and touch icons -->
<link rel="shortcut icon" href="assets/ico/minus.png">
<?php echo Html::script('/assets/js/jquery.min.js');?>
<link rel="stylesheet" href="/toastr/toastr.css"/>
{{--<link href='http://fonts.useso.com/css?family=Open+Sans:300,400,600&subset=latin,latin-ext' rel='stylesheet'>--}}

<script>
    //定义全局url
    fileUrl             = '<?php echo config("config.file_url");?>';//资源网址
    choseImageDialog    = "<?php echo url('admin/resource/chose-image-dialog');?>";//弹出选择图片提示框 url
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
</script>