<ul class="subnav"></ul>
<!--  end subnav -->
<div>
    <form method="get" action="" id="search-form" >
        <div class="so_left">

            <input type="text" class="txt_so" id="search-input" value="" />
            <div id="search_hotword" class="" style="display: none;"></div>
        </div>
        <input type="submit" class="so_sub" value="搜索一下"  />
        <div class="clear"></div>
    </form>
    <div class="search-span" id="search-suggest" style="display:none;">
        <ul id="search-result">
            <li class=""></li>
            <li class=""></li>
            <li class=""></li>
            <li class=""></li>
        </ul>
    </div>
</div>
<div  class="so_radio">
    <?php if(!empty($all_search)):?>
    <?php foreach($all_search as $search):?>
    <?php if($search->is_default == 1):?>

    <span><input onclick="getSearch(this)" value="<?php echo $search->id ;?>" type="radio" name="radio" checked="checked" /><?php echo $search->cat_name ;?> </span>
    <script>
        $('input[name=radio]:checked').trigger('click')
    </script>
    <?php else:?>
    <span><input onclick="getSearch(this)" value="<?php echo $search->id ;?>" type="radio" name="radio" /><?php echo $search->cat_name ;?> </span>
    <?php endif;?>
    <?php endforeach;?>
    <?php endif;?>
</div>