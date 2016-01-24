<div id="skin-select">
<<<<<<< HEAD
    <div id="logo">
        <h1>楼下100<span>v1.0</span></h1>
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
                <ul id="menu-showhide" class="topnav menu-left-nest">
                    <li>
                        <a href="#" style="border-left:0px solid!important;" class="title-menu-left">

                            <span class="component"></span>
                            <i data-toggle="tooltip" class="entypo-cog pull-right config-wrap"></i>

                        </a>
                    </li>
                    <!-- 循环 左侧导航菜单 -->
                    <li bg-render="item in side_menu">
                        <a class="tooltip-tip" href="javascript:void(0)" title="{{: item.menu_name}}">
                            <i class="icon-monitor"></i>
                            <span bg-text="item.menu_name"></span>

                        </a>

                        <!-- 三级菜单 -->
                        <ul style="display: block;">
                            {{for childItem in item.child }}
                            <li>
                                <a class="tooltip-tip2 ajax-load" href="{{: childItem.menu_url}}" title="">
                                    <i class="icon-attachment"></i>
                                    <span bg-text="childItem.menu_name"></span>
                                </a>
                            </li>
                            {{/for}}
                        </ul>
                        <!-- 三级菜单 -->

                    </li>

                    <!-- 循环 左侧导航菜单 -->

                </ul>

            </div>
        </div>
    </div>
</div>
=======
        <div id="logo">
         <h1>我们说<span>v1.0</span></h1>
        </div>

        <a id="toggle">
            <span class="entypo-menu"></span>
        </a>
        <div class="dark">
            <form action="#">
                <span>
                    <input type="text" name="search" value="" class="search rounded id_search" placeholder="Search Menu..." autofocus>
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


                    {{--<ul class="topnav menu-left-nest">--}}
                        {{--<li>--}}
                            {{--<a href="#" style="border-left:0px solid!important;" class="title-menu-left">--}}

                                {{--<span class="design-kit"></span>--}}
                                {{--<i data-toggle="tooltip" class="entypo-cog pull-right config-wrap"></i>--}}

                            {{--</a>--}}
                        {{--</li>--}}

                        {{--<li>--}}
                            {{--<a class="tooltip-tip ajax-load" href="index.html" title="Dashboard">--}}
                                {{--<i class="icon-window"></i>--}}
                                {{--<span>Dashboard</span>--}}

                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a class="tooltip-tip ajax-load" href="mail.html" title="Mail">--}}
                                {{--<i class="icon-mail"></i>--}}
                                {{--<span>mail</span>--}}
                                {{--<div class="noft-blue">289</div>--}}
                            {{--</a>--}}
                        {{--</li>--}}

                        {{--<li>--}}
                            {{--<a class="tooltip-tip ajax-load" href="icon.html" title="Icons">--}}
                                {{--<i class="icon-preview"></i>--}}
                                {{--<span>Icons</span>--}}
                                {{--<div class="noft-blue" style="display: inline-block; float: none;">New</div>--}}
                            {{--</a>--}}
                        {{--</li>--}}

                        {{--<li>--}}
                            {{--<a class="tooltip-tip" href="#" title="Extra Pages">--}}
                                {{--<i class="icon-document-new"></i>--}}
                                {{--<span>Extra Page</span>--}}
                            {{--</a>--}}
                            {{--<ul>--}}
                                {{--<li>--}}
                                    {{--<a class="tooltip-tip2 ajax-load" href="blank_page.html" title="Blank Page"><i class="icon-media-record"></i><span>Blank Page</span></a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a class="tooltip-tip2 ajax-load" href="profile.html" title="Profile Page"><i class="icon-user"></i><span>Profile Page</span></a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a class="tooltip-tip2 ajax-load" href="invoice.html" title="Invoice"><i class="entypo-newspaper"></i><span>Invoice</span></a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a class="tooltip-tip2 ajax-load" href="pricing_table.html" title="Pricing Table"><i class="fontawesome-money"></i><span>Pricing Table</span></a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a class="tooltip-tip2 ajax-load" href="time-line.html" title="Time Line"><i class="entypo-clock"></i><span>Time Line</span></a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a class="tooltip-tip2" href="404.html" title="404 Error Page"><i class="icon-thumbs-down"></i><span>404 Error Page</span></a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a class="tooltip-tip2" href="500.html" title="500 Error Page"><i class="icon-thumbs-down"></i><span>500 Error Page</span></a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a class="tooltip-tip2" href="lock-screen.html" title="Lock Screen"><i class="icon-lock"></i><span>Lock Screen</span></a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}

                        {{--<li>--}}
                            {{--<a class="tooltip-tip " href="login.html" title="login">--}}
                                {{--<i class="icon-download"></i>--}}
                                {{--<span>Login</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}

                    {{--</ul>--}}

                    <ul id="menu-showhide" class="topnav menu-left-nest">
                        <li>
                            <a href="#" style="border-left:0px solid!important;" class="title-menu-left">

                                <span class="component"></span>
                                <i data-toggle="tooltip" class="entypo-cog pull-right config-wrap"></i>

                            </a>
                        </li>
                        <!-- 循环 左侧导航菜单 -->
                        <?php if(!empty($menu_tree_data)):?>
                        <?php foreach($menu_tree_data as $menu):?>
                            <li>
                                <a class="tooltip-tip" href="#" title="<?php echo $menu['menu_name'] ;?>">
                                    <i class="icon-monitor"></i>
                                    <span><?php echo $menu['menu_name'] ;?></span>
                                </a>
                                <?php if(!empty($menu['child'])):?>
                                     <ul>
                                        <?php foreach($menu['child'] as $child_menu):?>
                                        <li>
                                            <a class="tooltip-tip2 ajax-load" href="<?php echo url($child_menu['url']);?>" title="<?php echo $child_menu['menu_name'];?>">
                                                <i class="icon-attachment"></i>
                                                <span><?php echo $child_menu['menu_name'];?></span>
                                            </a>
                                        </li>
                                         <?php endforeach;?>
                                    </ul>
                                <?php endif;?>
                            </li>
                        <?php endforeach;?>
                        <?php endif;?>
                        <!-- 循环 左侧导航菜单 -->

                    </ul>


                    <div class="side-dash">
                        <h3>
                            <span>Device</span>
                        </h3>
                        <ul class="side-dashh-list">
                            <li>Avg. Traffic
                                <span>25k<i style="color:#44BBC1;" class="fa fa-arrow-circle-up"></i>
                                </span>
                            </li>
                            <li>Visitors
                                <span>80%<i style="color:#AB6DB0;" class="fa fa-arrow-circle-down"></i>
                                </span>
                            </li>
                            <li>Convertion Rate
                                <span>13m<i style="color:#19A1F9;" class="fa fa-arrow-circle-up"></i>
                                </span>
                            </li>
                        </ul>
                        <h3>
                            <span>Traffic</span>
                        </h3>
                        <ul class="side-bar-list">
                            <li>Avg. Traffic
                                <div class="linebar">5,7,8,9,3,5,3,8,5</div>
                            </li>
                            <li>Visitors
                                <div class="linebar2">9,7,8,9,5,9,6,8,7</div>
                            </li>
                            <li>Convertion Rate
                                <div class="linebar3">5,7,8,9,3,5,3,8,5</div>
                            </li>
                        </ul>
                        <h3>
                            <span>Visitors</span>
                        </h3>
                        <div id="g1" style="height:180px" class="gauge"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
