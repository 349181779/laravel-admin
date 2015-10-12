<div class="content-wrap">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="nest" id="tabletreeClose">
                            <div class="title-alt">
                                <h6>编辑角色权限</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#tabletreeClose">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#tabletree">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>

                            </div>

                            <div class="body-nest" id="tabletree">

                                <form method="post" action="<?php echo action('Admin\RoleController@postAccess');?>" class="form-horizontal ajax-form">

                                    <?php if(!empty($all_user_menu)):?>
                                        <?php foreach($all_user_menu as $menu):?>
                                            <dl class="clearfix col-sm-offset-1">
                                                <dt><input type="checkbox" class="horizontal" onclick='check_first_input(this)' name="menu_id[]" <?php if($menu->checked == true){ echo "checked='checked'";}?> value="<?php echo $menu->id;?>" ><h4 class="horizontal"><?php echo $menu->menu_name;?></h4></dt>
                                                <?php if(!empty($menu->child)):?>
                                                    <?php foreach($menu->child as $child):?>
                                                        <dd class="pull-left center-block"><input type="checkbox" class="horizontal" onclick='check_second_input(this)' name="menu_id[]" <?php if($child->checked == true){ echo "checked='checked'";}?> value="<?php echo $child->id;?>" ><h6 class="horizontal"><?php echo $child->menu_name;?></h6></dd>
                                                    <?php endforeach;?>
                                                <?php endif;?>
                                            </dl>
                                        <?php endforeach;?>
                                    <?php endif;?>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input type="checkbox"  onclick='checke_all(this)'   />全选
                                            <input type="submit" class="btn btn-info center-block" value="确认">
                                        </div>
                                    </div>

                                    <input type="hidden" name="role_id" value="<?php echo $role_id ;?>">
                                </form>


                            </div>

                        </div>


                    </div>
                </div>
            </div>
            <!-- /END OF CONTENT -->

