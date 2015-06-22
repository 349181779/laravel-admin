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

                                  <div class="col-sm-2">
                                      <a href="" class="btn btn-success">
                                          <span class="entypo-plus-circled margin-iconic"></span>
                                          增加菜单
                                      </a>
                                </div>
                            </div>


                                <a style="margin:0 0 10px; 0" href="javascript:void(0)" class="pull-right btn btn-info" onClick="jQuery('#example-advanced').treetable('expandAll'); return false;">展开</a>
                                <a style="margin:0 10px 10px; 0;" href="javascript:void(0)" class="pull-right btn btn-info" onClick="jQuery('#example-advanced').treetable('collapseAll'); return false;">收缩</a>

                                <table id="example-advanced" class="table-striped">



                                    <thead>
                                        <tr>
                                            <th>菜单名称</th>
                                            <th>是否显示</th>
                                            <th>排序</th>
                                            <th>创建时间</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($all_menu):?>
                                        <?php foreach($all_menu as $menu):?>
                                            <tr data-tt-id='<?php echo $menu["current_id"];?>' data-tt-parent-id='<?php echo $menu["parent_id"];?>'>
                                                <td>
                                                    <span class='file'><?php echo $menu['menu_name'] ;?></span>
                                                </td>
                                                <td><?php echo $menu['status'] ;?></td>
                                                <td><?php echo $menu['sort'] ;?></td>
                                                <td><?php echo $menu['created_at'] ;?></td>
                                                <td><a href="<?php echo url('admin/menu/menuedit', ['id'=>$menu['id']]) ;?>"><span class="icon icon-document-edit"></span>编辑</a></td>
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

