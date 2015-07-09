<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Le styles -->
@section('header')
    	@include('admin.block.header')
    	<?php echo Html::style('/assets/css/mail.css');?>
    	<?php echo Html::style('/bootstrap-table/src/bootstrap-table.css');?>
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
    @include('admin.resource.resource')
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
	<script src="/laypage-v1.2/laypage/laypage.js"></script>
	<script src="/bootstrap-table/src/bootstrap-table.js"></script>
    <script src="/bootstrap-table/src/locale/bootstrap-table-zh-CN.js"></script>
    <script src="/bootstrap-table/src/extensions/export/bootstrap-table-export.js"></script>
    <script src="/bootstrap-table/src/extensions/export/tableExport.js"></script>
    <script src="/bootstrap-table/src/extensions/editable/bootstrap-table-editable.js"></script>
    <script src="/bootstrap-table/src/extensions/editable/bootstrap-editable.js"></script>
	<script>
    /**
     * 弹出上传提示框
     */
	function showUploadDialog(){
       layer.open({
            type: 2,
            content: "<?php echo url('tools/upload/uploadview');?>" //这里content是一个普通的String
       });
    }

    var $table = $('#table'),
                $remove = $('#remove'),
                selections = [];

            $(function () {
                $table.bootstrapTable({
                    height: getHeight(),
                    columns: [

                        [
                        {
                                field: 'id',
                                title: 'id',
                                sortable: true,
                                editable: false,
                                align: 'center'
                            },

                            {
                                field: 'file_name',
                                title: '文件名称',
                                sortable: true,
                                editable: true,
                                footerFormatter: totalNameFormatter,
                                align: 'left'
                            }, {
                                field: 'file_type',
                                title: '文件类型',
                                sortable: true,
                                align: 'center',
                                editable: {
                                    type: 'text',
                                    title: '文件类型',
                                    validate: function (value) {
                                        value = $.trim(value);
                                        if (!value) {
                                            return 'This field is required';
                                        }
                                        if (!/^$/.test(value)) {
                                            return 'This field needs to start width $.'
                                        }
                                        var data = $table.bootstrapTable('getData'),
                                            index = $(this).parents('tr').data('index');
                                        console.log(data[index]);
                                        return '';
                                    }
                                },
                                footerFormatter: totalPriceFormatter
                            },  {
                               field: 'status',
                               title: '文件状态',
                               sortable: true,
                               editable: true,
                               footerFormatter: totalNameFormatter,
                               align: 'center'
                           }, {
                            field: 'sort',
                            title: '排序',
                            sortable: true,
                            editable: true,
                            footerFormatter: totalNameFormatter,
                            align: 'center'
                        },{
                                  field: 'created_at',
                                  title: '创建时间',
                                  sortable: true,
                                  editable: true,
                                  footerFormatter: totalNameFormatter,
                                  align: 'center'
                              },{
                                field: '操作',
                                title: '操作',
                                align: 'center',
                                events: operateEvents,
                                formatter: operateFormatter
                            }
                        ]
                    ]
                });
                // sometimes footer render error.
                setTimeout(function () {
                    $table.bootstrapTable('resetView');
                }, 200);
                $table.on('check.bs.table uncheck.bs.table ' +
                        'check-all.bs.table uncheck-all.bs.table', function () {
                    $remove.prop('disabled', !$table.bootstrapTable('getSelections').length);

                    // save your data, here just save the current page
                    selections = getIdSelections();
                    // push or splice the selections if you want to save all data selections
                });
                $table.on('expand-row.bs.table', function (e, index, row, $detail) {
                    if (index % 2 == 1) {
                        $detail.html('Loading from ajax request...');
                        $.get('LICENSE', function (res) {
                            $detail.html(res.replace(/\n/g, '<br>'));
                        });
                    }
                });
                $table.on('all.bs.table', function (e, name, args) {
                    console.log(name, args);
                });
                $remove.click(function () {
                    var ids = getIdSelections();
                    $table.bootstrapTable('remove', {
                        field: 'id',
                        values: ids
                    });
                    $remove.prop('disabled', true);
                });
                $(window).resize(function () {
                    $table.bootstrapTable('resetView', {
                        height: getHeight()
                    });
                });
            });

            function getIdSelections() {
                return $.map($table.bootstrapTable('getSelections'), function (row) {
                    return row.id
                });
            }

            function responseHandler(res) {
                $.each(res.rows, function (i, row) {
                    row.state = $.inArray(row.id, selections) !== -1;
                });
                return res;
            }

            function detailFormatter(index, row) {
                var html = [];
                $.each(row, function (key, value) {
                    html.push('<p><b>' + key + ':</b> ' + value + '</p>');
                });
                return html.join('');
            }

            function operateFormatter(value, row, index) {
                return [
                    '<a class="like" href="javascript:void(0)" title="Like">',
                    '<i class="glyphicon glyphicon-heart"></i>',
                    '</a>  ',
                    '<a class="remove" href="javascript:void(0)" title="Remove">',
                    '<i class="glyphicon glyphicon-remove"></i>',
                    '</a>'
                ].join('');
            }

            window.operateEvents = {
                'click .like': function (e, value, row, index) {
                    alert('You click like action, row: ' + JSON.stringify(row));
                },
                'click .remove': function (e, value, row, index) {
                    $table.bootstrapTable('remove', {
                        field: 'id',
                        values: [row.id]
                    });
                }
            };

            function totalTextFormatter(data) {
                return 'Total';
            }

            function totalNameFormatter(data) {
                return data.length;
            }

            function totalPriceFormatter(data) {
                var total = 0;
                $.each(data, function (i, row) {
                    //total += +(row.price.substring(1));
                });
                return '$' + total;
            }

            function getHeight() {
                return $('.content-wrap').height() - $('h1').outerHeight(true) + 150;
            }
	</script>
@show 
<!-- /MAIN EFFECT -->
</body>
</html>
