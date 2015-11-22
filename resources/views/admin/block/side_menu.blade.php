<div id="skin-select">
    <div id="logo">
        <h1><?php echo config('config.site_name') ;?><span><?php echo config('config.version') ;?></span></h1>
    </div>

    <a id="toggle">
        <span class="entypo-menu"></span>
    </a>

    <div class="dark">
        <form action="#">
                <span>
                    <input type="text" name="search" value="" class="search rounded id_search"
                           placeholder="Search Menu..." autofocus>
                </span>
        </form>
    </div>

    <div class="search-hover">
        <form id="demo-2">
            <input type="search" placeholder="Search Menu..." class="id_search">
        </form>
    </div>

    <div class="skin-part">
        <div id="tree-wrap">
            <div class="side-bar">
                <ul id="menu-showhide" class="topnav menu-left-nest" >
                    <li>
                        <a href="#" style="border-left:0px solid!important;" class="title-menu-left">

                            <span class="component"></span>
                            <i data-toggle="tooltip" class="entypo-cog pull-right config-wrap"></i>

                        </a>
                    </li>

                    <!-- 循环 左侧导航菜单 -->
                    <li bg-render="item in side_menu">
                        <script type="text/html">
                            <a class="tooltip-tip" href="javascript:void(0)" title="{{: item.menu_name}}">
                                <i class="icon-monitor"></i>
                                <span bg-text="item.menu_name"></span>

                            </a>


                        <!-- 三级菜单 -->

                        <ul style="display: block;"  >
                                {{for childItem in item.child }}
                                    <li>
                                    <a class="tooltip-tip2 ajax-load" href="{{: childItem.menu_url}}" title="">
                                        <i class="icon-attachment"></i>
                                        <span bg-text="childItem.menu_name" ></span>
                                        </a>
                                        </li>
                                 {{/for}}
                        </ul>

                        <!-- 三级菜单 -->
                        </script>

                    </li>

                    <!-- 循环 左侧导航菜单 -->

                </ul>

            </div>
        </div>
    </div>
</div>