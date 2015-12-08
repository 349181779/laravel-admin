@section('header')
@include('admin.block.header')
<script src="/ckeditor/ckeditor.js"></script>
@include('UEditor::head');

<link href="/assets/js/iCheck/flat/all.css" rel="stylesheet">
<link href="/assets/js/iCheck/line/all.css" rel="stylesheet">
<link href="/assets/js/colorPicker/bootstrap-colorpicker.css" rel="stylesheet">
<link href="/assets/js/switch/bootstrap-switch.css" rel="stylesheet">
<link href="/assets/js/idealform/css/jquery.idealforms.css" rel="stylesheet">

<style>
    .tabcontrol > .content > .body{padding: 0px 2.5%;}
    .nest .title-alt{margin: 10px auto 0;}
</style>
@show

@include('admin.block.body')
@include('admin.html_builder.tab_form')
@include('admin.block.footer')
</html>
<script src="/Validform-v5.3.2/Validform_v5.3.2.js"></script>
<script type="text/javascript" src="/assets/js/iCheck/jquery.icheck.js"></script>
<script src="/js/html_builder/select.js"></script>
<script src="/js/search.js"></script>

<script>
    $(function() {

        //重置radio
        $('.skin-flat input').iCheck({
            checkboxClass: 'icheckbox_flat-red',
            radioClass: 'iradio_flat-red'
        });

    });
</script>
