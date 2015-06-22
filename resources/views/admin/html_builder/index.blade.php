<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Le styles -->
@section('header')
    	@include('admin.block.header')
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
    @include('admin.html_builder.list_table')
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
<script src="/assets/js/footable/js/footable.js?v=2-0-1" type="text/javascript"></script> 
<script src="/assets/js/footable/js/footable.sort.js?v=2-0-1" type="text/javascript"></script> 
<script src="/assets/js/footable/js/footable.filter.js?v=2-0-1" type="text/javascript"></script> 
<script src="/assets/js/footable/js/footable.paginate.js?v=2-0-1" type="text/javascript"></script> 
<script src="/assets/js/footable/js/footable.paginate.js?v=2-0-1" type="text/javascript"></script> 
<script type="text/javascript">
    $(function() {
        $('.footable-res').footable();
    });
    </script> 
<script type="text/javascript">
    $(function() {
        $('#footable-res2').footable().bind('footable_filtering', function(e) {
            var selected = $('.filter-status').find(':selected').text();
            if (selected && selected.length > 0) {
                e.filter += (e.filter && e.filter.length > 0) ? ' ' + selected : selected;
                e.clear = !e.filter;
            }
        });

        $('.clear-filter').click(function(e) {
            e.preventDefault();
            $('.filter-status').val('');
            $('table.demo').trigger('footable_clear_filter');
        });

        $('.filter-status').change(function(e) {
            e.preventDefault();
            $('table.demo').trigger('footable_filter', {
                filter: $('#filter').val()
            });
        });

        $('.filter-api').click(function(e) {
            e.preventDefault();

            //get the footable filter object
            var footableFilter = $('table').data('footable-filter');

            alert('about to filter table by "tech"');
            //filter by 'tech'
            footableFilter.filter('tech');

            //clear the filter
            if (confirm('clear filter now?')) {
                footableFilter.clearFilter();
            }
        });
    });
    </script>
</body>
</html>
