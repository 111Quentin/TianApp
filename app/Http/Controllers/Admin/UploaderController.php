<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//引入storage
use Storage;

class UploaderController extends Controller
{
    // 上传图片到阿里云服务器
    public function webuploader(Request $request){
        //判断是否有文件上传成功
        if($request -> hasFile('file') && $request -> file('file') -> isValid()){
            //有文件上传（重点）
            $filename = sha1(time() . $request -> file('file') -> getClientOriginalName()) . '.' .  $request -> file('file') -> getClientOriginalExtension();
            //文件保存/移动
            Storage::disk('attachment') -> put($filename, file_get_contents($request -> file('file') -> path()));
            //返回数据
            $result = [
                'errCode'		=>		'0',
                'errMsg'		=>		'',
                'succMsg'		=>		'文件上传成功！',
                'path'			=>		asset('attachment/'.$filename)
            ];
        }else{
            //没有文件被上传或者出错
            $result = [
                'errCode'		=>		'000001',
                'errMsg'		=>		$request -> file('file') -> getErrorMessage()
            ];
        }
        //返回信息
        return response() -> json($result);
    }

    //上传视频文件到七牛云
    public function qiniu(Request $request){
        //判断是否有文件上传成功
        if($request -> hasFile('file') && $request -> file('file') -> isValid()){
            //有文件上传（重点）
            $filename = sha1(time() . $request -> file('file') -> getClientOriginalName()) . '.' .  $request -> file('file') -> getClientOriginalExtension();
            //文件保存/移动
            Storage::disk('qiniu') -> put($filename, file_get_contents($request -> file('file') -> path()));
            //返回数据
            $result = [
                'errCode'       =>      '0',
                'errMsg'        =>      '',
                'succMsg'       =>      '文件上传成功！',
                'path'          =>      Storage::disk('qiniu') -> getDriver() -> downloadUrl($filename)
            ];
        }else{
            //没有文件被上传或者出错
            $result = [
                'errCode'       =>      '000001',
                'errMsg'        =>      $request -> file('file') -> getErrorMessage()
            ];
        }
        //返回信息
        return response() -> json($result);
    }
}
