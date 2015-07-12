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


Route::get('home', 'HomeController@index');

Route::controllers([
	'auth'      => 'Auth\AuthController',
	'password'  => 'Auth\PasswordController',
]);

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
});

//前台
Route::group(['prefix'=> 'home', 'namespace' => 'Home'], function(){
    //首页
    Route::controller('index', 'IndexController');
    //会员
    Route::controller('user', 'UserController');
});