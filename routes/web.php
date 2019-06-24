<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'BlogController@redirect')->name('blog.redirect');
Route::get('/blog', 'BlogController@index')->name('blog.home');

//后台路由
Route::get('/admin', 'BlogController@show')->name('show');

Route::middleware('auth')->namespace('Admin')->group(function (){

    Route::resource('admin/post', 'PostController', ['except' => 'show']);
    Route::resource('admin/tag', 'TagController', ['except' => 'show']);
    Route::get('admin/upload', 'UploadController@index');

    Route::post('admin/upload/file', 'UploadController@uploadFile');
    Route::delete('admin/upload/file', 'UploadController@deleteFile');
    Route::post('admin/upload/folder', 'UploadController@createFolder');
    Route::delete('admin/upload/folder', 'UploadController@deleteFolder');
});

//登录退出
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/blog/{slug}', 'BlogController@showPost')->name('blog.detail');

//联系我们邮箱路由
Route::get('/contact', 'ContactController@showForm');
Route::post('/contact', 'ContactController@sendContactInfo');

//添加订阅路由
Route::get('rss', 'BlogController@rss');

//生成站点地图路由
Route::get('sitemap.xml', 'BlogController@siteMap');
