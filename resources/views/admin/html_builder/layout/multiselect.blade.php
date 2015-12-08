
<div class="form-group">
    <label class="col-sm-3 control-label"><?php echo $schema['title']; ?>
        ：</label>

    <div class="col-sm-9">
        <div class="select_side">
            <p>待选区</p>
            <select id="selectL" name="selectL" multiple="multiple">
                <?php if (!empty($schema['option'])): ?>
                <?php foreach ($schema['option'] as $k => $option): ?>
                <option
                        value="<?php echo $option['id']; ?>"><?php echo $option['role_name']; ?></option>
                <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="select_opt">
            <p id="toright" title="添加">></p>

            <p id="toleft" title="移除"><</p>
        </div>
        <div class="select_side">
            <p>已选区</p>
            <select id="selectR" name="selectR" multiple="multiple">
                <?php if (!empty($schema['option_value_schema'])): ?>
                <?php foreach ($schema['option_value_schema'] as $k => $option): ?>
                <option
                        value="<?php echo $option['id']; ?>"><?php echo $option['role_name']; ?></option>
                <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <input type="hidden" name="<?php echo $schema['name']; ?>" value="">
    </div>
</div>