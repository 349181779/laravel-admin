@section('header')
@include('admin.block.header')
@include('UEditor::head');
<script src="/ckeditor/ckeditor.js"></script>

@show

@include('admin.block.body')
@include('admin.html_builder.edit_form')
@include('admin.block.footer')
<link href="<?php echo elixir('dist/builder_update.css');?>" rel="stylesheet" >
 <script src="<?php echo elixir('dist/builder_update.js');?>"></script>
</html>



