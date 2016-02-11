<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<link rel="stylesheet" href="<?php echo elixir('dist/base.css');?>">
	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="<?php echo elixir('dist/base.js');?>"></script>
	<style>
		body{background: #fff;  }
        form{margin: 20px 0;}
        .rule_list{margin-bottom: 10px;}
	</style>
</head>
<body>
<div class="container">
    <h3>创建<?php echo $table_name;?>表配置信息</h3>
    <form class="form-horizontal ajax-form" method="post" action="<?php echo createUrl('\Yangyifan\AutoBuild\Http\Controllers\Config\RequestController@postCreateConfig') ;?>">
        <?php if(!empty($schema_list)):?>
            <?php foreach ($schema_list as $schema) :?>
                <div class="form-group">
                    <label class="col-sm-1" for="exampleInputEmail1"><?php echo $schema['col_name'];?></label>

                    <div class="col-sm-11">
                        <div class="row">

                            <!-- 标题 -->
                            <div class="col-sm-3">
                                <span>标题:</span>
                                <input type="text" class="form-control" name="<?php echo $schema['col_name'];?>[title]" value="<?php echo $schema['comment'] ? : $schema['col_name'];?>">
                            </div>
                            <!-- 标题 -->

                            <!-- 表单验证规则 -->
                            <div class="col-sm-9 rule_parent_div">
                                <div class="row">
                                    <div class="col-sm-12 rule_list">
                                        <div class="col-sm-6 col-xs-10 form-inline">
                                            <a href="javascript:void(0)" class="btn btn-default copyRuleBtn" onclick="copyRuleDom(this)">+</a>
                                            <span>表单验证规则:</span>
                                            <select onchange="createRuleParam(this)" style="width: 150px;" class="form-control" name="<?php echo $schema['col_name'];?>[rule][rule][]" data-name="<?php echo $schema['col_name'];?>[rule][params]">
                                                <option value="">请选择</option>
                                                <?php if(!empty($all_rule)):?>
                                                <?php foreach ($all_rule as $type => $rule) :?>
                                                <?php if(is_array($rule)):?>
                                                <option data-type="array" data-params-string="<?php echo implode(',', $rule);?>"  value="<?php echo $type;?>"><?php echo last($rule);?></option>
                                                <?php else:?>
                                                <option data-type="string" value="<?php echo $type;?>"><?php echo $rule;?></option>
                                                <?php endif;?>
                                                <?php endforeach;?>
                                                <?php endif;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 表单验证规则 -->

                        </div>
                    </div>

                </div>
            <?php endforeach;?>
        <?php endif;?>
            <input type="hidden" name="table_name"  value="<?php echo $table_name;?>">
        <button type="submit" class="btn btn-default">确认生成</button>
    </form>
</div>
<script src="<?php echo elixir('dist/main.js');?>"></script>
<script>

    /**
     * 复制表单验证规则dom
     */
    function copyRuleDom(obj)
    {
        var _this = $(obj);
        var tmp_dom  = _this.parents('.rule_list').clone(true);
        tmp_dom.find('.copyRuleBtn').replaceWith('<a href="javascript:void(0)" class="btn btn-default copyRuleBtn" onclick="removeRuleDom(this)">-</a>')
        tmp_dom.appendTo(_this.parents('.rule_parent_div .row'));
    }

    /**
     * 删除dom
     */
    function removeRuleDom(obj)
    {
        var _this = $(obj);
        _this.parents('.rule_list').remove();
    }

    /**
     * 匹配规则,创建表单dom
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    function CreateRuleParam($obj, $params_string)
    {
        this.params_string  = $params_string;
        this.obj            = $obj;

        //配置信息
        this.config = {
            child_div_class_name : "append_child_rule_div",//子元素名称
        }
        //构造函数
        this.__construct();
    }

    /**
     * 构造函数
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    CreateRuleParam.prototype.__construct = function ()
    {
        if (this.params_string) {
            /**
             * 去除掉最后(如果当前是rule类型是数组,最后一列是用来说明的,所以必须去除)
             */
            this.params_string = this.params_string.substring(0, this.params_string.lastIndexOf(','));
            //匹配规则,创建表单dom
            this.mathRule();
        } else {
            //移除全部子元素
            this.removeRuleChild();
        }
    }

    /**
     * 匹配规则,创建表单dom
     *
     * @param $rule
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    CreateRuleParam.prototype.mathRule = function ()
    {
        var rule_arr = this.params_string.match(/\%[a-z]/g);
        if (rule_arr.length > 0 ) {
            //移除全部子元素
            this.removeRuleChild();
            //创建select表单元素后面的临时div追加
            var $param_dom = $('<div><div>');

            for (var i = 0; i < rule_arr.length; i++){
                //往select表单元素后面的临时div追加
                $param_dom.append(this.warpDom(this.createRuleDom(i, rule_arr[i]), i));
            }
            //往select表单元素后面追加
            this.obj.parent('div').after($param_dom);
        }
    }

    /**
     * 包裹dom
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    CreateRuleParam.prototype.warpDom = function ($dom, index)
    {
        //为服务器端组合数据准备.
        index++;

        $div = $('<div class="col-sm-3"></div>');
        //$div.append('<span>参数'+index+'<span>');
        $div.append($dom);
        return $div;
    }

    /**
     * 创建dom
     * $match_rule %d 或者 %s 表示 prinrf 的 type
     *
     * @param index
     * @param $match_rule
     * @returns {jQuery|HTMLElement}
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    CreateRuleParam.prototype.createRuleDom = function (index, $match_rule)
    {
        //为服务器端组合数据准备.
        index ++ ;

        switch ($match_rule) {
            case "%s":
                return $input = $('<input type="text" placeholder="参数'+index+'"  name="'+this.obj.attr('data-name') + "[" + this.obj.find('option:selected').val() + "]" + "[" + index + "]"+'" class="form-control '+this.config.child_div_class_name+'">');
            case "%d":
                return $input = $('<input type="number" placeholder="参数'+index+'" name="'+this.obj.attr('data-name') + "[" + this.obj.find('option:selected').val() + "]" + "[" + index + "]"+'" class="form-control '+this.config.child_div_class_name+'">');
        }
    }

    /**
     * 移除全部子元素
     *
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    CreateRuleParam.prototype.removeRuleChild = function ()
    {
        (this.obj.parents('.rule_list').find('.'+this.config.child_div_class_name+'')).parent('div').remove();
    }

    /**
     * 匹配规则,创建表单dom
     *
     * @param obj
     */
    function createRuleParam(obj)
    {
        new CreateRuleParam($(obj), $(obj).find('option:selected').attr('data-params-string'))
    }
</script>
</body>
</html>
