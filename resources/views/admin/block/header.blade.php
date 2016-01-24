<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
=======
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
@include('admin.block.base_header')
<?php echo Html::style('/assets/css/style.css');?>
<?php echo Html::style('/assets/js/button/ladda/ladda.min.css');?>
<script>
<<<<<<< HEAD
    var logout_url = '<?php echo createUrl("Admin\HomeController@getLogout") ;?>';
</script>
</head>
=======
    var logout_url = '<?php echo url("admin/home/logout") ;?>';
</script>
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
