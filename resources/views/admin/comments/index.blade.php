<!-- 继承模板 -->
@extends("admin.layout.main")

@section('title')
    <li>
        <i class="ace-icon fa fa-home home-icon"></i>
        <a href="/admin/index/index">首页</a>
    </li>

    <li>
        <a href="/admin/posts">动态管理</a>
    </li>
    <li class="active">评论列表</li>
@endsection

@section('content')
    <div class="page-container">
        <form action="" method="post" class="form-horizontal" role="form">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">评论列表</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                            <thead>
                            <tr>
                                <th width="100">编号</th>
                                <th>动态ID</th>
                                <th>会员ID</th>
                                <th>父级ID</th>
                                <th>评论内容</th>
                                <th>评论层级</th>
                                <th>创建时间</th>
                                <th width="120">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $d)
                                <tr>
                                    <td>{{$d['id']}}</td>
                                    <td>{{$d['posts_id']}}</td>
                                    <td>{{$d['member_id']}}</td>
                                    <td>{{$d['parent_id']}}</td>
                                    <td>{{$d['content']}}</td>
                                    <td>{{$d['level']}}</td>
                                    <td>{{$d['created_at']}}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="javascript:;" onclick="remove({{$d['id']}})"
                                               class="btn btn-danger">删除</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                    </table>
                <div align="center">
                    {{$data->links()}}
                </div>
            </div>
        </form>
    </div>

    {{-- js --}}
    <script src="/admin/assets/js/jquery-2.1.4.min.js"></script>
    <script>
        // 越过csrf
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function remove(id) {
            layer.confirm('确认要删除吗？', function(index) {
                $.ajax({
                    url: '/admin/comment/' + id,
                    method: 'DELETE',
                    dataType: "json",
                    success: function(data) {
                        // //判断添加结果
                        if(data == '1'){
                            layer.msg('已删除!', { icon: 1, time: 1000 },function(){
                                parent.window.location = parent.window.location;
                                layer.close(index);
                            });
                        }else{
                            layer.msg('删除失败!', { icon: 2, time: 1000 });
                            layer.close(index);
                        }
                    },
                    error: function(data) {
                        layer.msg('删除失败!', { icon: 5, time: 1000 });
                    },
                });
            });
        }
    </script>
@endsection

