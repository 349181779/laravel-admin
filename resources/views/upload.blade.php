<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>
	<?php echo Html::script('/assets/js/jquery.min.js');?>
	<?php echo Html::style('/assets/css/bootstrap.css');?>
	<style>

	</style>
    <script>
    $(function(){
        layer.config({
            skin:'layer-ext-moon',
            extend:'./skin/mono/style.css',
            closeBtn:1,//关闭按钮
            shift:1,//动画
            shade:[0.9, '#fff'],//遮罩
            shadeClose:true,//是否点击遮罩关闭
            maxmin:true,//最大最小化。
            area:['800px', '500px'],
            scrollbar:true//是否禁用浏览器滚动条
        });


    })

    function a(){
           layer.open({
                type: 2,
                content: "<?php echo url('tools/upload/uploadview');?>" //这里content是一个普通的String
           });
    }
    </script>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-sm-2">
                 <a href="javascript:void(0)" onclick="a()">11</a>
            </div>
        </div>
    </div>


    <div class="container hidden">

        <div class="row">
            <div class="col-sm-2">上传到</div>
            <div class="col-sm-4">尺寸</div>
        </div>

        <div class="row">

        </div>

    </div>


	<!-- Scripts -->

	<script src="/layer-v1.9.3/layer/layer.js"></script>
</body>
</html>
