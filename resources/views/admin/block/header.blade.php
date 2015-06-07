@include('admin.block.base_header')
<?php echo Html::style('/assets/css/style.css');?>
<?php echo Html::style('/assets/js/footable/css/footable.core.css?v=2-0-1');?>
<?php echo Html::style('/assets/js/footable/css/footable.standalone.css');?>
<?php echo Html::style('/assets/js/footable/css/footable-demos.css');?>
<?php echo Html::style('/assets/js/dataTable/lib/jquery.dataTables/css/DT_bootstrap.css');?>
<?php echo Html::style('/assets/js/dataTable/css/datatables.responsive.css');?>
<?php echo Html::style('/assets/js/button/ladda/ladda.min.css');?>
<script>
    var logout_url = '<?php echo url("admin/home/logout") ;?>';
</script>