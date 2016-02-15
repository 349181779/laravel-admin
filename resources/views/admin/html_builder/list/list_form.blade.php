<div class="content-wrap">
  <div class="row">
    <div class="col-sm-12">
      <div class="nest" id="FootableClose">
        <div class="title-alt">
          <h6> <?php echo $title; ?></h6>
        </div>
        <div class="body-nest" id="Footable">


          <div class="row" style="margin: 10px 0;">

              @include('admin.html_builder.layout.buttons')

          </div>

          <div class="container-fluid">

                <!-- 工具栏 -->
                <div id="toolbar" class="form-inline">

                    <!-- 搜索表单 -->
                    <form method="<?php echo $method; ?>" class="form-inline search_form" onsubmit="return false;">
                        <?php if(count($search_schema) > 0 ):?>
                            <?php foreach($search_schema as $schema):?>

                                <?php if($schema['type'] == 'text'):?>
                                        <!-- 文本框 -->
                                      <div class="form-group">
                                        <label for="<?php echo $schema['name'] ;?>"><?php echo $schema['title'] ;?>：</label>
                                        <input type="<?php echo $schema['type'] ;?>" name="<?php echo $schema['name'] ;?>" class="form-control <?php echo $schema['class'] ;?>" >
                                      </div>

                                <?php elseif($schema['type'] == 'hidden'):?>
                                <!-- 隐藏域 -->
                                    <input type="hidden" name="<?php echo $schema['name'] ;?>" value="<?php echo $schema['default'] ;?>" class="form-control" >


                                <?php elseif($schema['type'] == 'date'):?>
                                 <!-- 日期框 -->
                                   <div class="form-group">
                                     <label for="<?php echo $schema['name'] ;?>"><?php echo $schema['title'] ;?>：</label>
                                     <input type="text" name="<?php echo $schema['name'] ;?>" class="form-control <?php echo $schema['class'] ;?>" onclick="WdatePicker({<?php if(!empty($schema['default'])){echo "{$schema['default']}";}else{echo "dateFmt:'yyyy-MM-dd HH:mm:ss'";}?>})"" >
                                  </div>

                                <?php elseif($schema['type'] == 'select'):?>
                                <!--下拉选择框 -->
                                    <div class="form-group">
                                        <label for="<?php echo $schema['name'] ;?>"><?php echo $schema['title'] ;?>：</label>
                                        <select class="form-control" name="<?php echo $schema['name'] ;?>" >
                                            <?php if($schema['option']):?>
                                                <option value="" >请选择</option>
                                                <?php foreach($schema['option'] as $k=>$option):?>
                                                    <option <?php if($option['id'] == $schema['option_value_schema']){ echo "selected='selected' ";} ?> value="<?php echo $option['id'];?>"   >
                                                        <?php if($option['level'] > 0 ){echo str_repeat('&nbsp;&nbsp;', $option['level']);}?>
                                                        <?php echo $option[$schema['option_value_name']];?>
                                                    </option>
                                                <?php endforeach;?>
                                            <?php endif;?>
                                        </select>
                                    </div>

                                <?php endif;?>

                            <?php endforeach;?>
                        <button type="submit" class="btn btn-default search_btn">搜索</button>
                        <?php endif;?>

                    </form>
                    <!-- 搜索表单 -->

                </div>
                <!-- 工具栏 -->

                <table id="<?php echo $table_name ;?>"
                         data-toolbar="#toolbar"
                         data-toolbar-align="left"
                         data-search="true"
                         data-pagination="true"
                         data-page-list="[<?php echo $limit_number;?>]"
                         data-show-footer="false"
                         data-side-pagination="server"
                         data-url="<?php echo $get_json_url ;?>"
                         data-query-params="queryParams">


                 <thead>
                      <tr>
                          <?php if(!empty($schemas) && is_array($schemas)):?>
                          <?php foreach($schemas as $k=>$schema):?>
                              <th
                                      data-field="<?php echo $k;?>"
                                      data-sortable=<?php echo $schema["is_sort"];?>
                                      data-class="<?php echo $schema['class'];?>"
                                      >
                                  <?php echo $schema['comment'];?>
                              </th>
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