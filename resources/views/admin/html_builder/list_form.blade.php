<div class="content-wrap">
  <div class="row">
    <div class="col-sm-12">
      <div class="nest" id="FootableClose">
        <div class="title-alt">
          <h6> Footable paginate</h6>
          <div class="titleClose"> <a class="gone" href="#FootableClose"> <span class="entypo-cancel"></span> </a> </div>
          <div class="titleToggle"> <a class="nav-toggle-alt" href="#Footable"> <span class="entypo-up-open"></span> </a> </div>
        </div>
        <div class="body-nest" id="Footable">


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

          <div class="container-fluid">

                <!-- 工具栏 -->
                <div id="toolbar" class="form-inline">

                    <!-- 搜索表单 -->
                    <form class="form-inline search_form" onsubmit="return false;">
                        <?php if(!empty($search_schema)):?>
                            <?php foreach($search_schema as $schema):?>

                                <?php if($schema['type'] == 'text'):?>
                                        {{-- 文本框 --}}
                                      <div class="form-group">
                                        <label for="<?php echo $schema['name'] ;?>"><?php echo $schema['title'] ;?>：</label>
                                        <input type="<?php echo $schema['type'] ;?>" name="<?php echo $schema['name'] ;?>" class="form-control <?php echo $schema['class'] ;?>" >
                                      </div>

                                <?php elseif($schema['type'] == 'date'):?>
                                 {{-- 日期框 --}}
                                   <div class="form-group">
                                     <label for="<?php echo $schema['name'] ;?>"><?php echo $schema['title'] ;?>：</label>
                                     <input type="text" name="<?php echo $schema['name'] ;?>" class="form-control <?php echo $schema['class'] ;?>" onclick="laydate()" >
                                  </div>

                                <?php elseif($schema['type'] == 'select'):?>
                                {{-- 下拉选择框 --}}
                                    <div class="form-group">
                                        <label for="<?php echo $schema['name'] ;?>"><?php echo $schema['title'] ;?>：</label>
                                        <select name="<?php echo $schema['name'] ;?>" >
                                            <?php if($schema['option']):?>
                                                <option value="">请选择</option>
                                                <?php foreach($schema['option'] as $k=>$option):?>
                                                        <option value="<?php echo $k;?>" <?php if($schema['option_value_schema'] == $k){echo "selected='selected'";}?>  >
                                                            <?php echo $option;?>
                                                        </option>
                                                <?php endforeach;?>
                                            <?php endif;?>
                                        </select>
                                    </div>

                                <?php endif;?>

                            <?php endforeach;?>
                        <?php endif;?>
                      <button type="submit" class="btn btn-default search_btn">搜索</button>
                    </form>
                    <!-- 搜索表单 -->

                </div>
                <!-- 工具栏 -->

                <table id="table"
                         data-toolbar="#toolbar"
                         data-toolbar-align="left"
                         data-search="true"
                         data-show-refresh="true"
                         data-show-toggle="true"
                         data-show-columns="true"
                         data-show-export="true"
                         data-detail-view="true"
                         data-detail-formatter="detailFormatter"
                         data-minimum-count-columns="2"
                         data-show-pagination-switch="true"
                         data-pagination="true"
                         data-page-list="[10, 25, 50, 100, ALL]"
                         data-show-footer="true"
                         data-side-pagination="server"
                         data-url="<?php echo $get_json_url ;?>"
                         data-query-params="queryParams">


                 <thead>
                      <tr>
                          <?php if(!empty($schemas) && is_array($schemas)):?>
                          <?php foreach($schemas as $k=>$schema):?>
                          <?php if($schema['type'] != 3):?>
                          <th
                            data-field="<?php echo $k;?>"
                            data-sortable=true
                            data-class="<?php echo $schema['class'];?>"
                            ><?php echo $schema['comment'];?></th>
                          <?php endif;?>
                          <?php endforeach;?>
                          <?php endif;?>
                       </tr>
                  </thead>

            </table>
              </div>


        </div>
      </div>
    </div>
  </div>
</div>
