<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>
	<?php echo Html::script('/assets/js/jquery.min.js');?>
	<?php echo Html::style('/assets/css/bootstrap.css');?>
    <link href="/assets/css/icons-style.css" rel="stylesheet">

	<style>
	    .center_btn{margin: 0 auto;display: block;width: 100px;height: 30px;}
        .warp-upload{width: 500px;height: 300px;margin: 10px auto;}
	</style>

</head>
<body>


    <div class="container">

        <div class="row">
            <div class="col-sm-2">上传到</div>
            <div class="col-sm-4">尺寸</div>
        </div>

        <div class="row" style="height: 200px;">

            <div class="row warp-upload">
                <div class="row">
                    <span class="entypo-upload"></span>
                    <button class="btn btn-info center_btn">上传</button>
                </div>

            </div>

        </div>
    </div>
</body>
</html>
