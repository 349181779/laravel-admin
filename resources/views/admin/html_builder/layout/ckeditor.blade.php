<div class="form-group">
    <label
            class="col-sm-3 control-label"><strong><?php echo $schema['title']; ?>
            ：</strong></label>

    <div class="col-sm-6">
                                                        <textarea name="<?php echo $schema['name']; ?>"
                                                                  id="<?php echo $schema['name']; ?>"
                                                                  datatype="<?php echo $schema['rule']; ?>"
                                                                  errormsg="<?php echo $schema['err_message']; ?>"
                                                                  class=" <?php echo $schema['class']; ?>"><?php echo $data->$schema['name'] == '' ? '' : $data->$schema['name']; ?> </textarea>

        <!-- 实例化编辑器 -->
        <script type="text/javascript">
            $(function (){
                <?php if (!empty($schema['default'])) :?>
                    editor = CKEDITOR.replace("<?php echo $schema['name'] ;?>", {
                    <?php if (!empty($schema['default'])) :?>
                                   <?php echo "{$schema['default']}";?>
                    <?php endif;?>
                });
                <?php else:?>
                    editor = CKEDITOR.replace("<?php echo $schema['name'] ;?>");
                <?php endif;?>
            })

        </script>

        <span class="help-block"><?php echo $schema['notice']; ?></span>

        <div class="alert alert-danger hide" role="alert">
                                                            <span class="glyphicon glyphicon-exclamation-sign"
                                                                  aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            <span class="err_message"></span>
        </div>
    </div>
</div>