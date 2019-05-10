<?php

use Illuminate\Http\Request;

//解决跨域问题
// 允许所有的远程主机访问接口
header('Access-Control-Allow-Origin:*');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: Content-Type,Access-Token");
header("Access-Control-Expose-Headers: *");


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

include __DIR__.'/api/content.php';
