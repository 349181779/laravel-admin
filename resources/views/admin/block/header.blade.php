<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
@include('admin.block.base_header')
<?php echo Html::style('/assets/css/style.css');?>
<?php echo Html::style('/assets/js/button/ladda/ladda.min.css');?>
<script>
    var logout_url = '<?php echo createUrl("Admin\HomeController@getLogout") ;?>';
</script>
</head>
