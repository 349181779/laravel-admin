<meta name="csrf-token" content="{{ csrf_token() }}" />
<link media="all" type="text/css" rel="stylesheet" href="/assets/css/bootstrap.css">
@include('home.block.style')
<style>
    .horizontal {display: inline-block;margin-left: 10px;}
    dd{width: 100px;height: auto;}
</style>

<div class="container-fluid">

    <form style="margin-bottom: 50px;" method="post" action="<?php echo action('User\NewsController@postChoseCategory');?>" class="form-horizontal ajax-form">

    <?php if(!empty($all_user_category)):?>
        <?php foreach($all_user_category as $category):?>

            <dl class="clearfix">
                <dt><input type="checkbox" name="news_cat_id[]" class="horizontal" onclick='check_first_input(this)' <?php if($category->checked == true){ echo "checked='checked'";}?> value="<?php echo $category->id;?>"><h4 class="horizontal"><?php echo $category->cat_name;?></h4></dt>
                <?php if(!empty($category->child)):?>
                    <?php foreach($category->child as $child):?>
                        <dd class="pull-left center-block"><input class="horizontal" onclick='check_second_input(this)' type="checkbox" name="news_cat_id[]" <?php if($child->checked == true){ echo "checked='checked'";}?> value="<?php echo $child->id;?>"><h6 class="horizontal"><?php echo $child->cat_name;?></h6></dd>
                    <?php endforeach;?>
                <?php endif;?>
            </dl>
        <?php endforeach;?>
    <?php endif;?>

        <div class="row" style="position: fixed;bottom: 0px;width: 100%;background: #fff;height: 40px;line-height: 40px;">
            <div class="col-sm-8 col-sm-offset-4" style="">
                <div class="col-sm-3"><input type="checkbox"  onclick='checke_all(this)'   />全选</div>
                <div class="col-sm-3"><input style="margin-top: 5px;" type="submit" class="btn btn-info " value="确认"></div>
            </div>
        </div>

    </form>

</div>
@include('home.block.js')
<script>
    function checke_all(obj){
        var _this = $(obj);
        if(_this.prop('checked') == true){
            $('input[type=checkbox]').prop('checked', 'checked');
        }else{
            $('input[type=checkbox]').removeAttr('checked');
        }

    }

    function check_first_input(obj){
        var _this = $(obj);
        if(_this.prop('checked') == true){
            _this.parents('dl').find('input').prop('checked','checked');
        }else{
            _this.parents('dl').find('input').removeAttr('checked');
        }

    }

    function check_second_input(obj){
        var _this = $(obj);
        if(_this.prop('checked') == true){
            _this.parents('dt').find('input').prop('checked','checked');
        }else{
            _this.parents('dt').find('input').removeAttr('checked');
        }
    }
</script>
