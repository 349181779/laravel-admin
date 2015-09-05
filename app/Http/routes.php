<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//首页跳转
Route::get('/', function(){
    return redirect()->action('Home\IndexController@getIndex');
});

//后台
Route::group(['prefix'=>'admin', 'namespace' => 'Admin'],function(){
    //登录
    Route::controller('login', 'LoginController');
    //首页
    Route::controller('home', 'HomeController');
    //权限
    Route::controller('role', 'RoleController');
    //后台菜单
    Route::controller('menu', 'MenuController');
    //后台用户
    Route::controller('admininfo', 'AdmininfoController');
    //会员用户
    Route::controller('userinfo', 'UserInfoController');
    //资源
    Route::controller('resource', 'ResourceController');
    //网站设置
    Route::controller('config', 'ConfigController');
    //文章分类
    Route::controller('article-cat', 'ArticleCatController');
    //文章
    Route::controller('article', 'ArticleController');
    //网址分类
    Route::controller('site-cat', 'SiteCatController');
    //网址
    Route::controller('site', 'SiteController');
    //查询分类
    Route::controller('query-cat', 'QueryCatController');
    //查询工具
    Route::controller('query', 'QueryController');
    //新闻分类
    Route::controller('news-cat', 'NewsCatController');
    //新闻
    Route::controller('news', 'NewsController');
    //搜索工具分类
    Route::controller('search-cat', 'SearchCatController');
    //搜索工具导航
    Route::controller('search', 'SearchController');
    //email控制器
    Route::controller('email', 'EmailController');
    //App分类
    Route::controller('app-cat', 'AppCatController');
    //App
    Route::controller('app', 'AppController');
    //论坛分类
    Route::controller('forum-cat', 'ForumCatController');
    //论坛
    Route::controller('forum', 'ForumController');
});

//Tools
Route::group(['prefix'=>'tools', 'namespace' => 'Tools'],function(){
    //MarkDown Route
    Route::controller('mark', 'MarkDownController');
    //Filter Route
    Route::controller('filter', 'FilterController');
    //Agent Route
    Route::controller('agent', 'AgentController');
    //Pinyin Route
    Route::controller('pinyin', 'PinyinController');
    //上传组件
    Route::controller('upload', 'UploadController');
    //swoole
    Route::controller('swoole', 'SwooleController');
    //web socket
    Route::controller('socket', 'WebSocketController');
    //采集
    Route::controller('html', 'HtmlDomController');
    //高性能远程对象
    Route::controller('hprose', 'HproseController');
});

//前台
Route::group(['prefix'=> 'home', 'namespace' => 'Home'], function(){
    //首页
    Route::controller('index', 'IndexController');
    //会员
    Route::controller('user', 'UserController');
    //查询
    Route::controller('query', 'QueryController');
    //新闻
    Route::controller('news', 'NewsController');
    //邮箱
    Route::controller('email', 'EmailController');
    //搜索
    Route::controller('search', 'SearchController');
    //应用
    Route::controller('app', 'AppController');
    //论坛
    Route::controller('forum', 'ForumController');
});

//会员
Route::group(['prefix'=> 'user', 'namespace' => 'User'], function(){
    //首页
    Route::controller('index', 'IndexController');
    //好友管理
    Route::controller('user', 'UserController');
    //新闻
    Route::controller('news', 'NewsController');
    //消息
    Route::controller('chat', 'ChatController');
    //论坛
    Route::controller('forum', 'ForumController');
    //添加好友
    Route::controller('add-friend', 'AddFriendController');
    //用户头像
    Route::controller('avatar', 'AvatarController');

});