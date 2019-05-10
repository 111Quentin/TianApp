<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" href="/admin/css/iconfont.css">
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />
    <title>添加用户 - 用户管理</title>
</head>

<body>
      <article class="page-container">
        <form class="form form-horizontal" id="form-admin-edit">
            {{-- 隐藏域 --}}
            <input type="hidden" name="id" value="{{$data -> id}}">                           
            
            {{-- 权限名 --}}
            <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>权限名称：</label>
                    <div class="formControls col-xs-8 col-sm-9">
                        <input type="text" class="input-text" value="{{$data -> auth_name}}" placeholder="" id="auth_name" name="auth_name">
                    </div>
            </div>
    
            {{-- 控制器名 --}}
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">控制器名：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="{{$data -> controller}}" placeholder="" id="controller" name="controller">
                </div>
            </div>
    
            {{-- 方法名 --}}
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">方法名：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" placeholder="" name="action" id="action" value="{{$data -> action}}">
                </div>
            </div>

            {{-- 权限 --}}
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>父级权限：</label>
                <div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
            <select class="select" name="pid" size="1">
                <option value="0">作为顶级权限</option>
                @foreach($parents as $val)
                    <option  @if($val -> id == $data -> pid) selected @endif  value="{{$val -> id}}">{{$val -> auth_name}}</option>
                @endforeach
            </select>
            </span> </div>
            </div>

            {{-- 是否作为导航 --}}
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>作为导航：</label>
                <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                    <div class="radio-box">
                        <input name="is_nav" type="radio" value="1" id="is_nav-1" @if($data -> is_nav == 1) checked @endif>
                        <label for="is_nav-1">是</label>
                    </div>
                    <div class="radio-box">
                        <input type="radio" id="is_nav-2" value="2" name="is_nav" @if($data -> is_nav == 2) checked @endif>
                        <label for="is_nav-2">否</label>
                    </div>
                </div>
            </div>
            
            <!-- csrf隐藏域 -->
            {{csrf_field()}}
            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                        @include("admin.layout.error")
                    <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                </div>
            </div>
        </form>
    </article>
    <!--_footer 作为公共模版分离出去-->
    <script src="/admin/assets/js/jquery-2.1.4.min.js"></script>
    <script src="/admin/lib/layer/2.4/layer.js"></script>
    <script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script>
    <script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script>
    <!--/_footer 作为公共模版分离出去-->
    <!--请在下方写此页面业务相关的脚本-->
    <script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
    <script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
    <script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
    {{-- 管理员模块 --}}
    <script>
      $(function(){
        // 单选框样式
        $('.skin-minimal input').iCheck({
        checkboxClass: 'icheckbox-blue',
        radioClass: 'iradio-blue',
        increaseArea: '20%'
        });


        // 验证表单字段
        $("#form-admin-edit").validate({
            rules: {
                auth_name: {
                    required: true
                }
            },
            onkeyup: false,
            focusCleanup: true,
            success: "valid",
            submitHandler: function(form) {
                $(form).ajaxSubmit({
                    type: 'post',
                    url: "/admin/auth/edit",//自己提交给自己可以不写url
                    success: function(data) {
                        //判断添加结果
                        if(data == '1'){
                        	layer.msg('更新成功!', { icon: 1, time: 2000 },function(){
	                        	var index = parent.layer.getFrameIndex(window.name);
				                parent.window.location = parent.window.location;
				                parent.layer.close(index);
	                        });
                        }else{
                        	layer.msg('更新失败!', { icon: 2, time: 2000 });
                        } 
                    },
                    error: function(XmlHttpRequest, textStatus, errorThrown) {
                        layer.msg('error!', { icon: 2, time: 1000 });
                    }
                });
            }
        });
      });      
    </script>
    <!--/请在上方写此页面业务相关的脚本-->
</body>

</html>
