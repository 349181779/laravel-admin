<?php

return [

	'site_logo' => 'http://www.zghjzw.com/images/logo_9a54c1c.png',//网站logo

    'file_type' => [1=>'image', 2=>'audio', 3=>'video'],//资源类型
    'file_url' => 'http://7xk0dl.com1.z0.glb.clouddn.com/',//七牛资源网址
    'default_image' => 'http://tadmin.louxia100.com/Public/images/load.png',//默认图片

    //用户头像图片
    'user_info_face_prefix' => 'http://7xkzhy.com1.z0.glb.clouddn.com/',//用户头像前缀

    //分页
    'page_limit' => '10',//分页条数

    //redis缓存名称
    'user_list_hash_table' => 'user_list',//用户列表hash
    'websocket_list'    => 'web_socket_list',//用户连接 web socket 列表数据

    'forum_page_limit'=>10,//论坛分页
    'forum_comment_page_limit'=> 10,//论坛回复分页

    //私信
    'letter_page_limit'=>10,//私信分页数量

    //采集配置
    'html'  => [

        //新闻
            //腾讯新闻
                ['url' => 'http://news.qq.com/china_index.shtml', 'cat_id'=> 1, 'parent_dom' => 'div[id=listZone] div[class=Q-tpList]', 'child_dom' => 'a[class=linkto]', 'number'=> 0, 'type'=>false],
                ['url' => 'http://news.qq.com/world_index.shtml', 'cat_id'=> 1, 'parent_dom' => 'div[id=listZone] div[class=Q-tpList]', 'child_dom' => 'a[class=linkto]', 'number'=> 0, 'type'=>false],
                ['url' => 'http://news.qq.com/society_index.shtml', 'cat_id'=> 1, 'parent_dom' => 'div[id=listZone] div[class=Q-tpList]', 'child_dom' => 'a[class=linkto]', 'number'=> 0, 'type'=>false],
                ['url' => 'http://news.qq.com/society_index.shtml', 'cat_id'=> 1, 'parent_dom' => 'div[id=listZone] div[class=Q-tpList]', 'child_dom' => 'a[class=linkto]', 'number'=> 0, 'type'=>false],

            //新浪新闻
                ['url' => 'http://roll.news.sina.com.cn/s/channel.php', 'cat_id'=> 1, 'parent_dom' => 'div[class=d_list_txt] ul', 'child_dom' => 'span[class=c_tit] a', 'number'=> 0, 'type'=>true],

            //网易新闻
                ['url' => 'http://news.163.com/domestic/', 'cat_id'=> 1, 'parent_dom' => 'div[class=list-item]', 'child_dom' => 'h2 a', 'number'=> 0, 'type'=>false],
                ['url' => 'http://news.163.com/special/0001386F/rank_whole.html', 'cat_id'=> 1, 'parent_dom' => 'div[class=tabContents]', 'child_dom' => 'td a', 'number'=> 0, 'type'=>false],

            //搜狐新闻
                ['url' => 'http://news.sohu.com/guoneixinwen.shtml', 'cat_id'=> 1, 'parent_dom' => 'div[class=article-list]', 'child_dom' => 'h3 a', 'number'=> 1, 'type'=>false],
                ['url' => 'http://news.sohu.com/guojixinwen.shtml', 'cat_id'=> 1, 'parent_dom' => 'div[class=article-list]', 'child_dom' => 'h3 a', 'number'=> 1, 'type'=>false],

            //凤凰新闻
                ['url' => 'http://news.ifeng.com/listpage/11502/0/1/rtlist.shtml', 'cat_id'=> 1, 'parent_dom' => 'div[class=newsList] ul', 'child_dom' => 'a', 'number'=> 0, 'type'=>true],

            //中国青年网新闻
                ['url' => 'http://news.youth.cn/jsxw/', 'cat_id'=> 1, 'parent_dom' => 'ul[class=tj3_1] li', 'child_dom' => 'a', 'number'=> 0, 'type'=>false],

        //皇马
            ['url' => 'http://www.xinhuanet.com/sports/xj.htm', 'cat_id'=> 11, 'parent_dom' => 'ul[class=dataList] li[class=clearfix]', 'child_dom' => 'h3 a'],
            ['url' => 'http://sports.qq.com/l/isocce/xijia/realma/more.htm', 'cat_id'=> 11, 'parent_dom' => 'div[class=newslist] ul', 'child_dom' => 'a', 'number'=> 0, 'type'=>true],
            ['url' => 'http://roll.sports.sina.com.cn/s_laliga_all/1/index.shtml', 'cat_id'=> 11, 'parent_dom' => 'div[class=d_list_txt] ul', 'child_dom' => 'span[class=c_tit] a', 'number'=> 0, 'type'=>true],
            ['url' => 'http://sports.163.com/special/h/00051F1O/hmmore.html', 'cat_id'=> 11, 'parent_dom' => 'ul[class=articleList]', 'child_dom' => 'span[class=articleTitle] a', 'number'=> 0, 'type'=>true],
            ['url' => 'http://sports.sohu.com/huangma.shtml', 'cat_id'=> 11, 'parent_dom' => 'div[class=f14list] ul li', 'child_dom' => 'a', 'number'=> 0, 'type'=>false],

        //切尔西
            ['url' => 'http://sports.163.com/special/y/00051F15/ycqexmore.html', 'cat_id'=> 15, 'parent_dom' => 'ul[class=articleList]', 'child_dom' => 'span[class=articleTitle] a', 'number'=> 0, 'type'=>true],
            ['url' => 'http://sports.qq.com/l/isocce/yingc/chelse/che.htm', 'cat_id'=> 15, 'parent_dom' => 'div[class=newslist] ul', 'child_dom' => 'a', 'number'=> 0, 'type'=>true],
            ['url' => 'http://sports.qq.com/l/isocce/yingc/chelse/che.htm', 'cat_id'=> 15, 'parent_dom' => 'ul[class] li', 'child_dom' => 'h3[class=feeds_li_title] a', 'number'=> 0, 'type'=>false],
            ['url' => 'http://sports.sohu.com/qieerxi.shtml', 'cat_id'=> 15, 'parent_dom' => 'div[class=f14list] ul li', 'child_dom' => 'a', 'number'=> 0, 'type'=>false],


    ],
];
