

<?php if(!empty($schema['attr']) && $schema['attr']['is_copy'] == true && count($schema['option_value_schema']) > 1) :?>
    <!-- 如果当前 是可复制的select ，并且option的值是数组，代表需要多个select -->
    <?php foreach($schema['option_value_schema'] as $option_key => $option_val) :?>
        <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $schema['title']; ?>
                ：</label>

            <div class="col-sm-3">
                <div class="skin skin-flat">
                    <div class="row">

                        <!-- 下拉列表框 -->
                        <div class="col-sm-10">
                            <select class="form-control" name="<?php echo $schema['name']; ?>">
                                <?php if ($schema['option']): ?>
                                <?php foreach ($schema['option'] as $k => $option): ?>
                                <option
                                        <?php if ( ($option['id'] == $option_val) || ($data->$schema['name'] === $option['id'])) :?>
                                    <?php echo "selected='selected' ";?>
                                <?php endif; ?>

                                        value="<?php echo $option['id']; ?>" >
                                    <?php if ($option['level'] > 0) {
                                        echo str_repeat('&nbsp;&nbsp;', $option['level']);
                                    } ?>
                                    <?php echo $option[$schema['option_value_name']]; ?>
                                </option>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <!-- 下拉列表框 -->

                        <?php if(!empty($schema['attr']) && $schema['attr']['is_copy'] == true) :?>
                        <!-- 可复制 -->

                            <?php if ($option_key == 0) :?>
                                <button class="btn btn-default col-sm-2 addSelect" onclick="addSelect(this)" type="button">
                                    +
                                </button>
                            <?php else:?>
                                <button class="btn btn-default col-sm-2 addSelect" onclick="removeSelect(this)" type="button">
                                    -
                                </button>
                            <?php endif;?>

                        <!-- 可复制 -->
                        <?php endif;?>

                    </div>


                    <span class="help-block"><?php echo $schema['notice']; ?></span>
                </div>
            </div>
        </div>
    <?php endforeach;?>

<?php else:?>
    <div class="form-group">
        <label class="col-sm-3 control-label"><?php echo $schema['title']; ?>
            ：</label>

        <div class="col-sm-3">
            <div class="skin skin-flat">
                <div class="row">

                    <!-- 下拉列表框 -->
                    <div class="col-sm-10">
                        <select class="form-control" name="<?php echo $schema['name']; ?>">
                            <?php if ($schema['option']): ?>
                            <?php foreach ($schema['option'] as $k => $option): ?>
                            <option
                                    <?php if ( ($option['id'] == $schema['option_value_schema']) || ($data->$schema['name'] === $option['id'])) :?>
                                        <?php echo "selected='selected' ";?>
                                    <?php endif; ?>

                                    value="<?php echo $option['id']; ?>" >
                                <?php if ($option['level'] > 0) {
                                    echo str_repeat('&nbsp;&nbsp;', $option['level']);
                                } ?>
                                <?php echo $option[$schema['option_value_name']]; ?>
                            </option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <!-- 下拉列表框 -->

                    <?php if(!empty($schema['attr']) && $schema['attr']['is_copy'] == true) :?>
                        <!-- 可复制 -->
                            <button class="btn btn-default col-sm-2 addSelect" onclick="addSelect(this)" type="button">+</button>
                        <!-- 可复制 -->
                    <?php endif;?>

                </div>


                <span class="help-block"><?php echo $schema['notice']; ?></span>
            </div>
        </div>
    </div>
<?php endif;?>