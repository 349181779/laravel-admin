<div class="content-wrap">
    <div class="row">
        <div class="col-sm-12">
            <div class="nest" id="elementClose">

                <div class="title-alt">
                    <h6><?php echo $title; ?></h6>

                    <div class="titleClose"><a class="gone" href="#elementClose"> <span class="entypo-cancel"></span>
                        </a></div>
                    <div class="titleToggle"><a class="nav-toggle-alt" href="#element"> <span
                                class="entypo-up-open"></span> </a></div>
                </div>

                <div class="body-nest" id="element">
                    <div class="panel-body">
                        <form method="<?php echo $method; ?>" action="<?php echo $confirm_button["url"]; ?>"
                              class="form-horizontal bucket-form ajax-form" enctype="multipart/form-data">

                            <?php if (!empty($schemas)): ?>
                                <?php foreach ($schemas as $schema): ?>

                                    <?php if ($schema['type'] == 'text'): ?>
                                        <!-- 文本框 -->
                                        <div class="form-group">
                                            <label
                                                class="col-sm-3 control-label"><strong><?php echo $schema['title']; ?>
                                                    ：</strong></label>

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

                                                <div class="alert alert-danger hide" role="alert">
                                                    <span class="glyphicon glyphicon-exclamation-sign"
                                                          aria-hidden="true"></span>
                                                    <span class="sr-only">Error:</span>
                                                    <span class="err_message"></span>
                                                </div>
                                            </div>
                                        </div>

                                    <?php elseif ($schema['type'] == 'search'): ?>
                                        <!-- 搜索框 -->
                                        <div class="form-group">
                                            <label
                                                class="col-sm-3 control-label"><strong><?php echo $schema['title']; ?>
                                                    ：</strong></label>

                                            <div class="col-sm-3">
                                                <input type="text"
                                                       name="search_name_xxxxx"
                                                       value="<?php echo $schema['default']; ?>"
                                                       class="form-control <?php echo $schema['class']; ?>">


                                            </div>

                                            <div class="col-sm-3">
                                                <a href="javascript:void(0)" onclick='searchForSelect(this, <?php echo $schema['option'];?>)' class="btn btn-info">搜索</a>
                                                <select name="<?php echo $schema['name']; ?>" onchange="selectSearch(this)" class="form-control select-con">
                                                    <option value="" >请选择</option>
                                                </select>
                                                <input type="hidden" name="<?php echo $schema['name']; ?>" value="<?php echo $data->$schema['name'] == '' ? $schema['default'] : $data->$schema['name']; ?>">
                                            </div>

                                            <div class="col-sm-3 col-sm-offset-3">
                                                <span class="help-block"><?php echo $schema['notice']; ?></span>

                                                <div class="alert alert-danger hide" role="alert">
                                                    <span class="glyphicon glyphicon-exclamation-sign"
                                                          aria-hidden="true"></span>
                                                    <span class="sr-only">Error:</span>
                                                    <span class="err_message"></span>
                                                </div>
                                            </div>
                                        </div>

                                    <?php elseif ($schema['type'] == 'label') : ?>
                                        <!-- 多行文本框 -->
                                        <div class="form-group">
                                            <label
                                                class="col-sm-3 control-label"><strong><?php echo $schema['title']; ?>
                                                    ：</strong></label>

                                            <div class="col-sm-3">
                                                <span><?php echo $schema['default']; ?><?php echo $schema['default']; ?></span>
                                                <span class="help-block"><?php echo $schema['notice']; ?></span>
                                            </div>
                                        </div>

                                    <?php elseif ($schema['type'] == 'hidden') : ?>
                                        <!-- 隐藏域 -->
                                        <input type="<?php echo $schema['type']; ?>"
                                               name="<?php echo $schema['name']; ?>"
                                               value="<?php echo $schema['default']; ?>"
                                               class="form-control <?php echo $schema['class']; ?>">


                                    <?php elseif ($schema['type'] == 'textarea'): ?>
                                        <!-- 多行文本框 -->
                                        <div class="form-group">
                                            <label
                                                class="col-sm-3 control-label"><strong><?php echo $schema['title']; ?>
                                                    ：</strong></label>

                                            <div class="col-sm-3">
                                                <textarea name="<?php echo $schema['name']; ?>"
                                                          id="" <?php if (empty($schema['rule'])) {
                                                    echo 'ignore="ignore"';
                                                } else {
                                                    echo 'datatype=' . $schema['rule'];
                                                }; ?> errormsg="<?php echo $schema['err_message']; ?>"
                                                          class="form-control <?php echo $schema['class']; ?>"
                                                          style="height: auto !important;"><?php echo $schema['default']; ?><?php echo $schema['default']; ?></textarea>
                                                <span class="help-block"><?php echo $schema['notice']; ?></span>

                                                <div class="alert alert-danger hide" role="alert">
                                                    <span class="glyphicon glyphicon-exclamation-sign"
                                                          aria-hidden="true"></span>
                                                    <span class="sr-only">Error:</span>
                                                    <span class="err_message"></span>
                                                </div>
                                            </div>
                                        </div>

                                    <?php elseif ($schema['type'] == 'password'): ?>
                                        <!-- 密码框 -->
                                        <div class="form-group">
                                            <label
                                                class="col-sm-3 control-label"><strong><?php echo $schema['title']; ?>
                                                    ：</strong></label>

                                            <div class="col-sm-3">
                                                <input type="<?php echo $schema['type']; ?>"
                                                       name="<?php echo $schema['name']; ?>"
                                                       value="<?php echo $schema['default']; ?>" <?php if (empty($schema['rule'])) {
                                                    echo 'ignore="ignore"';
                                                } else {
                                                    echo 'datatype=' . $schema['rule'];
                                                }; ?> errormsg="<?php echo $schema['err_message']; ?>"
                                                       class="form-control <?php echo $schema['class']; ?>"
                                                       autocomplete="false">
                                                <span class="help-block"><?php echo $schema['notice']; ?></span>

                                                <div class="alert alert-danger hide" role="alert">
                                                    <span class="glyphicon glyphicon-exclamation-sign"
                                                          aria-hidden="true"></span>
                                                    <span class="sr-only">Error:</span>
                                                    <span class="err_message"></span>
                                                </div>
                                            </div>
                                        </div>

                                    <?php elseif ($schema['type'] == 'date'): ?>
                                        <!-- 日期框 -->
                                        <div class="form-group">
                                            <label
                                                class="col-sm-3 control-label"><strong><?php echo $schema['title']; ?>
                                                    ：</strong></label>

                                            <div class="col-sm-3">
                                                <input type="text" name="<?php echo $schema['name']; ?>"
                                                       onclick="WdatePicker({<?php if (!empty($schema['default'])) {
                                                           echo "{$schema['default']}";
                                                       } else {
                                                           echo "dateFmt:'yyyy-MM-dd HH:mm:ss'";
                                                       } ?>})" <?php if (empty($schema['rule'])) {
                                                    echo 'ignore="ignore"';
                                                } else {
                                                    echo 'datatype=' . $schema['rule'];
                                                }; ?> errormsg="<?php echo $schema['err_message']; ?>"
                                                       class="form-control <?php echo $schema['class']; ?>">


                                                <span class="help-block"><?php echo $schema['notice']; ?></span>

                                                <div class="alert alert-danger hide" role="alert">
                                                    <span class="glyphicon glyphicon-exclamation-sign"
                                                          aria-hidden="true"></span>
                                                    <span class="sr-only">Error:</span>
                                                    <span class="err_message"></span>
                                                </div>
                                            </div>
                                        </div>

                                    <?php elseif ($schema['type'] == 'image'): ?>
                                        <!-- 图片框 -->
                                        <div class="form-group">
                                            <label
                                                class="col-sm-3 control-label"><strong><?php echo $schema['title']; ?>
                                                    ：</strong></label>

                                            <div class="col-sm-3">
                                                <div class="col-xs-6 col-md-6">
                                                    <a href="javascript:void(0)" class="thumbnail">
                                                        <img src="<?php echo \App\Library\Image::getDefaultImage(); ?>" style="border:1px solid #000;padding: 5px;width: 150px;height: 150px;"/>
                                                    </a>
                                                </div>
                                                <div class="col-xs-12 col-md-12" style="margin:10px 0;">
                                                    <button onclick="showChoseImageDialog(this, <?php echo $schema['option']['source']; ?>, <?php echo $schema['option']['image_type']; ?>)" type="button"
                                                            class="btn btn-info btn-lg" style="margin-left: 10px;">
                                                        <span class="entypo-picture"></span>&nbsp;&nbsp;选 择 图 片
                                                    </button>
                                                </div>
                                                <input type="hidden" name="<?php echo $schema['name']; ?>"
                                                       value="<?php echo $data->$schema['name'] == '' ? $schema['default'] : $data->$schema['name']; ?>"/>
                                                <span class="help-block"><?php echo $schema['notice']; ?></span>

                                                <div class="alert alert-danger hide" role="alert">
                                                    <span class="glyphicon glyphicon-exclamation-sign"
                                                          aria-hidden="true"></span>
                                                    <span class="sr-only">Error:</span>
                                                    <span class="err_message"></span>
                                                </div>
                                            </div>
                                        </div>

                                    <?php elseif ($schema['type'] == 'upload_image'): ?>
                                            <!-- 图片上传框 -->
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><strong><?php echo $schema['title']; ?>：</strong></label>

                                        <div class="col-sm-9">
                                            <div class="col-xs-2 col-md-2">
                                                <a href="javascript:void(0)" class="thumbnail">
                                                    <img src="<?php echo $schema['default']; ?>" style="border:1px solid #000;padding: 5px;width: 150px;height: 150px;"/>
                                                </a>
                                            </div>
                                            <div class="col-xs-12 col-md-12" style="margin:10px 0;">
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

                                    <?php elseif ($schema['type'] == 'ueditor'): ?>
                                        <!-- 百度富文本编辑器 -->
                                        <div class="form-group">
                                            <label
                                                class="col-sm-3 control-label"><strong><?php echo $schema['title']; ?>
                                                    ：</strong></label>

                                            <div class="col-sm-6">
                                                <!-- 加载编辑器的容器 -->
                                                <textarea name="<?php echo $schema['name']; ?>"
                                                          id="<?php echo $schema['name']; ?>"
                                                          class="<?php echo $schema['class']; ?>"
                                                          datatype="<?php echo $schema['rule']; ?>"
                                                          errormsg="<?php echo $schema['err_message']; ?>"><?php echo $schema['default']; ?></textarea>

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

                                    <?php elseif ($schema['type'] == 'ckeditor'): ?>
                                            <!-- ckeditor 富文本编辑器 -->
                                    <div class="form-group">
                                        <label
                                                class="col-sm-3 control-label"><strong><?php echo $schema['title']; ?>
                                                ：</strong></label>

                                        <div class="col-sm-6">
                                                        <textarea name="<?php echo $schema['name']; ?>"
                                                                  id="<?php echo $schema['name']; ?>"
                                                                  datatype="<?php echo $schema['rule']; ?>"
                                                                  errormsg="<?php echo $schema['err_message']; ?>"
                                                                  class=" <?php echo $schema['class']; ?>"><?php echo $data->$schema['name'] == '' ? '' : $data->$schema['name'];; ?> </textarea>

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

                                    <?php elseif ($schema['type'] == 'radio'): ?>
                                        <!-- 单选框 -->
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo $schema['title']; ?>
                                                ：</label>

                                            <div class="col-sm-9">
                                                <div class="skin skin-flat">
                                                    <?php if ($schema['option']): ?>
                                                        <?php foreach ($schema['option'] as $key => $value): ?>
                                                            <label for="" class="radio-inline">
                                                                <input type="radio" id="square-radio-1"
                                                                       name="<?php echo $schema['name']; ?>"
                                                                       value="<?php echo $key; ?>" <?php if ($key == $schema['option_value_schema']) {
                                                                    echo 'checked="checked"';
                                                                } ?> aria-describedby="help-block" tabindex="11"/>
                                                                <?php echo $value; ?>
                                                            </label>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                    <span class="help-block"><?php echo $schema['notice']; ?></span>
                                                </div>
                                            </div>
                                        </div>

                                    <?php elseif ($schema['type'] == 'checkbox'): ?>
                                        <!-- 复选框 -->
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo $schema['title']; ?>
                                                ：</label>

                                            <div class="col-sm-9">
                                                <div class="skin skin-flat">
                                                    <?php if ($schema['option']): ?>
                                                        <?php foreach ($schema['option'] as $key => $value): ?>
                                                            <label for="" class="checkbox-inline">
                                                                <?php echo $value; ?>
                                                                <input type="checkbox"
                                                                       name="<?php echo $schema['name']; ?>"
                                                                       value="<?php echo $key; ?>" <?php if (in_array($key, $schema['option_value_schema'])) {
                                                                    echo 'checked="checked"';
                                                                } ?> aria-describedby="help-block" tabindex="11"
                                                                       id="flat-checkbox-1"/>
                                                            </label>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                    <span class="help-block"><?php echo $schema['notice']; ?></span>
                                                </div>
                                            </div>
                                        </div>

                                    <?php elseif ($schema['type'] == 'select'): ?>
                                        <!-- 下拉选择框 -->
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo $schema['title']; ?>
                                                ：</label>

                                            <div class="col-sm-3">
                                                <div class="skin skin-flat">
                                                    <select class="form-control" name="<?php echo $schema['name']; ?>">
                                                        <?php if ($schema['option']): ?>
                                                            <?php foreach ($schema['option'] as $k => $option): ?>
                                                                <option <?php if ($option['id'] == $schema['option_value_name']) {
                                                                    echo "selected='selected' ";
                                                                } ?> value="<?php echo $option['id']; ?>">
                                                                    <?php if ($option['level'] > 0) {
                                                                        echo str_repeat('&nbsp;==', $option['level']);
                                                                    } ?>
                                                                    <?php echo $option[$schema['option_value_name']]; ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                    <span class="help-block"><?php echo $schema['notice']; ?></span>
                                                </div>
                                            </div>
                                        </div>

                                    <?php elseif ($schema['type'] == 'multiSelect'): ?>
                                        <!-- 双向选择器 -->
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo $schema['title']; ?>
                                                ：</label>

                                            <div class="col-sm-9">
                                                <div class="select_side">
                                                    <p>待选区</p>
                                                    <select id="selectL" name="selectL" multiple="multiple">
                                                        <?php if (!empty($schema['option'])): ?>
                                                            <?php foreach ($schema['option'] as $k => $option): ?>
                                                                <option
                                                                    value="<?php echo $option['id']; ?>"><?php echo $option['role_name']; ?></option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                                <div class="select_opt">
                                                    <p id="toright" title="添加">></p>

                                                    <p id="toleft" title="移除"><</p>
                                                </div>
                                                <div class="select_side">
                                                    <p>已选区</p>
                                                    <select id="selectR" name="selectR" multiple="multiple">

                                                    </select>
                                                </div>
                                                <input type="hidden" name="<?php echo $schema['name']; ?>" value="">
                                            </div>
                                        </div>

                                    <?php elseif ($schema['type'] == 'file'): ?>
                                        <!-- 文件上传框 -->
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


                                    <?php endif; ?>

                                <?php endforeach; ?>
                            <?php endif; ?>


                            <div class="form-group">
                                <div class="col-lg-offset-3 col-lg-10">
                                    <section class="button-demo">
                                        <button class="<?php echo $confirm_button['class']; ?>" data-size="xs"
                                                data-color="blue"
                                                data-style="slide-up"><?php echo $confirm_button['title']; ?></button>
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

