@section('header')
@include('admin.block.header')
<?php echo Html::style('/bootstrap-table/src/bootstrap-table.css');?>
<style>
    .fixed-table-toolbar .search{padding:0;width: auto;}
</style>
@show

@include('admin.block.body')
@include('admin.html_builder.list_form')
@include('admin.block.footer')

</html>

<script type="text/javascript" src="/assets/js/toggle_close.js"></script>
<script src="/bootstrap-table/src/bootstrap-table.js"></script>
<script src="/bootstrap-table/src/locale/bootstrap-table-zh-CN.js"></script>
<script src="/bootstrap-table/src/extensions/cookie/bootstrap-table-cookie.js"></script>
<script>

    /**
     *   初始化表格
     *
     */
    $(function(){
        $('#<?php echo $table_name ;?>').bootstrapTable({
            cookie:true,
            cookieIdTable:"<?php echo $table_name ;?>"
        })
    })

    /**
     * 组合query params
     *
     * @param params
     * @returns {*}
     */
    function queryParams(params){
        params.search = $('.search_form').serialize()
        return params;
    }
</script>
