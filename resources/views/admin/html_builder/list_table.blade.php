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

           <table class="table-striped footable-res footable metro-blue" data-page-size="6">
            <thead>
              <tr>
                <?php if(!empty($schemas) && is_array($schemas)):?>
                <?php foreach($schemas as $k=>$schema):?>
                <?php if($schema['type'] != 3):?>
                <th><?php echo $schema['comment'];?></th>
                <?php endif;?>
                <?php endforeach;?>
                <th>操作</th>
                <?php endif;?>
              </tr>
            </thead>
            <tbody>
              <?php if(!empty($data['data'])):?>
              <?php foreach($data['data'] as $list):?>
              <tr>
                <?php if(!empty($schemas) && is_array($schemas)):?>
                    <?php foreach($schemas as $k=>$schema):?>
                        <?php if($schema['type'] == 1):?>
                            <td class="<?php echo $schema['class'];?>"><?php echo $list->$k;?></td>
                        <?php elseif($schema['type'] == 2):?>
                            <td class="<?php echo $schema['class'];?>"><img src="<?php echo $list->$k;?>" alt=""/></td>
                        <?php elseif($schema['type'] == 3):?>
                            <?php $button .= '<a href="'.url($schema['url']).'">'.$schema['comment'].'</a>';?>
                            <?php $button .= '<span>|</span>';?>
                        <?php endif;?>
                        <?php endforeach;?>
                        <td><?php if($bottons):?>
                          <?php $button = '';?>
                          <?php foreach($bottons as $v):?>
                          <?php if($v['placeholder']):?>
                          <?php $button .= '<a target="_blank" class="'.$v['class'].'" href="'.$v['url'].'">'.$v['name'].'</a>';?>
                          <?php $button .= '<span>|</span>';?>
                          <?php else:?>
                          <?php $button .= '<a target="_blank" class="'.$v['class'].'" href="'.$v['url'].'">'.$v['name'].'</a>';?>
                          <?php $button .= '<span>|</span>';?>
                          <?php endif;?>
                      <?php endforeach;?>
                      <?php echo $button;?>
                  <?php endif;?></td>
                <?php endif;?>
              </tr>
              <?php endforeach;?>
              <?php endif;?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="<?php echo count($schemas);?>"><?php echo  $data['pages'] ;?>
                  <div class="pagination pagination-centered"></div></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
