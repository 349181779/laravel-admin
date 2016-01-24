<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<link rel="stylesheet" href="<?php echo elixir('dist/base.css');?>">
	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="<?php echo elixir('dist/base.js');?>"></script>
	<style>
		body{background: #fff;  }
        form{margin: 20px 0;}
	</style>
</head>
<body>
<div class="container">
    <h3>创建<?php echo $table_name;?>表配置信息</h3>
    <form class="form-horizontal ajax-form" method="post" action="<?php echo createUrl('\Yangyifan\AutoBuild\Http\Controllers\Config\ControllerController@postCreateConfig') ;?>">
        <?php if(!empty($schema_list)):?>
            <?php foreach ($schema_list as $schema) :?>

                <?php if($schema['col_name'] == 'id'){continue;}//如果是id,则跳过?>
                <div class="form-group">
                    <input type="hidden" name="<?php echo $schema['col_name'];?>[name]" value="<?php echo $schema['col_name'];?>">
                    <input type="hidden" name="<?php echo $schema['col_name'];?>[schema_type]" value="<?php echo $schema['type'];?>">

                    <label class="col-sm-1" for="exampleInputEmail1"><?php echo $schema['col_name'];?></label>

                    <div class="col-sm-11">
                        <div class="row">

                            <!-- 标题 -->
                            <div class="form-group col-sm-4">
                                <label for="inputEmail3" class="col-sm-3 control-label">标题</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="<?php echo $schema['col_name'];?>[title]" value="<?php echo $schema['comment'] ? : $schema['col_name'];?>">
                                </div>
                            </div>
                            <!-- 标题 -->

                            <!-- 是否允许列表页搜索 -->
                            <div class="form-group col-sm-4">
                                <label for="inputEmail3" class="col-sm-3 control-label">是否允许列表页搜索</label>
                                <div class="col-sm-9">
                                    <label class="radio-inline">
                                        <input type="radio" name="<?php echo $schema['col_name'];?>[is_search]" value="1" checked="checked"> 是
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="<?php echo $schema['col_name'];?>[is_search]" value="2"> 否
                                    </label>
                                </div>
                            </div>
                            <!-- 是否允许列表页搜索 -->

                            <!-- 是否列表页显示 -->
                            <div class="form-group col-sm-4">
                                <label for="inputEmail3" class="col-sm-3 control-label">是否列表页显示</label>
                                <div class="col-sm-9">
                                    <label class="radio-inline">
                                        <input type="radio" name="<?php echo $schema['col_name'];?>[is_list]" value="1" checked="checked"> 是
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="<?php echo $schema['col_name'];?>[is_list]" value="2"> 否
                                    </label>
                                </div>
                            </div>
                            <!-- 是否列表页显示 -->

                            <!-- 表单类型 -->
                            <div class="form-group col-sm-4">
                                <label for="inputEmail3" class="col-sm-3 control-label">表单类型</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="<?php echo $schema['col_name'];?>[type]">
                                        <option value="">请选择</option>
                                        <?php if(!empty($form_type)):?>
                                            <?php foreach ($form_type as $type => $title) : ?>
                                                <?php if($type == 'text'):?>
                                                    <option selected="selected" value="<?php echo $type;?>"><?php echo $title;?></option>
                                                <?php endif;?>
                                                    <option value="<?php echo $type;?>"><?php echo $title;?></option>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </select>
                                </div>
                            </div>
                            <!-- 表单类型 -->

                            <!-- 默认值 -->
                            <div class="form-group col-sm-4">
                                <label for="inputEmail3" class="col-sm-3 control-label">默认值</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="<?php echo $schema['col_name'];?>[default]" value="">
                                </div>
                            </div>
                            <!-- 默认值 -->

                            <!-- 表单提示 -->
                            <div class="form-group col-sm-4">
                                <label for="inputEmail3" class="col-sm-3 control-label">表单提示</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="<?php echo $schema['col_name'];?>[notice]" value="">
                                </div>
                            </div>
                            <!-- 表单提示 -->

                            <!-- 表单需要定义的class -->
                            <div class="form-group col-sm-4">
                                <label for="inputEmail3" class="col-sm-3 control-label">表单需要定义的class</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="<?php echo $schema['col_name'];?>[class]" value="">
                                </div>
                            </div>
                            <!-- 表单需要定义的class -->

                            <!-- 表单验证错误提示 -->
                            <div class="form-group col-sm-4">
                                <label for="inputEmail3" class="col-sm-3 control-label">表单验证错误提示</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="<?php echo $schema['col_name'];?>[err_message]" value="">
                                </div>
                            </div>
                            <!-- 表单验证错误提示 -->

                        </div>
                    </div>

                </div>
            <?php endforeach;?>
        <?php endif;?>
            <input type="hidden" name="table_name"  value="<?php echo $table_name;?>">
        <button type="submit" class="btn btn-default">确认生成</button>
    </form>
</div>
<script src="<?php echo elixir('dist/main.js');?>"></script>
</body>
</html>
