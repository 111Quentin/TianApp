<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

define('LARAVEL_START', microtime(true));   //定义常量

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels great to relax.
|
*/

// 1.注册自动加载类
require __DIR__.'/../vendor/autoload.php'; //包含autoload.php 自动加载类文件

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/

// 2.加载框架
$app = require_once __DIR__.'/../bootstrap/app.php';  //包含app.php启动文件

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/



$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class); //由于上面包含了app.php文件,可以直接使用$app对象

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);      //使用$kernel对象调用handle()方法

$response->send();

$kernel->terminate($request, $response);
