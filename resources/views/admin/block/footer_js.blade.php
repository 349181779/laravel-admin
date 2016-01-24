@include('admin.block.base_js')
<<<<<<< HEAD
<script>
    var app = bingo.action(function ($view, $ajax) {
        $view.menu_id   = cookie("menu_id") > 0 ? cookie("menu_id") : 1;
        $view.top_bar   = [];
        $view.side_menu = [];

        //获取顶级菜单
        $view.query = function () {
            $ajax("<?php echo createUrl('Admin\Admin\AdminMenuController@getAdminTopMenu') ?>").success(function (r) {
                if (r.code == 200) {

                    $view.top_bar = r.data;
                    $view.$update();
                } else {
                    toastr.warning(r.msg);
                }

            }).get();
        };
        $view.query();

        //获取子级菜单
        $view.click = function (msg) {
            if (msg) {
                $view.menu_id = msg;
            }

            //设置cookie
            cookie("menu_id", $view.menu_id);

            //$('.topnav a').removeClass('topnav_hover');
            //$(obj).addClass('topnav_hover');

            $ajax("<?php echo createUrl('Admin\Admin\AdminMenuController@getAdminMenu') ?>").param({'parent_id': $view.menu_id}).success(function (r) {
                if (r.code == 200) {
                    $view.side_menu = r.data;
                    $view.$update();
                } else {
                    toastr.warning(r.msg);
                }

            }).get();
        };
        $view.click();
    });

</script>
=======
<script src="/layer-v1.9.3/layer/layer.js"></script>
<script src="/js/jquery.pjax.js"></script>
<script>
$(function(){
    //$(document).pjax('a', 'body');
})
</script>
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
