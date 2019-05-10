<!-- 继承模板 -->
@extends("admin.layout.main")

@section('title')
    <li>
        <i class="ace-icon fa fa-home home-icon"></i>
        <a href="/admin/index/index">首页</a>
    </li>

    <li>
        <a href="/admin/goods">图书管理</a>
    </li>
    <li class="active">编辑图书</li>

@endsection


@section('content')


    <div class="page-container">
        <ul class="nav nav-tabs">
            <li ><a href="/admin/goods/">图书列表</a></li>
            <li class="active"><a href="/admin/goods/create">新增图书</a></li>
        </ul>

        <form action="/admin/goods/{{$goods['id']}}" method="post" class="form-horizontal" role="form">
            {{csrf_field()}}
            {{-- 使用PUT方法提交 --}}
            {{ method_field('PUT') }}
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">图书管理</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">图书编号</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="goods_sn" required value="{{$goods['goods_sn']}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">图书名称</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="goods_name" required value="{{$goods['goods_name']}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">图书库存</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="goods_nums" required value="{{$goods['goods_nums']}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">市场价格</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="market_price" required placeholder="保留到小数点后两位" value="{{$goods['market_price']}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">销售价格</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="shop_price" required placeholder="保留到小数点后两位" value="{{$goods['shop_price']}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">图片上传路径</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="goods_thumb" readonly=""  value="{{$goods['goods_thumb']}}">
                            <img src="{{$goods['goods_thumb']}}" alt="" id="goods_thumb">
                            <div class="input-group">
                                <br>
                                {{-- 上传图片 --}}
                                <div id="uploader-demo">
                                    <!--用来存放item-->
                                    <div id="fileList" class="uploader-list"></div>
                                    <div id="filePicker">选择图片</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="wu-example" id="uploader"></div>
            <button class="btn btn-danger">保存数据</button>
        </form>
    </div>


    <!-- 引入webuploader的JavaScript文件 -->
    <script src="/admin/assets/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="/statics/webuploader-0.1.5/webuploader.js"></script>

    {{-- 引入Vue.js --}}
    <script src="/admin/js/vue.js"></script>
    {{-- 上传图片 --}}
    <script>
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
            // swf文件路径（修改为swf文件的真实路径）
            swf: '/statics/webuploader-0.1.5/Uploader.swf',
            // 文件接收服务端（修改为后端处理文件上传的路由）
            // server: '/admin/uploader/webuploader',//本地存储
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
        uploader.on('fileQueued', function(file) {
            var $li = $(
                '<div id="' + file.id + '" class="file-item thumbnail">' +
                '<img>' +
                '<div class="info">' + file.name + '</div>' +
                '</div>'
                ),
                $img = $li.find('img');
            //选择新图之前先清除之前的预览数据
            $('.thumbnail').remove();
            $list.append($li);
            $('#goods_thumb').hide();
            // 创建缩略图
            uploader.makeThumb(file, function(error, src) {
                if (error) {
                    $img.replaceWith('<span>不能预览</span>');
                    return;
                }

                $img.attr('src', src);
            }, thumbnailWidth, thumbnailHeight);
        });

        // 文件上传过程中创建进度条实时显示。
        uploader.on('uploadProgress', function(file, percentage) {
            var $li = $('#' + file.id),
                $percent = $li.find('.progress span');

            // 避免重复创建
            if (!$percent.length) {
                $percent = $('<p class="progress"><span></span></p>')
                    .appendTo($li)
                    .find('span');
            }

            $percent.css('width', percentage * 100 + '%');
        });

        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on('uploadSuccess', function(file,response) {
            $('#' + file.id).addClass('upload-state-done');
            //需要将返回值中path写到隐藏域中
            $("[name='goods_thumb']").val(response.path);
        });

        // 文件上传失败，现实上传出错。
        uploader.on('uploadError', function(file) {
            var $li = $('#' + file.id),
                $error = $li.find('div.error');

            // 避免重复创建
            if (!$error.length) {
                $error = $('<div class="error"></div>').appendTo($li);
            }

            $error.text('上传失败');
        });

        // 完成上传完了，成功或者失败，先删除进度条。
        uploader.on('uploadComplete', function(file) {
            $('#' + file.id).find('.progress').remove();
        });
    </script>
@endsection

