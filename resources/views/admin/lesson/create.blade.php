<!-- 继承模板 -->
@extends("admin.layout.main")

@section('title')
    <li>
        <i class="ace-icon fa fa-home home-icon"></i>
        <a href="/admin/index/index">首页</a>
    </li>

    <li>
        <a href="/admin/lesson">课程管理</a>
    </li>
    <li class="active">新增课程</li>

@endsection


@section('content')


    <div class="page-container">
        <ul class="nav nav-tabs">
            <li ><a href="/admin/lesson/">课程列表</a></li>
            <li class="active"><a href="/admin/lesson/create">新增课程</a></li>
        </ul>

        <form action="/admin/lesson" method="post" class="form-horizontal" role="form">
            {{csrf_field()}}
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">课程管理</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">课程</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">介绍</label>
                        <div class="col-sm-10">
                                <textarea name="introduce" class="form-control" rows="5" required></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"> 选择标签 </label>
                        <div class="col-sm-10">
                            <select class="js-example-basic-multiple" name="tag_list[]" multiple="multiple" required>
                                @foreach($tags as $val)
                                <option value="{{$val['id']}}">{{$val['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">图片上传路径</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="preview" readonly="" >
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
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">推荐</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" name="iscommend" value="1"> 是
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="iscommend" value="0" checked> 否
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">热门</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" name="ishot" value="1"> 是
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="ishot" value="0" checked> 否
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">点击数</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="click" required value="0">
                        </div>
                    </div>
                </div>
            </div>



            {{-- id为app的是由vue.js进行管理--}}
            <div class="panel panel-danger" id="app">
                <div class="panel-heading">
                    <h3 class="panel-title">视频管理</h3>
                </div>
                <div class="panel-body">
                    <div class="wu-example" id="uploader">
                    <div class="panel panel-danger" v-for="(v,k) in videos">
                        {{-- webuploader 上传文件的html代码 --}}
                        <div class="panel-body">
                            <!--用来存放文件信息-->
                            <div id="thelist" class="uploader-list"></div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">视频标题</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" v-model="v.title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">视频地址</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" v-model="v.path">
                                    <br>
                                    <div class="input-group">
                                        <div class="btns">
                                            <div  class="uploadImg  asd" :id="v.id">选择视频</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-2">
                                    <button class="btn btn-success btn-sm" @click.prevent="del(k)">
                                        删除视频
                                    </button>
                                </div>

                            </div>
                        </div>
                       </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-danger" @click.prevent="add">添加视频</button>
                </div>
                <textarea name="videos" hidden>@{{videos}}</textarea>
            </div>

            <button class="btn btn-success">保存数据</button>
        </form>
    </div>


    <!-- 引入webuploader的JavaScript文件 -->
    <script src="/admin/assets/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="/statics/webuploader-0.1.5/webuploader.js"></script>


    {{-- 初始化select2 --}}
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>


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
            $("[name='preview']").val(response.path);
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

    {{-- 上传视频js--}}
    <script>
                {{-- 新建一个Vue实例--}}
        var app = new Vue({
                el: '#app',
                data: {
                    videos: []
                },
                methods: {
                    add: function () {
                        var field = {title: '', path: '', id: 'hd' + Date.parse(new Date())};
                        this.videos.push(field);

                        setTimeout(function () {
                            upload(field);
                        }, 2);

                        setTimeout(function () {
                            $('.asd').each(function () {
                                // $(this).removeClass('webuploader-pick-hover');
                                $(this).find('.webuploader-pick').each(function () {
                                    if($(this).html()== "选择视频"){
                                    }
                                    else{
                                        $(this).removeClass('webuploader-pick');
                                        $(this).removeClass('webuploader-pick-hover');
                                    }
                                })
                            })
                        }, 2);
                    },
                    del: function (k) {
                        this.videos.splice(k, 1);
                    }
                }
            });


        //    封装上传的方法
        _extensions = '3gp,mp4,rmvb,mov,avi,m4v';
        _mimeTypes = 'video/*,audio/*,application/*';
        function upload(field){
            $list = $('#thelist'),
                $btn = $('#ctlBtn'),
                state = 'pending',
                uploader;

            uploader = WebUploader.create({
                // 添加csrf认证(非常重要)
                formData: {
                    //在外部为任何文件中都不能使用模版引擎的语法
                    _token: $('input[name=_token]').val(),
                },
                //选完文件后,自动上传
                auto:true,
                // 不压缩image
                resize: false,
                // swf文件路径
                swf: '/statics/webuploader-0.1.5/Uploader.swf',
                // 文件接收服务端,获取上传至七牛云的结果
                server: '/admin/uploader/qiniu',
                // 选择文件的按钮。可选。
                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                pick: '.uploadImg',
                //限制文件格式
                accept: {
                    title: 'Videos',
                    extensions: _extensions,
                    mimeTypes: _mimeTypes
                },
            });

            // 当有文件添加进来的时候
            uploader.on( 'fileQueued', function( file ) {
                $list.append( '<div id="' + file.id + '" class="item">' +
                    '<h4 class="info">' + file.name + '</h4>' +
                    '<p class="state">等待上传...</p>' +
                    '</div>' );
            });

            // 文件上传过程中创建进度条实时显示。
            uploader.on( 'uploadProgress', function( file, percentage ) {
                var $li = $( '#'+file.id ),
                    $percent = $li.find('.progress .progress-bar');

                // 避免重复创建
                if ( !$percent.length ) {
                    $percent = $('<div class="progress progress-striped active">' +
                        '<div class="progress-bar" role="progressbar" style="width: 0%">' +
                        '</div>' +
                        '</div>').appendTo( $li ).find('.progress-bar');
                }
                $li.find('p.state').text('上传中');
                $percent.css( 'width', percentage * 100 + '%' );
            });

            uploader.on( 'uploadSuccess', function( file , response) {
                $( '#'+file.id ).find('p.state').text('已上传');
                field.path = response.path;
            });

            uploader.on( 'uploadError', function( file ) {
                $( '#'+file.id ).find('p.state').text('上传出错');
            });

            uploader.on( 'uploadComplete', function( file ) {
                $( '#'+file.id ).find('.progress').fadeOut();
            });

            uploader.on( 'all', function( type ) {
                if ( type === 'startUpload' ) {
                    state = 'uploading';
                } else if ( type === 'stopUpload' ) {
                    state = 'paused';
                } else if ( type === 'uploadFinished' ) {
                    state = 'done';
                }

                if ( state === 'uploading' ) {
                    $btn.text('暂停上传');
                } else {
                    $btn.text('开始上传');
                }
            });

            $btn.on( 'click', function() {
                if ( state === 'uploading' ) {
                    uploader.stop();
                } else {
                    uploader.upload();
                }
            });
        }
    </script>
@endsection

