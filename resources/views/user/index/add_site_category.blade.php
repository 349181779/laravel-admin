<link media="all" type="text/css" rel="stylesheet" href="/assets/css/bootstrap.css">
@include('home.block.style')

<div class="container">
    <form class="form-horizontal bucket-form ajax-form" action="<?php echo action('User\IndexController@postSiteCategory') ;?>" method="post">
        <div class="form-group">
            <label class="col-sm-3 control-label"><strong>网址分类名称：</strong></label>
            <div class="col-sm-3">
                <input type="text" name="cat_name" class="form-control" datatype="*" errormsg="" >
                <span class="help-block"></span>

                <div class="alert alert-danger hide" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    <span class="err_message"></span>
                </div>
            </div>
        </div>


        <input type="hidden" name="status" value="1">
        <input type="hidden" name="sort" value="255">
        <input name="_token" type="hidden" value="<?php echo csrf_token(); ?>"/>
        <button type="submit" style="display: block;margin: 0 auto;" class="btn btn btn-success">确认</button>
    </form>

</div>
@include('home.block.js')
<script>
    //验证表单
    checkForm($("form"))
</script>
