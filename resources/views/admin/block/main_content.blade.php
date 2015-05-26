<div class="content-wrap">
                <div class="row">


                    <div class="col-sm-12">

                        <div class="nest" id="FootableClose">
                            <div class="title-alt">
                                <h6>
                                    Footable paginate</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#FootableClose">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#Footable">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>

                            </div>

                            <div class="body-nest" id="Footable">

                                <p class="lead well">FooTable is a jQuery plugin that aims to make HTML tables on smaller devices look awesome - No matter how many columns of data you may have in them. And it's responsive i think this better than DataTable in some way</p>

                                <table class="table-striped footable-res footable metro-blue" data-page-size="6">
                                    <thead>
                                        <tr>
                                            <?php if(!empty($schemas) && is_array($schemas)):?>
                                                <?php foreach($schemas as $k=>$schema):?>
                                                    <th><?php echo $schema['comment'];?></th>
                                                <?php endforeach;?>
                                            <?php endif;?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($data['lists']) && is_array($data['lists'])):?>
                                            <?php foreach($data['lists'] as $list):?>
                                                <tr>
                                                    <?php if(!empty($schemas) && is_array($schemas)):?>
                                                        <?php foreach($schemas as $k=>$schema):?>
                                                            <?php if($schema['type'] == 1):?>
                                                                <td class="<?php echo $schema['class'];?>"><?php echo $list[$k];?></td>
                                                            <?php elseif($schema['type'] == 2):?>
                                                                <td class="<?php echo $schema['class'];?>"><img src="<?php echo $list[$k];?>" alt=""/></td>
                                                            <?php elseif($schema['type'] == 3):?>
                                                                <td class="<?php echo $schema['class'];?>"><a href="<?php echo url($schema['url']);?>"><?php echo $schema['comment'];?></a></td>
                                                            <?php endif;?>
                                                        <?php endforeach;?>
                                                    <?php endif;?>
                                                </tr>
                                            <?php endforeach;?>
                                        <?php endif;?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="<?php echo count($schemas);?>">
                                                <div class="pagination pagination-centered"></div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>

                        </div>


                    </div>

                </div>
            </div>