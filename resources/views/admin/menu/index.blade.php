<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>菜单列表</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Le styles -->
@section('header')
    	@include('admin.block.header')
    	<link rel="stylesheet" href="/assets/js/tree/jquery.treeview.css">
        <link rel="stylesheet" href="/assets/js/tree/treetable/stylesheets/jquery.treetable.css">
        <link rel="stylesheet" href="/assets/js/tree/treetable/stylesheets/jquery.treetable.theme.default.css">
        <link href="/assets/js/tree/tabelizer/tabelizer.min.css" media="all" rel="stylesheet" type="text/css">
@show
</head>

<body>
<div id="awwwards" class="right black"><a href="http://www.awwwards.com/best-websites/apricot-navigation-admin-dashboard-template" target="_blank">best websites of the world</a></div>
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
    @include('admin.menu.tree')
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
<script src="/assets/js/tree/lib/jquery.cookie.js" type="text/javascript"></script>
<script src="/assets/js/tree/jquery.treeview.js" type="text/javascript"></script>
<script src="/assets/js/tree/tabelizer/jquery-ui-1.10.4.custom.min.js"></script>
<script src="/assets/js/tree/tabelizer/jquery.tabelizer.js"></script>
<script src="/assets/js/tree/treetable/vendor/jquery-ui.js"></script>
<script src="/assets/js/tree/treetable/javascripts/src/jquery.treetable.js"></script>

<script>
$("#example-advanced").treetable({
    expandAll: true
});
</script>



</body>
</html>
