<div class="form-group">
    <label class="col-sm-3 control-label"><?php echo $schema['title']; ?>
        ：</label>

    <div class="col-sm-3">
        <input type="<?php echo $schema['type']; ?>"
               name="<?php echo $schema['name']; ?>"
               value="<?php echo $schema['default']; ?>" <?php if (empty($schema['rule'])) {
            echo 'ignore="ignore"';
        } else {
            echo 'datatype=' . $schema['rule'];
        }; ?> errormsg="<?php echo $schema['err_message']; ?>"
               class="form-control <?php echo $schema['class']; ?>">
        <span class="help-block"><?php echo $schema['notice']; ?></span>
    </div>
</div>