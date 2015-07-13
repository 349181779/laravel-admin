<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Le styles -->
@section('header')
    	@include('admin.block.header')
        <?php echo Html::style('/bootstrap-table/src/bootstrap-table.css');?>
@show
<style>
.fixed-table-toolbar .search{padding:0;width: auto;}
</style>
</head>

<body>
<!-- Preloader -->
<div id="preloader">
  <div id="status">&nbsp;</div>
</div>

<!-- TOP NAVBAR --> 
@section('top_side')
    @include('admin.block.top_side')
@show 
<!-- /END OF TOP NAVBAR --> 

<!-- SIDE MENU --> 
@section('side_menu')
    @include('admin.block.side_menu')
@show 
<!-- END OF SIDE MENU --> 

<!--  PAPER WRAP -->
<div class="wrap-fluid">
  <div class="container-fluid paper-wrap bevel tlbr"> 
    <!-- CONTENT --> 
    
    <!--TITLE --> 
    @section('main_title')
    @include('admin.block.main_title')
    @show 
    <!--/ TITLE --> 
    
    <!-- BREADCRUMB -->
    <ul id="breadcrumb">
      <li> <span class="entypo-home"></span> </li>
      <li><i class="fa fa-lg fa-angle-right"></i> </li>
      <li><a href="#" title="Sample page 1">Table</a> </li>
      <li><i class="fa fa-lg fa-angle-right"></i> </li>
      <li><a href="#" title="Sample page 1">Table Dynamic</a> </li>
      <li class="pull-right">
        <div class="input-group input-widget">
          <input style="border-radius:15px" type="text" placeholder="Search..." class="form-control">
        </div>
      </li>
    </ul>
    <!-- END OF BREADCRUMB --> 
    
    <!-- main_content --> 
    @section('main_content')
    @include('admin.html_builder.list_form')
    @show 
    <!-- END OF main_content --> 
    
    <!-- /END OF CONTENT --> 
    
    <!-- FOOTER --> 
    @section('footer')
    @include('admin.block.footer')
    @show 
    <!-- / END OF FOOTER --> 
    
  </div>
</div>
<!--  END OF PAPER WRAP --> 

<!-- RIGHT SLIDER CONTENT --> 
@section('right')
    @include('admin.block.main_right')
@show 

<!-- END OF RIGHT SLIDER CONTENT--> 

<!-- MAIN EFFECT --> 
@section('js')
	@include('admin.block.footer_js')
@show 
<!-- /MAIN EFFECT --> 

<!-- GAGE --> 
    <script type="text/javascript" src="/assets/js/toggle_close.js"></script>
    <script src="/bootstrap-table/src/bootstrap-table.js"></script>
    <script src="/bootstrap-table/src/locale/bootstrap-table-zh-CN.js"></script>
    <script src="/bootstrap-table/src/extensions/export/bootstrap-table-export.js"></script>
    <script src="/bootstrap-table/src/extensions/export/tableExport.js"></script>
    <script src="/bootstrap-table/src/extensions/editable/bootstrap-table-editable.js"></script>
    <script src="/bootstrap-table/src/extensions/editable/bootstrap-editable.js"></script>
	<script>

    /**
     * 弹出上传提示框
     */
	function showUploadDialog(){
       layer.open({
            type: 2,
            content: "<?php echo url('tools/upload/uploadview');?>" //这里content是一个普通的String
       });
    }

   /**
    *   初始化表格
    *
    */
    $(function(){
        $('#table').bootstrapTable()
    })

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
	</script>
</body>
</html>
