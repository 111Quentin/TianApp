<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TianApp教育学习后台</title>
    <meta name="keywords" content="TianApp教育学习后台"/>
    <meta name="description" content="TianApp教育学习后台"/>
    <!-- favicon 图标 -->
    <link rel="shortcut icon" href="/admin/images/favicon4.ico">
    <link rel="stylesheet" type="text/css" href="/admin/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/css/util.css">
    <link rel="stylesheet" type="text/css" href="/admin/css/main.css">
</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('/admin/images/bg-01.jpg');">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                <form class="login100-form validate-form" action="/admin/public/check" method="post">
                    <span class="login100-form-title p-b-49">TianApp&nbsp;后台登录</span>

                    <div class="wrap-input100 validate-input m-b-23" data-validate="请输入用户名">
                        <span class="label-input100">用户名</span>
                        <input class="input100" type="text" placeholder="请输入用户名" autocomplete="off" name="username">
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-23" data-validate="请输入密码">
                        <span class="label-input100">密码</span>
                        <input class="input100" type="password" placeholder="请输入密码" name="password">
                        <span class="focus-input100" data-symbol="&#xf190;"></span>
                    </div>

                    <div id="box">
                         <div class="wrap-input200 validate-input" data-validate="请输入验证码">
                                <span class="label-input200">验证码</span>
                                <input class="input200" type="text" name="captcha" placeholder="请输入验证码">
                                <span class="focus-input200" data-symbol="&#xf191;"></span>

                        </div>
                            <img src="{{captcha_src()}}" alt="验证码" id="img">
                    </div>

                    {{-- 处理csrf token --}}
                    {{csrf_field()}}

                    <div class="text-right p-t-8 p-b-31">
                        <a href="javascript:">忘记密码？</a>
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">登&nbsp;&nbsp;录</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="/admin/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="/admin/js/main.js"></script>
    {{-- 引入layer.js弹窗 --}}
    <script src="/admin/lib/layer/2.4/layer.js"></script>
    {{-- 控制验证码点击更换 --}}
    <script>
        {{-- 定义自调用函数,避免命名冲突 --}}
       $(function(){
           // 给验证码绑定点击事件
           var src = $('#img').attr('src');
           $('#img').click(function(){
              $(this).attr('src',src + '&_=' + Math.random());
           });

           @if ($errors->any())
              // Javascript形式输出错误的内容
              var allError = '';
            @foreach ($errors->all() as $error)
              allError += "{{ $error }}<br>";
            @endforeach
             // 以弹窗形式显示错误
              layer.alert(allError,{title:'错误提示',icon:5});
           @endif
       });
    </script>
</body>

</html>
