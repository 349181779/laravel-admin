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

Route::get('/', 'WelcomeController@index');


Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

//后台
Route::group(['prefix'=>'admin','namespace' => 'Admin'],function(){
    //登录
    Route::controller('login','LoginController');
    //首页
    Route::controller('index','AdminHomeController');
    //权限
    Route::controller('role','AdminRoleController');
    //后台菜单
    Route::controller('menu','MenuController');
    //后台用户
    Route::controller('admininfo','AdmininfoController');
    //会员用户
    Route::controller('userinfo','UserinfoController');
});

//Tools
Route::group(['prefix'=>'tools','namespace' => 'Tools'],function(){
    //MarkDown Route
    Route::controller('mark','MarkDownController');
    //Filter Route
    Route::controller('filter','FilterController');
    //Agent Route
    Route::controller('agent','AgentController');
    //Pinyin Route
    Route::controller('pinyin','PinyinController');
});