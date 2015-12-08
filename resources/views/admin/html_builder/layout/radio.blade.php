
<div class="form-group">
    <label class="col-sm-3 control-label"><?php echo $schema['title']; ?>
        ：</label>

    <div class="col-sm-9">
        <div class="skin skin-flat">
            <?php if ($schema['option']): ?>
            <?php foreach ($schema['option'] as $key => $option): ?>
            <label for="" class="radio-inline">
                <input type="radio" id="square-radio-1"
                       name="<?php echo $schema['name']; ?>"
                       value="<?php echo $key; ?>" <?php if ($schema['option_value_schema'] == $key) {
                    echo 'checked="checked"';
                } ?> aria-describedby="help-block" tabindex="11"/>
                <?php echo $option; ?>
            </label>
            <?php endforeach; ?>
            <?php endif; ?>
            <span class="help-block"><?php echo $schema['notice']; ?></span>
        </div>
    </div>
</div>