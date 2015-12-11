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

Blade::setContentTags('<%', '%>');         // for variables and all things Blade
Blade::setEscapedContentTags('<%%', '%%>');     // for escaped data

//重定向
Route::get('/', function() {
    return redirect()->action('Admin\Admin\AdminInfoController@getIndex');
});
//后台
Route::group(['prefix'=>'admin', 'namespace' => 'Admin'], function(){
    //重定向
    Route::get('/', function() {
        return redirect()->action('Admin\Admin\AdminInfoController@getIndex');
    });
    //登录
    Route::controller('login', 'LoginController');
    //首页
    Route::controller('home', 'HomeController');
    //权限管理
    Route::group(['prefix'=>'admin', 'namespace' => 'Admin'], function(){
        //后台用户
        Route::controller('info', 'AdminInfoController');
        //后台菜单
        Route::controller('menu', 'AdminMenuController');
        //后台角色
        Route::controller('limit', 'AdminLimitController');
        //后台函数
        Route::controller('function', 'AdminFunctionController');
        //后台日志
        Route::controller('log', 'AdminLogController');
    });
});
//工具
Route::group(['prefix'=>'tools', 'namespace' => 'Tools'],function(){
    //上传
    Route::controller('upload', 'UploadController');
});

