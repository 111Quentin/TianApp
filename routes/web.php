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

//根目录路由
Route::group(['namespace' => 'Admin'],function(){
    // 后台登录界面
       Route::get('/','PublicController@login') -> name('login');   //进行路由命名,因为auth中间件官方固定调到login路由
});




// 引入后台路由文件
include __DIR__.'/admin/web.php';    // __DIR__ 返回当前路径
