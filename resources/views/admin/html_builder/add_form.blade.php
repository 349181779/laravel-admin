<div class="content-wrap">
  <div class="row">
    <div class="col-sm-12">
      <div class="nest" id="elementClose">

        <div class="title-alt">
          <h6><?php echo $title; ?></h6>
          <div class="titleClose"> <a class="gone" href="#elementClose"> <span class="entypo-cancel"></span> </a> </div>
          <div class="titleToggle"> <a class="nav-toggle-alt" href="#element"> <span class="entypo-up-open"></span> </a> </div>
        </div>

        <div class="body-nest" id="element">
          <div class="panel-body">
            <form method="post" class="form-horizontal bucket-form" >

               <?php if(!empty($schemas)):?>
                    <?php foreach($schemas as $schema):?>

                        <?php if($schema['type'] == 'text'):?>
                            {{-- 文本框 --}}
                          <div class="form-group">
                            <label class="col-sm-3 control-label"><strong><?php echo $schema['title'] ;?>：</strong></label>
                            <div class="col-sm-3">
                                <input type="<?php echo $schema['type'] ;?>" name="<?php echo $schema['name'] ;?>"  datatype="<?php echo $schema['rule'] ;?>" errormsg="<?php echo $schema['err_message'] ;?>" class="form-control <?php echo $schema['class'] ;?>">
                                <span class="help-block"><?php echo $schema['notice'] ;?></span>

                                <div class="alert alert-danger hide" role="alert">
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                                    <span class="sr-only">Error:</span>
                                    <span class="err_message"></span>
                                </div>
                            </div>
                          </div>

                        <?php elseif($schema['type'] == 'radio'):?>
                        {{-- 单选框 --}}
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo $schema['title'] ;?>：</label>
                                <div class="col-sm-3">
                                    <div class="skin skin-flat">
                                        <?php $options = explode('|', $schema['option']);?>
                                        <?php if($options):?>
                                        <?php foreach($options as $key => $option):?>
                                                <?php $params = explode(':', $option);?>
                                                <label for="square-radio-1" class="radio-inline">
                                                    <?php echo $params[1];?>
                                                    <input type="radio" id="square-radio-1" name="<?php echo $schema['name'] ;?>" value="<?php echo $params[0];?>" <?php if($key == 0 ){echo 'checked="checked"';}?> aria-describedby="help-block" tabindex="11" />
                                                </label>
                                        <?php endforeach;?>
                                        <?php endif;?>
                                        <span class="help-block"><?php echo $schema['notice'] ;?></span>
                                    </div>
                                </div>
                            </div>

                        <?php elseif($schema['type'] == 'checkbox'):?>
                        {{-- 复选框 --}}
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo $schema['title'] ;?>：</label>
                                <div class="col-sm-3">
                                    <div class="skin skin-flat">
                                        <?php $options = explode('|', $schema['option']);?>
                                        <?php if($options):?>
                                        <?php foreach($options as $key => $option):?>
                                            <?php $params = explode(':', $option);?>
                                            <label for="flat-checkbox-1" class="checkbox-inline">
                                                <?php echo $params[1];?>
                                                <input type="checkbox" name="<?php echo $schema['name'] ;?>" value="<?php echo $params[0];?>" <?php if($key == 0 ){echo 'checked="checked"';}?> aria-describedby="help-block" tabindex="11" id="flat-checkbox-1" />
                                            </label>
                                        <?php endforeach;?>
                                        <?php endif;?>
                                        <span class="help-block"><?php echo $schema['notice'] ;?></span>
                                    </div>
                                </div>
                            </div>


                        <?php endif;?>

                  <?php endforeach;?>
              <?php endif;?>


            <div class="form-group">
                <div class="col-lg-offset-3 col-lg-10">
                     <section class="button-demo">
                        <button class="<?php echo $confirm_button['class'];?>"  data-size="xs" data-color="blue" data-style="slide-up"><?php echo $confirm_button['title'];?></button>
                    </section>
                </div>
            </div>

            <input name="_token" type="hidden" value="<?php echo csrf_token(); ?>"/>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

