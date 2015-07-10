<div class="content-wrap">
                <div class="row">

                    <div class="col-sm-12">
                        <div class="nest" id="tabClose">
                            <div class="title-alt">
                                <h6>
                                    Tabs</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#tabClose">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#tab">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>

                            </div>

                            <div class="body-nest" id="tab">

                                <div id="wizard-tab">
                                    <?php if(!empty($tabs_schemas)):?>
                                    <?php foreach($tabs_schemas as $tabs_schema):?>
                                        <?php $tabs_schema = unserialize($tabs_schema);?>
                                        <h2><?php echo $tabs_schema->title ;?></h2>
                                        <section>
                                            <?php $schemas = $tabs_schema->form_schema;?>
                                            @include('admin.html_builder.edit_form')
                                        </section>
                                    <?php endforeach;?>
                                    <?php endif;?>

                                    <h2>Second Step</h2>
                                    <section>
                                        <p>Donec mi sapien, hendrerit nec egestas a, rutrum vitae dolor. Nullam venenatis diam ac ligula elementum pellentesque. In lobortis sollicitudin felis non eleifend. Morbi tristique tellus est, sed tempor elit. Morbi varius, nulla quis condimentum dictum, nisi elit condimentum magna, nec venenatis urna quam in nisi. Integer hendrerit sapien a diam adipiscing consectetur. In euismod augue ullamcorper leo dignissim quis elementum arcu porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum leo velit, blandit ac tempor nec, ultrices id diam. Donec metus lacus, rhoncus sagittis iaculis nec, malesuada a diam. Donec non pulvinar urna. Aliquam id velit lacus.</p>
                                    </section>

                                    <h2>Third Step</h2>
                                    <section>
                                        <p>Morbi ornare tellus at elit ultrices id dignissim lorem elementum. Sed eget nisl at justo condimentum dapibus. Fusce eros justo, pellentesque non euismod ac, rutrum sed quam. Ut non mi tortor. Vestibulum eleifend varius ullamcorper. Aliquam erat volutpat. Donec diam massa, porta vel dictum sit amet, iaculis ac massa. Sed elementum dui commodo lectus sollicitudin in auctor mauris venenatis.
                                        </p>
                                    </section>

                                    <h2>Forth Step</h2>
                                    <section>
                                        <p>Quisque at sem turpis, id sagittis diam. Suspendisse malesuada eros posuere mauris vehicula vulputate. Aliquam sed sem tortor. Quisque sed felis ut mauris feugiat iaculis nec ac lectus. Sed consequat vestibulum purus, imperdiet varius est pellentesque vitae. Suspendisse consequat cursus eros, vitae tempus enim euismod non. Nullam ut commodo tortor.</p>
                                    </section>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>