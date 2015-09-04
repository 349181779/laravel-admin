<meta name="csrf-token" content="{{ csrf_token() }}" />
<link media="all" type="text/css" rel="stylesheet" href="/assets/css/bootstrap.css">
@include('home.block.style')
<style>
    .horizontal {display: inline-block;margin-left: 10px;}
    dd{width: 100px;height: auto;}
</style>

<div class="container">

    <form method="post" action="<?php echo action('User\NewsController@postChoseCategory');?>" class="form-horizontal ajax-form">

    <?php if(!empty($all_user_category)):?>
        <?php foreach($all_user_category as $category):?>

            <dl class="clearfix">
                <dt><input type="checkbox" name="news_cat_id[]" class="horizontal" <?php if($category->checked == true){ echo "checked='checked'";}?> value="<?php echo $category->id;?>"><h4 class="horizontal"><?php echo $category->cat_name;?></h4></dt>
                <?php if(!empty($category->child)):?>
                    <?php foreach($category->child as $child):?>
                        <dd class="pull-left center-block"><input class="horizontal" type="checkbox" name="news_cat_id[]" <?php if($child->checked == true){ echo "checked='checked'";}?> value="<?php echo $child->id;?>"><h6 class="horizontal"><?php echo $child->cat_name;?></h6></dd>
                    <?php endforeach;?>
                <?php endif;?>
            </dl>
        <?php endforeach;?>
    <?php endif;?>

        <div class="row">
            <div class="col-sm-12">
                <input type="submit" class="btn btn-info center-block" value="确认">
            </div>
        </div>

    </form>

</div>
@include('home.block.js')
