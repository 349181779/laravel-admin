<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $title ;?></title>
	<?php echo Html::script('/assets/js/jquery.min.js');?>
	<?php echo Html::style('/assets/css/bootstrap.css');?>
	<?php echo Html::style('/bootstrap-table/src/bootstrap-table.css');?>
	<style>
	    img{cursor: pointer;}
        .imagebox{margin: 10px 15px;width: 100px;height: 100px;}
        .imagebox a{position: relative;display: block;width: 100px;height: 100%}
        .imagebox img{margin: 0 auto;display: block;}
        .imagebox .chose_icon{position: absolute;bottom: 0;right: 2px;width: 20px;height: 20px;border-radius: 50%;background: red;color: #fff;text-align:center;}
        .bootstrap-table{height: 560px;overflow: auto;}
	</style>
	</head>
	<body>

<div class="container">
    <!-- 工具栏 -->
    <div id="toolbar" class="form-inline">

        <!-- 搜索表单 -->
        <form class="form-inline search_form" onsubmit="return false;">
            <!-- 文本框 -->
            <div class="form-group">
                <label for="image_name">图片名称：</label>
                <input type="text" name="image_name" class="form-control" placeholder="请输入图片名称" />
            </div>
            <input type="hidden" name="source" value="<?php echo $source;?>">
            <input type="hidden" name="image_type" value="<?php echo $image_type;?>">
            <button type="submit" class="btn btn-default search_btn">搜索</button>
        </form>
        <!-- 搜索表单 -->

    </div>
    <!-- 工具栏 -->
      <table id="table"
             data-toolbar="#toolbar"
             data-toolbar-align="left"
             data-search="true"
             data-minimum-count-columns="2"
             data-pagination="true"
             data-page-size = 18
             data-show-header="false"
             data-show-footer="true"
             data-side-pagination="server"
             data-url="<?php echo $get_json_url ;?>"
             data-query-params="queryParams"
             data-response-handler="responseHandler"
               >

          <thead>
          <tr>
              <th
                  data-field="image"
                  data-sortable=true
                  data-cardVisible="true"
                  ></th>
          </tr>
          </thead>
  </table>
    </div>

<!-- Scripts --> 


<script src="/assets/js/bootstrap.js"></script>
<script src="/bootstrap-table/src/bootstrap-table.js"></script>
<script src="/bootstrap-table/src/locale/bootstrap-table-zh-CN.js"></script>
<script src="/bootstrap-table/src/extensions/cookie/bootstrap-table-cookie.js"></script>

<script>

    var $table = $('#table');
    $table.bootstrapTable();
    /**
     * 组合query params
     *
     * @param params
     * @returns {*}
     */
    function queryParams(params){
        params.search = $('.search_form').serialize()
        return params;
    }

   /**
    *  处理响应，组合dom
    */
    function responseHandler(res){
       var tbody = $table.find('tbody');

       //如果搜索结果为空，则显示table
       if (res.total <= 0) {
           tbody.show();
           tbody.nextAll('.imagebox').remove();
           return res;
       };

       tbody.hide();
       var html = '';
        $.each(res.rows,function(i, value){
            html += '<div class="col-xs-2 col-md-2 imagebox">';
            html += '<a href="javascript:void(0)" onclick="choseImage(this)" >';
            html += value.image;
            html += '<span class="glyphicon glyphicon-ok" style="display: none;"></span>'
            html += '</a>';

            html += '</div>';
        })
       tbody.nextAll('.imagebox').remove();
       tbody.after(html);
       return res;
    }

    /**
     * 选中图片事件
     */
    function choseImage(obj){
        $('.imagebox').find('span').removeClass('chose_icon').hide();
        $(obj).parents('.imagebox').find('span').addClass('chose_icon').show();
    }
    </script>
</body>
</html>
