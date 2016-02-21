<?php if(count($list_buttons) > 0 ):?>
    <div class="row" style="margin: 10px 0;">
        <div class="btn-group" role="group" aria-label="...">
            <?php foreach($list_buttons as $button):?>
                <button
                        <?php if(!empty($button['url'])):?>
                            onclick="window.location.href='<?php echo $button['url'];?>'"
                        <?php endif;?>
                        style="margin-right: 10px;"
                        <?php if(!empty($button['events'])):?>
                            <?php foreach ($button['events'] as $evnet):?>
                                <?php if(strpos($evnet['name'], 'on') !== false):?>
                                    <?php echo "{$evnet['name']} ='{$evnet['function_name']}({$evnet['params']})' " ;?>
                                <?php else: ?>
                                    <?php echo "on{$evnet['name']} = '{$evnet['function_name']}({$evnet['params']})' " ;?>
                                <?php endif;?>
                            <?php endforeach;?>
                        <?php endif;?>

                        type="button"
                        class="btn btn-success"
                        >
                    <span class="margin-iconic <?php if(!empty($button['class'])){echo $button['class'];}else{echo 'entypo-plus-circled ';}?> "></span>
                    <?php echo $button['name'];?>
                </button>
            <?php endforeach;?>
        </div>
    </div>
<?php endif;?>