<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" href="/admin/css/iconfont.css">
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />
    <!-- 引入webuploader的需要css文件 -->
    <link rel="stylesheet" type="text/css" href="/statics/webuploader-0.1.5/webuploader.css">
    <title>编辑用户 - 用户管理</title>
</head>

<body>
      <article class="page-container">
        <form class="form form-horizontal" id="form-admin-edit">
            <input type="hidden" name="id" value="{{$data -> id}}">                           
            {{-- 用户名 --}}
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>用户名：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text"  placeholder="" id="username" name="username" value="{{$data->username}}">
                </div>
            </div>

            {{-- 密码 --}}
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>密码：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="password" class="input-text" value="{{$data->password}}" placeholder="" id="password" name="password">
                </div>
            </div>

            {{-- 重复密码 --}}
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>重复密码：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="password" class="input-text" value="{{$data->password}}" placeholder="" id="repasswd" name="repasswd">
                </div>
            </div>
           
            {{-- 性别 --}}
            <div class="row cl">
                    <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>性别：</label>
                    <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                        
                        <div class="radio-box">
                            <input name="gender" type="radio" value="1" id="is_nav-1" @if($data->gender == 1) checked @endif>
                            <label for="is_nav-1">男</label>
                        </div>
                        <div class="radio-box">
                            <input type="radio" id="is_nav-2" value="2" name="gender" @if($data->gender == 2) checked @endif>
                            <label for="is_nav-2">女</label>
                        </div>
                        <div class="radio-box">
                                <input type="radio" id="is_nav-3" value="3" name="gender" @if($data->gender == 3) checked @endif>
                                <label for="is_nav-3">未知</label>
                        </div>
                    </div>
            </div>



            {{-- 手机号码 --}}
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">手机号：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="{{$data->mobile}}" placeholder="" id="mobile" name="mobile">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">邮箱: </label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" placeholder="" name="email" id="email" value="{{$data->email}}">
                </div>
            </div>

            {{--头像--}}
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">头像：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" name="avatar" readonly=""  value="{{$data->avatar}}">
                    <div class="input-group">
                        <br>
                        <div id="uploader-demo">
                            <!--用来存放item-->
                            <div id="fileList" class="uploader-list"></div>
                            <div id="filePicker">选择图片</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>角色：</label>
                <div class="formControls col-xs-8 col-sm-9"> 
                    <span class="select-box" style="width:150px;">
                    <select class="select" name="role_id" size="1" id="role_id">
                        <option value="0">请选择</option>
                        @foreach($roles as $val) --}}
                            <option  @if($val->id == $data->role_id)  selected @endif  value="{{$val -> id}}">{{$val -> role_name}}</option>
                        @endforeach
                    </select>
                     </span> 
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
      <!-- 引入webuploader的JavaScript文件 -->
      <script type="text/javascript" src="/statics/webuploader-0.1.5/webuploader.js"></script>
    <script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script>
    <script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script>
    <!--/_footer 作为公共模版分离出去-->
    <!--请在下方写此页面业务相关的脚本-->
    <script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
    <script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
    <script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>

      {{-- 上传图片 --}}
      <script>
          jQuery(function() {
              var $ = jQuery,
                  $list = $('#fileList'),
                  // 优化retina, 在retina下这个值是2
                  ratio = window.devicePixelRatio || 1,

                  // 缩略图大小
                  thumbnailWidth = 100 * ratio,
                  thumbnailHeight = 100 * ratio,

                  // Web Uploader实例
                  uploader;

              // 初始化Web Uploader
              uploader = WebUploader.create({
                  //添加一些自己需要的参数
                  formData: {
                      //在外部为任何文件中都不能使用模版引擎的语法
                      _token: $('input[name=_token]').val(),
                  },
                  // 自动上传。
                  auto: true,

                  // swf文件路径
                  swf: '/statics/webuploader-0.1.5/Uploader.swf',

                  // 文件接收服务端。
                  server: '/admin/uploader/webuploader',//云存储

                  // 选择文件的按钮。可选。
                  // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                  pick: '#filePicker',

                  // 只允许选择文件，可选。
                  accept: {
                      title: 'Images',
                      extensions: 'gif,jpg,jpeg,bmp,png',
                      mimeTypes: 'image/*'
                  }
              });

              // 当有文件添加进来的时候
              uploader.on( 'fileQueued', function( file ) {
                  var $li = $(
                      '<div id="' + file.id + '" class="file-item thumbnail">' +
                      '<img>' +
                      '<div class="info">' + file.name + '</div>' +
                      '</div>'
                      ),
                      $img = $li.find('img');

                  $list.append( $li );

                  // 创建缩略图
                  uploader.makeThumb( file, function( error, src ) {
                      if ( error ) {
                          $img.replaceWith('<span>不能预览</span>');
                          return;
                      }

                      $img.attr( 'src', src );
                  }, thumbnailWidth, thumbnailHeight );
              });

              // 文件上传过程中创建进度条实时显示。
              uploader.on( 'uploadProgress', function( file, percentage ) {
                  var $li = $( '#'+file.id ),
                      $percent = $li.find('.progress span');

                  // 避免重复创建
                  if ( !$percent.length ) {
                      $percent = $('<p class="progress"><span></span></p>')
                          .appendTo( $li )
                          .find('span');
                  }

                  $percent.css( 'width', percentage * 100 + '%' );
              });

              // 文件上传成功，给item添加成功class, 用样式标记上传成功。
              uploader.on( 'uploadSuccess', function( file,response) {
                  $( '#'+file.id ).addClass('upload-state-done');
                  //需要将返回值中path写到隐藏域中
                  $("[name='avatar']").val(response.path);
              });

              // 文件上传失败，现实上传出错。
              uploader.on( 'uploadError', function( file ) {
                  var $li = $( '#'+file.id ),
                      $error = $li.find('div.error');

                  // 避免重复创建
                  if ( !$error.length ) {
                      $error = $('<div class="error"></div>').appendTo( $li );
                  }

                  $error.text('上传失败');
              });

              // 完成上传完了，成功或者失败，先删除进度条。
              uploader.on( 'uploadComplete', function( file ) {
                  $( '#'+file.id ).find('.progress').remove();
              });
          });
      </script>


    {{-- 管理员模块 --}}
    <script>
      $(function(){
        // 单选框样式
        $('.skin-minimal input').iCheck({
        checkboxClass: 'icheckbox-blue',
        radioClass: 'iradio-blue',
        increaseArea: '20%'
        });

          // 越过csrf
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });


          // 验证表单字段
        $("#form-admin-edit").validate({
            rules: {
                username: {
                    required: true,
                    minlength: 2,
                    maxlength: 20
                },
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 80
                },
                repasswd: {
                    required: true,
                    minlength: 6,
                    maxlength: 80,
                    equalTo: "#password"
                },
                mobile: {
                    required: true,
                    isMobile: true
                },
                email: {
                    required: true,
                    email: true
                },
                role_id: {
                    required: true,
                },
            },
            // 编写提示信息
            messages: {
                username: {
                    required: "请输入用户名",
                    minlength: "用户名最少由两个字母组成"
                },
                password: {
                    required: "请输入密码",
                    minlength: "密码长度不能小于 6个字母",
                    maxlength: "密码长度不能超过20个字母"
                },
                repasswd: {
                    required: "请再次输入密码",
                    minlength: "密码长度不能小于6 个字母",
                    maxlength: "密码长度不能超过20个字母",
                    equalTo: "两次密码输入不一致"
                },
                mobile: {
                    required: "请填写手机号码",
                    isMobile: "手机号码格式有误",
                },
                email: {
                    required: "请填写邮箱地址",
                    email: "邮箱格式有误"
                },
                role_id:{
                    required: "请选择角色",
                }
            },
            onkeyup: false,
            focusCleanup: true,
            success: "valid",
            submitHandler: function(form) {
                $(form).ajaxSubmit({
                    type: 'post',
                    url: "/admin/manager/edit",//自己提交给自己可以不写url
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
