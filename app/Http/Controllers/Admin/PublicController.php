<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;  //引入Request类
use Auth; //引入app.app的Auth门脸类
use App\Http\Controllers\Controller;

class PublicController extends Controller
{
    //定义登录方法
    public function login(){
        // 展示登录视图
        return view('admin.public.login');
    }

    // 定义处理登录的方法(引入$requset)

    // 使用依赖注入,也可以使用use Request,就可以使用外观模式直接使用Request
    public function check(Request $request){
       // 开始自动验证
       $this->validate($request,[
         //验证规则语法   需要验证的字段名 => '验证规则1|验证规则2|验证规则3:20|...'
            //用户名，必填，长度介于2~20
            'username'  =>  'required|min:2|max:20',
            //密码，必填，长度至少是6
            'password'  =>  'required|min:6',
            //验证码，必填，长度等于5，必须是合法的验证码
            'captcha'   =>  'required|captcha'
       ]);

       // 继续开始身份核实
       $data = request(['username','password']); //获取部分参数
       $data['status'] = 2; //要求状态为启动的用户
       $result = Auth::guard('admin')->attempt($data);  // 使用attempt()方法可以指定验证的字段

       if($result){
          // 说明登录成功,重定向到后台首页
          return redirect('/admin/index/index');
       }
       else{
          // 说明登录失败,并提示报错信息
            return redirect('/admin/public/login')->withErrors([
                'loginError' => '用户名或密码错误！'
            ]);
       }
    }

    // 定义退出登录的方法
    public function logout(){
        //注销用户,清除用户的session信息
        Auth::guard('admin')->logout();
        //重定向到登录界面
        return redirect('/admin/public/login');
    }
}
