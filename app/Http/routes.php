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
Route::any('admin/login','Admin\LoginController@login' );//登录页面
Route::get('admin/code','Admin\LoginController@code' );//验证码类
Route::get('admin/exit','Admin\LoginController@exit' );//退出登录
Route::get('/','Admin\LoginController@aaa' );//前端页面


Route::group (['prefix'=>'admin','namespace'=>'Admin','middleware'=>['admin']],function (){
//    Route::get('index','IndexController@index' );//登录页面
    Route::get('index','IndexController@index' );//跳转到主页
    Route::get('welcome','IndexController@welcome' );//我的桌面
    Route::any('pass','IndexController@pass' );//修改密码
    // Route::resource('article','ArticleController' );资源路由
//分类管理
    Route::resource('article_list','ArticleController' );   //资讯管理
    Route::post('article/onchageorder','ArticleController@onchageorder' );
    Route::post('article/oar','ArticleController@oar' );
//文章添加
    Route::resource('writing_list','WritingController' );   //资讯管理
    Route::post('writing/onchageorder','WritingController@onchageorder' );
    Route::post('writing/oar','WritingController@oar' );
//图片管理
    Route::resource('picture','PictureController' );
    Route::post('picture/onchageorder','PictureController@onchageorder' );
    Route::post('picture/oar','PictureController@oar' );

});
