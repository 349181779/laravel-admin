<form method="post" action="<?php echo $confirm_button["url"] ;?>" class="form-horizontal bucket-form ajax-form"  >

   <?php if(!empty($schemas)):?>
        <?php foreach($schemas as $schema):?>

            <?php if($schema['type'] == 'text'):?>
                {{-- 文本框 --}}
              <div class="form-group">
                <label class="col-sm-3 control-label"><strong><?php echo $schema['title'] ;?>：</strong></label>
                <div class="col-sm-3">
                    <input type="<?php echo $schema['type'] ;?>" name="<?php echo $schema['name'] ;?>" value="<?php echo $data->$schema['name'] == '' ? $schema['default'] : $data->$schema['name']; ;?>" <?php if(empty($schema['rule'])){echo 'ignore="ignore"';}else{echo 'datatype='. $schema['rule'];} ;?> errormsg="<?php echo $schema['err_message'] ;?>" class="form-control <?php echo $schema['class'] ;?>" >
                    <span class="help-block"><?php echo $schema['notice'] ;?></span>

                    <div class="alert alert-danger hide" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        <span class="err_message"></span>
                    </div>
                </div>
              </div>

            <?php elseif($schema['type'] == 'textarea'):?>
              {{-- 多行文本框 --}}
                <div class="form-group">
                  <label class="col-sm-3 control-label"><strong><?php echo $schema['title'] ;?>：</strong></label>
                  <div class="col-sm-3">
                      <textarea name="<?php echo $schema['name'] ;?>" id="" <?php if(empty($schema['rule'])){echo 'ignore="ignore"';}else{echo 'datatype='. $schema['rule'];} ;?> errormsg="<?php echo $schema['err_message'] ;?>" class="form-control <?php echo $schema['class'] ;?>" style="height: auto !important;" ><?php echo $data->$schema['name'] == '' ? $schema['default'] : $data->$schema['name']; ;?></textarea>
                      <span class="help-block"><?php echo $schema['notice'] ;?></span>

                      <div class="alert alert-danger hide" role="alert">
                          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                          <span class="sr-only">Error:</span>
                          <span class="err_message"></span>
                      </div>
                  </div>
                </div>

           <?php elseif($schema['type'] == 'password'):?>
          {{-- 密码框 --}}
            <div class="form-group">
              <label class="col-sm-3 control-label"><strong><?php echo $schema['title'] ;?>：</strong></label>
              <div class="col-sm-3">
                  <input type="<?php echo $schema['type'] ;?>" name="<?php echo $schema['name'] ;?>" value="" <?php if(empty($schema['rule'])){echo 'ignore="ignore"';}else{echo 'datatype='. $schema['rule'];} ;?> errormsg="<?php echo $schema['err_message'] ;?>" class="form-control <?php echo $schema['class'] ;?>" >
                  <span class="help-block"><?php echo $schema['notice'] ;?></span>

                  <div class="alert alert-danger hide" role="alert">
                      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                      <span class="sr-only">Error:</span>
                      <span class="err_message"></span>
                  </div>
              </div>
            </div>

          <?php elseif($schema['type'] == 'date'):?>
            {{-- 日期框 --}}
              <div class="form-group">
                <label class="col-sm-3 control-label"><strong><?php echo $schema['title'] ;?>：</strong></label>
                <div class="col-sm-3">
                    <input type="text" name="<?php echo $schema['name'] ;?>" value="<?php echo $data->$schema['name'] == '' ? $schema['default'] : $data->$schema['name']; ;?>" <?php if(empty($schema['rule'])){echo 'ignore="ignore"';}else{echo 'datatype='. $schema['rule'];} ;?> errormsg="<?php echo $schema['err_message'] ;?>" class="form-control <?php echo $schema['class'] ;?>" onclick="laydate()" >
                    <span class="help-block"><?php echo $schema['notice'] ;?></span>

                    <div class="alert alert-danger hide" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        <span class="err_message"></span>
                    </div>
                </div>
              </div>

          <?php elseif($schema['type'] == 'image'):?>
          {{-- 图片框 --}}
            <div class="form-group">
              <label class="col-sm-3 control-label"><strong><?php echo $schema['title'] ;?>：</strong></label>
              <div class="col-sm-3">
                  <div class="col-xs-6 col-md-6" >
                    <a href="javascript:void(0)" class="thumbnail">
                   <img src="<?php echo $data->$schema['name'] == '' ? config('config.default_image') : config('config.file_url').$data->$schema['name'];?>" width="150" height="150" style="border:1px solid #000;padding: 5px;"/>
                    </a>
                  </div>
                  <div style="margin:10px 0;">
                        <button onclick="showChoseImageDialog(this)" type="button" class="btn btn-info btn-lg">
                            <span class="entypo-picture"></span>&nbsp;&nbsp;选 择 图 片
                        </button>
                  </div>
                  <input type="hidden" name="<?php echo $schema['name'] ;?>" value="<?php echo $data->$schema['name'] == '' ? $schema['default'] : $data->$schema['name']; ?>" />
                  <span class="help-block"><?php echo $schema['notice'] ;?></span>

                  <div class="alert alert-danger hide" role="alert">
                      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                      <span class="sr-only">Error:</span>
                      <span class="err_message"></span>
                  </div>
              </div>
            </div>

          <?php elseif($schema['type'] == 'ueditor'):?>
          {{-- 百度富文本编辑器 --}}
            <div class="form-group">
              <label class="col-sm-3 control-label"><strong><?php echo $schema['title'] ;?>：</strong></label>
              <div class="col-sm-6">
                  <textarea name="<?php echo $schema['name'] ;?>" id="<?php echo $schema['name'] ;?>" datatype="<?php echo $schema['rule'] ;?>" errormsg="<?php echo $schema['err_message'] ;?>" class=" <?php echo $schema['class'] ;?>"  ><?php echo $data->$schema['name'] == '' ? $schema['default'] : $data->$schema['name']; ;?> </textarea>

                  <!-- 实例化编辑器 -->
                    <script type="text/javascript">
                        var ue = UE.getEditor("<?php echo $schema['name'] ;?>",{
                            initialFrameHeight : 400,
                            autoHeightEnabled:false
                        });
                        ue.ready(function() {
                            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
                        });
                    </script>

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
                            <?php if($schema['option']):?>
                            <?php foreach($schema['option'] as $key=>$option):?>
                                    <label for="square-radio-1" class="radio-inline">
                                        <?php echo $option;?>
                                        <input type="radio" id="square-radio-1" name="<?php echo $schema['name'] ;?>" value="<?php echo $key;?>" <?php if($data->$schema['name'] == $key ){echo 'checked="checked"';}?> aria-describedby="help-block" tabindex="11" />
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
                            <?php if($schema['option']):?>
                            <?php foreach($schema['option'] as $key => $option):?>
                                <label for="flat-checkbox-1" class="checkbox-inline">
                                    <?php echo $option;?>
                                    <input type="checkbox" name="<?php echo $schema['name'] ;?>" value="<?php echo $key;?>" aria-describedby="help-block" tabindex="11" id="flat-checkbox-1" />
                                </label>
                            <?php endforeach;?>
                            <?php endif;?>
                            <span class="help-block"><?php echo $schema['notice'] ;?></span>
                        </div>
                    </div>
                </div>

            <?php elseif($schema['type'] == 'select'):?>
            {{-- 下拉选择框 --}}
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo $schema['title'] ;?>：</label>
                    <div class="col-sm-3">
                        <div class="skin skin-flat">
                            <select name="<?php echo $schema['name'] ;?>" >
                                <?php if($schema['option']):?>
                                    <option value="">请选择</option>
                                    <?php foreach($schema['option'] as $k=>$option):?>
                                            <option value="<?php echo $option['id'];?>" <?php if($data->$schema['name'] == $option['id']){echo "selected='selected'";}?>  >
                                                <?php if($option['level'] > 0 ){echo str_repeat('&nbsp;&nbsp;', $option['level']);}?>
                                                <?php echo $option[$schema['option_value_schema']];?>
                                            </option>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </select>
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

<input name="id" type="hidden" value="<?php echo $data->id; ?>"/>
<input name="_token" type="hidden" value="<?php echo csrf_token(); ?>"/>
</form>


