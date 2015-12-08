<div class="form-group">
    <label
            class="col-sm-3 control-label"><strong><?php echo $schema['title']; ?>
            ：</strong></label>

    <div class="col-sm-6">
                                                <textarea name="<?php echo $schema['name']; ?>"
                                                          id="<?php echo $schema['name']; ?>"
                                                          datatype="<?php echo $schema['rule']; ?>"
                                                          errormsg="<?php echo $schema['err_message']; ?>"
                                                          class=" <?php echo $schema['class']; ?>"><?php echo $data->$schema['name'] == '' ? $schema['default'] : $data->$schema['name'];; ?> </textarea>

        <!-- 实例化编辑器 -->
        <script type="text/javascript">
            var ue = UE.getEditor("<?php echo $schema['name'] ;?>", {
                initialFrameHeight: 400,
                autoHeightEnabled: false
            });
            ue.ready(function () {
                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
            });
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