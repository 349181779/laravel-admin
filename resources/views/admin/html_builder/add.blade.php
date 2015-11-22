@section('header')
@include('admin.block.header')
@include('UEditor::head');
<script src="/ckeditor/ckeditor.js"></script>
@show


@include('admin.block.body')
@include('admin.html_builder.add_form')
@include('admin.block.footer')
</html>


<script type="text/javascript" src="/assets/js/iCheck/jquery.icheck.js"></script>
<script src="/jquery.form-3.50/jquery.form-3.50.min.js"></script>
<script src="/Validform-v5.3.2/Validform_v5.3.2.js"></script>
<script src="/jquery.iframe-transport.js"></script>
<script src="/js/search.js"></script>

<!--  PLUGIN -->
<script>
    $(document).ready(function () {
        //验证表单
        checkForm($("form"))
    });
</script>
<!-- /MAIN EFFECT -->
