<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// 设计成抽象类,只能被继承
abstract class CommonController extends Controller
{
    // 设计接口的返回数据格式
    public  function  response($data,$code = 200){
           return ['code' => $code,'data' => $data];
    }


}
