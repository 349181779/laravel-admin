<<<<<<< HEAD
<style>
    .tabcontrol > .content {
        height: auto
    }

    .tabcontrol > .content > .body {
        position: static;
    }
</style>
<div class="content-wrap">
    <div class="row">

        <div class="col-sm-12">
            <div class="nest" id="tabClose">
                <div class="title-alt">
                    <h6>
                        <?php echo $title; ?></h6>

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
                        <?php if (!empty($tabs_schemas)): ?>
                            <?php foreach ($tabs_schemas as $k => $tabs_schema): ?>
                                <?php $data = $tab_data[$k]; ?>
                                <?php $confirm_button = $tab_confirm_button[$k]; ?>
                                <?php $tabs_schema = unserialize($tabs_schema); ?>

                                <h2><?php echo $tabs_schema->title; ?></h2>
                                <section>
                                    <?php $schemas = $tabs_schema->form_schema; ?>
                                    @include('admin.html_builder.edit_form')
                                </section>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </div>

                </div>
            </div>
        </div>


    </div>
</div>
=======
<style>
.tabcontrol > .content{height:auto}
.tabcontrol > .content > .body{position:static;}
</style>
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
                                    <?php foreach($tabs_schemas as $k=>$tabs_schema):?>
                                        <?php $data = $tab_data[$k];?>
                                        <?php $confirm_button = $tab_confirm_button[$k];?>
                                        <?php $tabs_schema = unserialize($tabs_schema);?>

                                        <h2><?php echo $tabs_schema->title ;?></h2>
                                        <section>
                                            <?php $schemas = $tabs_schema->form_schema;?>
                                            @include('admin.html_builder.edit_form')
                                        </section>
                                    <?php endforeach;?>
                                    <?php endif;?>

                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
