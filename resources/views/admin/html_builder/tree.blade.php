@section('header')
@include('admin.block.header')
<link rel="stylesheet" href="/assets/js/tree/jquery.treeview.css">
<link rel="stylesheet" href="/assets/js/tree/treetable/stylesheets/jquery.treetable.css">
<link rel="stylesheet" href="/assets/js/tree/treetable/stylesheets/jquery.treetable.theme.default.css">
<link href="/assets/js/tree/tabelizer/tabelizer.min.css" media="all" rel="stylesheet" type="text/css">
@show


@include('admin.block.body')
@include('admin.html_builder.tree_form')
@include('admin.block.footer')
</html>


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
