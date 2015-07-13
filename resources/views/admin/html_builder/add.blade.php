<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Le styles -->
@section('header')
    	@include('admin.block.header')
    	@include('UEditor::head');
    	@parent
<link href="/assets/js/iCheck/flat/all.css" rel="stylesheet">
@show
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
    @parent
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
    @include('admin.html_builder.add_form')
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
	@parent 
<script type="text/javascript" src="/assets/js/iCheck/jquery.icheck.js"></script>
<script src="/jquery.form-3.50/jquery.form-3.50.min.js"></script>
<script src="/Validform-v5.3.2/Validform_v5.3.2.js"></script>

<!--  PLUGIN --> 
<script>
    $(document).ready(function() {

        //重置radio
        $('.skin-flat input').iCheck({
            checkboxClass: 'icheckbox_flat-red',
            radioClass: 'iradio_flat-red'
        });
        //重置radio

        //验证表单
        $("form").Validform({
            tiptype:function(msg, o, cssctl){
                switch(o.type){
                    case 3:
                        o.obj.parents('.form-group').find('.alert').removeClass('hide').find('.err_message').text(msg);
                        break;
                    case 2:
                        o.obj.parents('.form-group').find('.alert').addClass('hide').find('.err_message').text('');
                        break;
                }
            }

        });
        //验证表单

    });
    </script> 
@show 
<!-- /MAIN EFFECT -->

</body>
</html>
