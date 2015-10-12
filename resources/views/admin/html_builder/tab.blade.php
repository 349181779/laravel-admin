@section('header')
@include('admin.block.header')
<?php echo Html::style('/assets/js/wizard/css/jquery.steps.css');?>
<?php echo Html::style('/assets/js/wizard/jquery.stepy.css');?>
<?php echo Html::style('/assets/js/tabs/acc-wizard.min.css');?>
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
<script src="/assets/js/wizard/build/jquery.steps.js"></script>
<script src="/assets/js/wizard/jquery.stepy.js"></script>
<script src="/jquery.form-3.50/jquery.form-3.50.min.js"></script>
<script src="/Validform-v5.3.2/Validform_v5.3.2.js"></script>
<script type="text/javascript" src="/assets/js/iCheck/jquery.icheck.js"></script>

<script>
    $(function() {
        //初始化tab
        $("#wizard-tab").steps({
            headerTag: "h2",
            bodyTag: "section",
            transitionEffect: "none",
            enableFinishButton: false,
            enablePagination: false,
            enableAllSteps: true,
            titleTemplate: "#title#",
            cssClass: "tabcontrol"
        });
        //初始化tab

        //重置radio
        $('.skin-flat input').iCheck({
            checkboxClass: 'icheckbox_flat-red',
            radioClass: 'iradio_flat-red'
        });
        //重置radio

    });
</script>
