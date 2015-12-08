
<div class="form-group">
    <label
            class="col-sm-3 control-label"><strong><?php echo $schema['title']; ?>
            ：</strong></label>

    <div class="col-sm-3">
        <input type="text" name="<?php echo $schema['name']; ?>"
               value="<?php echo $data->$schema['name'] == '' ? '' : $data->$schema['name'];; ?>"
               onclick="WdatePicker({<?php if (!empty($schema['default'])) {
                   echo "{$schema['default']}";
               } else {
                   echo "dateFmt:'yyyy-MM-dd HH:mm:ss'";
               } ?>})" <?php if (empty($schema['rule'])) {
            echo 'ignore="ignore"';
        } else {
            echo 'datatype=' . $schema['rule'];
        }; ?> errormsg="<?php echo $schema['err_message']; ?>"
               class="form-control <?php echo $schema['class']; ?>"
               onclick="laydate()">
        <span class="help-block"><?php echo $schema['notice']; ?></span>

        <div class="alert alert-danger hide" role="alert">
                                                    <span class="glyphicon glyphicon-exclamation-sign"
                                                          aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            <span class="err_message"></span>
        </div>
    </div>
</div>