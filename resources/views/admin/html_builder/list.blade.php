@section('header')
@include('admin.block.header')
<link href="<?php echo elixir('dist/builder_list.css');?>" rel="stylesheet" >
<style>
    .fixed-table-toolbar .search{padding:0;width: auto;}
</style>
@show
@include('admin.block.body')
@include('admin.html_builder.list_form')
<script>
    var tableName = '<?php echo $table_name ;?>';
</script>  
<script src="<?php echo elixir('dist/builder_list.js');?>"></script> 
@include('admin.block.footer')
</html>
