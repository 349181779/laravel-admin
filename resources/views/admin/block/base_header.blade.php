<?php echo Html::style('/assets/css/loader-style.css'); ?>
<?php echo Html::style('/assets/css/bootstrap.min.css'); ?>
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<?php echo Html::script('http://html5shim.googlecode.com/svn/trunk/html5.js');?>
<![endif]-->

<?php echo Html::script('/assets/js/jquery.min.js'); ?>
<?php echo Html::script('/cookie/cookie.js'); ?>
<script>
    //定义全局url
    fileUrl             = '<?php echo config("config.file_url");?>';//资源网址
    choseImageDialog    = "<?php echo url('admin/resource/chose-image-dialog');?>";//弹出选择图片提示框 url
    getCityUlr          = "<?php echo createUrl('Admin\RegionController@getAllRegion') ?>";//获得全部地址
    getAreaUlr          = "<?php echo createUrl('Admin\RegionController@getCurrentArea') ?>";//获得全部区域
</script>
<style>
    .wrap-fluid {
        width:84%;
        margin-left: 250px;
        float: left;
    }
</style>