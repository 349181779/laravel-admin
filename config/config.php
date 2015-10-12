<?php

return [



    //分页
    'page_limit' => '10',//分页条数
    'order_page_limit' => '50',//订单分页条数

    //redis缓存名称
    'user_list_hash_table' => 'user_list',//用户列表hash
    'websocket_list'    => 'web_socket_list',//用户连接 web socket 列表数据

    //极光推送配置

    //楼下100配送员极光推送配置
    //城市配置

    //图片类型
    'image_type'=> [
        1   => 'brand',//品牌目录
        2   => 'goods',//商品目录
        3   => 'ad',//广告目录
        4   => 'link',//友情链接目录
        5   => 'goods_cat',//商品分类
        6   => 'goods_edit',//商品编辑器
        7   => 'brand_edit',//品牌编辑器
        8   => 'other',//其他商品信息
        9   => 'site',//网站首页其他图片
        10  => 'brand_cat',//品牌栏目图片
        11  => 'goods_collection',//商品集合
    ],

    //图片来源
    'image_source'=>[
        1   => 'pc',
        2   => 'mobile',
        3   => 'pm'
    ],


    'BAIDU_KEY'                 => '',//百度地图秘钥
];
