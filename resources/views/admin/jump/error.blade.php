<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>菜单列表</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Le styles -->
  @section('header')
  @include('admin.block.header')
  <style>
    .horizontal {display: inline-block;margin-left: 10px;}
    dd{width: 120px;height: auto;}
  </style>
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
    @include('admin.jump.error')
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



</body>
</html>
