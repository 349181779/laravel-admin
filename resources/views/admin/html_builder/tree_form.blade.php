<div class="content-wrap">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="nest" id="tabletreeClose">
                            <div class="title-alt">
                                <h6>
                                    Complex Tree With Drag and Drop</h6>
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

                            <div class="row" style="margin: 10px 0;">

                                  <?php if(!empty($add_button)):?>
                                      <div class="col-sm-2">
                                          <a href="<?php echo $add_button['url'];?>" class="btn btn-success">
                                              <span class="entypo-plus-circled margin-iconic"></span>
                                              <?php echo $add_button['name'];?>
                                          </a>
                                    </div>
                                    <?php endif;?>
                            </div>


                                <a style="margin:0 0 10px; 0" href="javascript:void(0)" class="pull-right btn btn-info" onClick="jQuery('#example-advanced').treetable('expandAll'); return false;">展开</a>
                                <a style="margin:0 10px 10px; 0;" href="javascript:void(0)" class="pull-right btn btn-info" onClick="jQuery('#example-advanced').treetable('collapseAll'); return false;">收缩</a>

                                <table id="example-advanced" class="table-striped">



                                    <thead>
                                        <tr>
                                            <?php if(!empty($tree_schemas) && is_array($tree_schemas)):?>
                                            <?php foreach($tree_schemas as $k=>$schema):?>
                                                <?php if($schema['type'] != 3):?>
                                                    <th><?php echo $schema['comment'];?></th>
                                                <?php endif;?>
                                            <?php endforeach;?>
                                            <?php endif;?>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php if($tree_data):?>
                                        <?php foreach($tree_data as $data):?>
                                            <tr data-tt-id='<?php echo $data["current_id"];?>' data-tt-parent-id='<?php echo $data["parent_id"];?>'>
                                                <?php if(!empty($tree_schemas) && is_array($tree_schemas)):?>
                                                <?php foreach($tree_schemas as $k=>$schema):?>
                                                    <td>
                                                        <span <?php if($k == 'id'){echo "class='file'";}?> ><?php echo $data[$k] ;?></span>
                                                    </td>
                                                <?php endforeach;?>
                                                <?php endif;?>
                                            </tr>
                                        <?php endforeach;?>
                                        <?php endif;?>

                                    </tbody>
                                </table>

                            </div>

                        </div>


                    </div>
                </div>
            </div>
            <!-- /END OF CONTENT -->

