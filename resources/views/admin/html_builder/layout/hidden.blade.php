<div class="form-group">
       <div class="col-sm-12">
           <input type="<?php echo $schema['type']; ?>"
                  name="<?php echo $schema['name']; ?>"
                  value="<?php echo $data->$schema['name'] == '' ? $schema['default'] : $data->$schema['name'];; ?>"
                  class="form-control <?php echo $schema['class']; ?>"
           >
       </div>
</div>