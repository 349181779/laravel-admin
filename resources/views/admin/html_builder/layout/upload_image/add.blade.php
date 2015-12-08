<div class="form-group">
    <label class="col-sm-3 control-label"><strong><?php echo $schema['title']; ?>：</strong></label>

    <div class="col-sm-9">
        <div class="col-xs-2 col-md-2 hidden" style="padding-left:0;">
            <a href="javascript:void(0)" class="thumbnail">
                <img src="<?php echo $schema['default']; ?>" style="border:1px solid #000;padding: 5px;width: 150px;height: 150px;"/>
            </a>
        </div>
        <div class="col-xs-12 col-md-12" style="margin:10px 0;padding-left:0;">
            <div class="col-sm-3" style="padding-left: 0;">
                <input type="file" name="<?php echo $schema['name']; ?>" class="form-control" multiple="multiple">
            </div>
        </div>
        <span class="help-block"><?php echo $schema['notice']; ?></span>

        <div class="alert alert-danger hide" role="alert">
                                                                    <span class="glyphicon glyphicon-exclamation-sign"
                                                                          aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            <span class="err_message"></span>
        </div>
    </div>
</div>