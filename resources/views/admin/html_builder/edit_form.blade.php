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
                        <form method="<?php echo $method; ?>" action="<?php echo $confirm_button["url"]; ?>" class="form-horizontal bucket-form ajax-form" enctype="multipart/form-data" >

                            <?php if (!empty($schemas)): ?>
                                <?php foreach ($schemas as $schema): ?>

                                    <?php if ($schema['type'] == 'text'): ?>
                                        <!-- 文本框 -->
                                    @include('admin.html_builder.layout.text')

                                    <?php elseif ($schema['type'] == 'search'): ?>
                                    <!-- 搜索框 -->
                                    @include('admin.html_builder.layout.search')

                                    <?php elseif ($schema['type'] == 'label') : ?>
                                        <!-- label -->
                                        @include('admin.html_builder.layout.label')

                                    <?php elseif ($schema['type'] == 'hidden') : ?>
                                        <!-- 隐藏域 -->
                                        @include('admin.html_builder.layout.hidden')


                                    <?php elseif ($schema['type'] == 'textarea'): ?>
                                        <!-- 多行文本框 -->
                                        @include('admin.html_builder.layout.textarea')

                                    <?php elseif ($schema['type'] == 'password'): ?>
                                        <!-- 密码框 -->
                                        @include('admin.html_builder.layout.password')

                                    <?php elseif ($schema['type'] == 'date'): ?>
                                        <!-- 日期框 -->
                                        @include('admin.html_builder.layout.date')

                                    <?php elseif ($schema['type'] == 'image'): ?>
                                        <!-- 图片框 -->
                                        @include('admin.html_builder.layout.image.edit')

                                    <?php elseif ($schema['type'] == 'upload_image'): ?>
                                    <!-- 图片上传框 -->
                                        @include('admin.html_builder.layout.upload_image.edit')

                                    <?php elseif ($schema['type'] == 'ueditor'): ?>
                                        <!-- 百度富文本编辑器 -->
                                        @include('admin.html_builder.layout.ueditor')
                                    <?php elseif ($schema['type'] == 'ckeditor'): ?>
                                    <!-- ckeditor 富文本编辑器 -->
                                        @include('admin.html_builder.layout.ckeditor')

                                    <?php elseif ($schema['type'] == 'radio'): ?>
                                    <!-- 单选框 -->
                                        @include('admin.html_builder.layout.radio')

                                    <?php elseif ($schema['type'] == 'checkbox'): ?>
                                        <!-- 复选框 -->
                                        @include('admin.html_builder.layout.checkbox')

                                    <?php elseif ($schema['type'] == 'select'): ?>
                                        <!-- 下拉选择框 -->
                                        @include('admin.html_builder.layout.select')

                                    <?php elseif ($schema['type'] == 'multiSelect'): ?>
                                        <!-- 双向选择器 -->

                                    @include('admin.html_builder.layout.multiselect')
                                    <?php elseif ($schema['type'] == 'file'): ?>
                                        <!-- 文件上传框 -->
                                        @include('admin.html_builder.layout.file')


                                    <?php endif; ?>

                                <?php endforeach; ?>
                            <?php endif; ?>


                            <div class="form-group">
                                <div class="col-lg-offset-3 col-lg-10 row-block">
                                    <section class="button-submit">
                                        <button data-style="slide-up"
                                                class="ladda-button <?php echo $confirm_button['class']; ?>  pull-cnter col-md-1"
                                                data-size="l"
                                                >
                                            <span class="ladda-label"><?php echo $confirm_button['title']; ?></span>
                                        </button>
                                    </section>
                                </div>
                            </div>

                            <input name="id" type="hidden" value="<?php echo $data->id; ?>"/>
                            <input name="_token" type="hidden" value="<?php echo csrf_token(); ?>"/>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





