<?php

// +----------------------------------------------------------------------
// | date: 2015-06-06
// +----------------------------------------------------------------------
// | response: 响应语言包
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------


return[
    'success' => '操作成功',
    'unauthorized'=>'没有授权',
    'admin_not_exists' => '用户不存在或者密码错误！',
    'admin_disable'=>'当前用户已被禁用，请联系管理员yangyifan@louxia100.com！',
    'update_error'=>'更新失败',
    'update_success'=>'更新成功',
    'add_success'=> '增加成功',
    'add_error'=>'增加失败',
    'delete_success'    => '删除成功',
    'delete_error'  => '删除失败',
    'on'=>'开启',
    'off'=>'关闭',
    'upload_file_error' => '上传文件错误',
    'file_unkown'=>'未知文件',
    'sex_1' => '男',
    'sex_2' => '女',
    'sex_3' => '未知',
    'top_classification' => '顶级分类',
    'is_default'=>'默认',
    'not_is_default' => '非默认',
    'search_error'=>'当前页面不存在',
    'register_success' => '注册成功',
    'register_error'    => '注册失败',
    'save_user_info_to_redis_error'=>'保存用户到redis失败',
    'connet_web_socket_error'=>'连接失败，请重试！',
    'save_user_socket_to_redis_error' => '连接失败，请重试！',
    'update_profile_success'    => '修改个人资料成功',
    'update_user_profile_error' => '保存用户详细信息失败',
    'update_user_password_error'  => '更新用户密码失败',
    'old_password_error'  => '旧密码错误',
    'update_user_password_success'  => '更新用户密码成功',
    'page_error'    => '页面错误',
    'forum_comment_reuqire' => '评论内容不能为空',
    'comment_forum_error'   => '发表帖子评论失败',
    'comment_forum_success'   => '发表帖子评论成功',
    'update_forum_error'    => '编辑器帖子失败',
    'update_forum_success'    => '编辑器帖子成功',
    'no_login'  => '请先登陆',
    'search_empty'  => '搜索内容为空',
    'del_forum_success' => '删除帖子成功',
    'send_add_user_message_success' => '发送添加好友请求成功',
    'can_not_add_their_own_friends' => '不能添加自己为好友',
    'confirm_add_friend_success'    => '确认添加好友成功',
    'not_use'   => '未使用',
    'use'   => '已使用',
    'empty' => '无',

    'update_user_news_category_success' => '更新新闻分类成功',
    'update_user_news_category_error' => '更新新闻分类失败',

    'upload_avatar_success' => '上传头像成功',
    'upload_avatar_error' => '上传头像失败',

    'update_user_access_success' => '更新角色权限成功',
    'update_user_access_error' => '更新角色权限失败',

    'access_error'  => '没有权限',
    'user_access_error' => '没有权限，请先实名制信息！',

    'logout_success'    => '退出登陆成功',
    'logout_error'    => '退出登陆失败',

    //优惠券类型
    'coupon_type_of_type1' => '全场优惠券',
    'coupon_type_of_type2' => '单品牌使用',
    'coupon_type_of_type3' => '单商品使用',
    'coupon_type_of_type4' => '重复使用券',

    'is_speed_1'    => '下午茶',
    'is_speed_2'    => '蛋糕',

    'is_freight_1'  => '免邮',
    'is_freight_2'  => '不免邮',

    'is_new_1'      => '新用户',
    'is_new_2'      => '老用户可用',
    'is_new_3'      => '不限制',

    'coupon_type_1' => '未发放',
    'coupon_type_2' => '未使用',
    'coupon_type_3' => '已使用',
    'coupon_type_4' => '已过期',
    'coupon_type_5' => '已取消',

    'create_coupon_success' => '添加优惠券成功',
    'create_coupon_error' => '添加优惠券失败',

    //充值卡状态
    'prepaid_card_state_1' => '已使用',
    'prepaid_card_state_2' => '未使用',

    'prepaid_card_add_success'  => '添加充值卡成功',
    'prepaid_card_add_error'  => '添加充值卡失败',
    //充值卡未使用
    'prepaid_user_name'    => '未使用',


    //用户信息
    'user_sex_1'    =>  '男',
    'user_sex_2'    =>  '女',
    'user_sex_3'    =>  '未知',

    'user_email_yes'  =>  '通过',
    'user_email_no'   =>  '未通过',

    //是否已回访
    'state_name_1'        => '已回访',
    'state_name_2'        => '未回访',


    'user_mobile_yes'   =>  '通过',
    'user_mobile_no'    =>  '未通过',

    //用户地址是否是用户急速配送地址
    'is_high_speed_1'   => '急速',
    'is_high_speed_2'   => '非急速',

    //用户地址是否默认
    'is_state_1'        =>  '默认',
    'is_state_2'        =>  '不默认',

    //用户账户明细状态
    'bill_state_1'        =>  '收入',
    'bill_state_2'        =>  '支出',
    'bill_state_3'        =>  '充值',
    'BALANCE_NOT_ENOUGH'  => '用户余额少于明细金额，不能减少用户金额',
    'add_balance_error'     => '添加用户金额失败',

    //推送
    'push_success'  => '推送成功',
    'push_error'    => '推送失败',

    //投诉理由
    'reason_1'       =>   "配送迟到（大于60分钟小于120分钟）",
    'reason_2'       =>   "配送迟到（大于120分钟小于180分钟）",
    'reason_3'       =>   "配送迟到（大于180分钟）",
    'reason_4'       =>   "配送早送",
    'reason_5'       =>   "产品破损、融化",
    'reason_6'       =>   "品相错（款式、磅数、尺寸）",
    'reason_7'       =>   "配件错（少配件，配件与要求不符等)",
    'reason_8'       =>   "赠品错",
    'reason_9'       =>   "门店关门",
    'reason_10'      =>   "商品缺货",
    'reason_11'      =>   "产品缺陷",
    'reason_12'      =>   "客服态度",
    'reason_13'      =>   "其他",

    //投诉来源
    'source_1'       =>    '400电话',
    'source_2'       =>    '微博',
    'source_3'       =>    'QQ群',
    'source_4'       =>    '微信',
    'source_5'       =>    '配送员',
    'source_6'       =>    '客服自查',
    'source_7'       =>    '品牌方',
    'source_8'       =>    '用户反馈',
    'source_9'       =>    '后台评论',
    'source_10'      =>    '其他媒体',
    'source_11'      =>    '回访',

    //责任方
    'responsibleParty_1' =>     '物流',
    'responsibleParty_2' =>     '运营',
    'responsibleParty_3' =>     '产品',
    'responsibleParty_4' =>     '销售',
    'responsibleParty_5' =>     '用户',
    'responsibleParty_6' =>     '客服',
    'responsibleParty_7' =>     '财务',


    //广告
    'brand'                         => '品牌id',
    'goods'                         => '商品id',
    'collection'                    => '商品集合',
    'url'                           => 'url链接网址',
    'shop_id'                       => '门店id',

    //App广告
    'ad_position_type1' => 'PC端',
    'ad_position_type2' => 'APP端',


    //站点
    'is_master' => '总站',
    'is_slave'  => '分站',

    //站点配置
    'update_setting_success'    => '更新商店站点配置成功',
    'update_setting_error'    => '更新商店站点配置失败',
    'update_global_setting_success'    => '更新商店站点配置成功',
    'update_global_setting_error'    => '更新商店站点配置失败',

    //广告
    'brand'                         => '品牌',
    'goods'                         => '商品',
    'collection'                    => '商品集合',
    'url'                           => 'url链接网址',

    //配送员职位类型
    'delivery_type_1'   => '全职',
    'delivery_type_2'   => '兼职',

    //配送员职位状态
    'delivery_state_1'   => '启用',
    'delivery_state_2'   => '关闭',


    //配送员收支
    'delivery_account_log_state_1'   => '收入',
    'delivery_account_log_state_2'   => '支出',


    //日志类型
    'log_type_1' =>     '商品',
    'log_type_2' =>     '订单',
    'log_type_3' =>     '优惠券',
    'log_type_4' =>     '充值卡',
    'log_type_5' =>     '系统设置',
    'log_type_6' =>     '品牌',
    'log_type_7' =>     '下午茶门店',
    'log_type_8' =>     '下午茶商品',

    //配送员收支
    'delivery_attendance_state_1'   => '开启',
    'delivery_attendance_state_2'   => '关闭',

    //站内信类型,
    'message_type_1'  => '文本' ,
    'message_type_2'  => '订单' ,
    'message_type_3'  => '商品集合' ,
    'message_type_4'  => '商品' ,
    'message_type_5'  => '优惠券' ,
    'message_type_6'  => 'URL' ,
    //确认回访
    'confirm_visitor_yes'  =>'确认回访成功',
    'confirm_visitor_no'  =>'确认回访失败',
    'confirm_id_no'  =>'ID不能为空',


    //订单来源
    'pay_source_1' => '支付宝移动客户端',
    'pay_source_2' => '支付宝移动网页',
    'pay_source_3' => '支付宝网站即时到帐',
    'pay_source_4' => '货到付款',
    'pay_source_5' => 'bank',
    'pay_source_6' => '微信支付',
    'pay_source_7' => '微信移动客户端',
    'order_visitor_no'  =>'当前没有需要导出的数据',

    //订单状态
    'PAY_STATUS_0'                  => '未付款',
    'PAY_STATUS_1'                  => '已付款',
    'PAY_STATUS_2'                  => '已审核',
    'PAY_STATUS_3'                  => '已分配',
    'PAY_STATUS_4'                  => '已配货',
    'PAY_STATUS_5'                  => '已发货',
    'PAY_STATUS_6'                  => '已完成',
    'PAY_STATUS_7'                  => '申请退货',
    'PAY_STATUS_8'                  => '已取消',
    'PAY_STATUS_9'                  => '货到付款',
    'PAY_STATUS_10'                 => '预定订单',

    //订单详情
    'get_order_info_error'  => '获取订单基本信息失败',
    'get_order_goods_error' => '获取订单商品信息失败',
    'get_order_record_error' => '获取订单操作日志信息失败',
    'get_order_bbs_error'   => '获取订单留言备足信息失败',
    'get_order_coupon_error'   => '获取订单留优惠券信息失败',
    'get_order_comment_error'   => '获取订单留评论信息失败',

    //订单列表时间查询类型
    'order_list_date_type1' => '订单创建时间',
    'order_list_date_type2' => '订单配送时间',

    //邀请码
    'query_invite_data_success' => '获得邀请码信息成功',
    'query_invite_data_error' => '获得邀请码信息失败',

    //是否以验证用户邮箱
    'is_check_user_email_1' => '已验证',
    'is_check_user_email_2' => '未验证',

    //是否以验证用户手机
    'is_check_user_mobile_1' => '已验证',
    'is_check_user_mobile_2' => '未验证',

    //图片
    'image_used'    => '已使用',
    'image_not_use' => '未使用',
    'upload_image_success' => '上传图片成功',
    'upload_image_error' => '上传图片失败',
    'image_exists'  => '图片已经存在',

    //后台菜单
    'get_menu_error'    => '获得菜单失败',
    'get_menu_success'    => '获得菜单成功',

    //后台用户

    //商户
    'cooperative_business'  => '合作商户',
    'tp_order'              => '第三方物流',
    'get_shop_info_error'   => '获取门店信息失败',
    'add_shop_error1'       => '新增门店账户信息失败',
    'add_shop_error2'       => '新增账户用户信息失败',
    'add_shop_error3'       => '新增门店配送信息失败',
    'add_shop_error4'       => '新增门店联系信息失败',
    'add_shop_error5'       => '新增门店联系信息失败',

    'save_shop_error1'       => '更新门店账户信息失败',
    'save_shop_error2'       => '更新账户用户信息失败',
    'save_shop_error3'       => '更新门店配送信息失败',
    'save_shop_error4'       => '更新门店联系信息失败',

    //商品品牌信息

    //平台商品分类等级
    'sys_category_1' => '一级分类',
    'sys_category_2' => '二级分类',

    //订单模块
    'order_id_require'  =>'订单不能为空',
    'delivery_admin_not_exists'  =>'配送员不存在',
    'CHECK_STATUS_ADMIN_LOG'        => ':log_content, 配货员是：:admin_name ,手机号码是 :mobile',
    'station_require'  =>'配送站点不能为空',
    'order_error1'  => '当前订单已经分配到第三方物流，不允许再操作',
    'order_error2'  => '配送员不能为空',
    'order_error3'  => '不能完成此订单',
    'order_error5'  => '审核订单失败',
    'order_error6'  => '分配订单失败',
    'order_error7'  => '配货订单失败',
    'order_error8'  => '分配配送员失败',
    'order_error9'  => '推送订单信息给配送员失败',
    'order_error10' => '完成订单失败',
    'order_error11' => '返还用户余额失败',
    'EDIT_ORDER_SPEND_ADMIN_LOG'    => '修改订单:order_id配送时间为:send_date',
    'check_order_success'   => '处理订单成功',
    'update_order_send_date_success'   => '更新订单配送时间成功',
    'update_order_send_date_error'   => '更新订单配送时间失败',
    'ORDER_NOT_EDIT'                => '此订单现在完成状态不允许修改任何信息',
    'RETURN_ORDER_ADMIN_LOG'        => '返回订单id为：:order_id的状态为：state',
    'ORDER_STATUS_ERROR'            => '您选择的订单状态有误，请重新选择',
    'ORDER_STATUS_ERROR_NOT_MODIFY' => '您选择的订单是货到付款,不能修改状态为已付款',
    'ORDER_PAY_SOURCE_NOT_HUODAO'   => '您选择的订单支付来源不是货到付款，请重新选择',
    'get_order_user_info_success' => '获得订单会员信息成功',
    'get_order_user_info_error' => '获得订单会员信息失败',

    //station模块


    //区域
    'get_all_region_list_error' => '获得全部地址信息失败',
    'get_all_area_list_error'   => '获得当前区域信息失败',

    //APP首页栏目内容管理
    'index_cat_list_type1' => '最食惠',
    'index_cat_list_type2' => '今天喝啥约',
    'index_cat_list_type3' => '送送 ',
    'index_cat_list_type4' => '寻鲜记',

    //商品蛋糕（适合人数）
    'goods_cake_renshu1' => '1人',
    'goods_cake_renshu2' => '2~3人',
    'goods_cake_renshu3' => '4~6人 ',
    'goods_cake_renshu4' => '7人',

    //商品蛋糕（甜度）
    'goods_cake_sweet1' => '1',
    'goods_cake_sweet2' => '2',
    'goods_cake_sweet3' => '3',
    'goods_cake_sweet4' => '4',
    'goods_cake_sweet5' => '5',

    //商品结单时间
    'finish_order_date1' => '-1点',
    'finish_order_date2' => '0点',
    'finish_order_date3' => '1点',
    'finish_order_date4' => '2点',
    'finish_order_date5' => '3点',
    'finish_order_date6' => '4点',
    'finish_order_date7' => '5点',
    'finish_order_date8' => '6点',
    'finish_order_date9' => '7点',
    'finish_order_date10' => '8点',
    'finish_order_date11' => '9点',
    'finish_order_date12' => '10点',
    'finish_order_date13' => '11点',
    'finish_order_date14' => '12点',
    'finish_order_date15' => '13点',
    'finish_order_date16' => '14点',
    'finish_order_date17' => '15点',
    'finish_order_date18' => '16点',
    'finish_order_date19' => '17点',
    'finish_order_date20' => '18点',
    'finish_order_date21' => '19点',
    'finish_order_date22' => '20点',
    'finish_order_date23' => '21点',
    'finish_order_date24' => '22点',
    'finish_order_date25' => '23点',

    //添加商品错误提示
    'add_goods_error1' => '商品蛋糕添加错误，goods_id不存在',
    'add_goods_error2' => '商品蛋糕添加错误，商品基本信息添加失败',
    'add_goods_error3' => '商品蛋糕添加错误，商品图片添加失败',
    'add_goods_error4' => '商品蛋糕添加错误，商品属性添加失败',
    'add_goods_error5' => '商品蛋糕添加错误，商品sku信息添加失败',
    'add_goods_error6' => '商品蛋糕添加错误，商品sku_itme信息添加失败',
    'add_goods_error7' => '商品蛋糕添加错误，商品sku_type信息添加失败',
    'add_goods_error8' => '商品蛋糕添加错误，商品品牌信息添加失败',

];
