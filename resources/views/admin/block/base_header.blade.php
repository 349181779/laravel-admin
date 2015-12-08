<link rel="stylesheet" href="<?php echo elixir('dist/base.css');?>">
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<?php echo Html::script('http://html5shim.googlecode.com/svn/trunk/html5.js');?>
<![endif]-->
<script src="<?php echo elixir('dist/base.js');?>"></script>
<script>
    //定义全局url
    fileUrl             = '<?php echo config("config.file_url");?>';//资源网址
    choseImageDialog    = "<?php echo url('admin/resource/chose-image-dialog');?>";//弹出选择图片提示框 url
</script>
<style>
    .wrap-fluid {
        width:84%;
        margin-left: 250px;
        float: left;
    }
</style>