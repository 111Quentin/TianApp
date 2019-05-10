<!-- 继承模板 -->
@extends("admin.layout.main")

@section('title')
    <li>
        <i class="ace-icon fa fa-home home-icon"></i>
        <a href="/admin/index/index">首页</a>
    </li>

    <li>
        <a href="/admin/tag">标签管理</a>
    </li>
    <li class="active">标签列表</li>
@endsection


@section('content')
    <div class="page-container">
        <br>
            <ul class="nav nav-tabs">
                    <li class="active"><a href="">标签列表</a></li>
                    <li><a href="/admin/tag/create">新增标签</a></li>
            </ul>

            <div class="row">
                    <div class="col-xs-12">
                        <table id="simple-table" class="table  table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="70" class="center">编号</th>
                                    <th class="center">标签名称</th>
                                    <th  class="center" width="150">操作</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($data as $val)
                                <tr>
                                    <td class="center">{{$val -> id}}</td>
                                
                                    <td class="center">{{$val -> name}}</td>
                                    
                                    <td class="center">
                                        <div class="hidden-sm hidden-xs btn-group">
                                        
                                            {{-- 编辑 --}}
                                            <a href="/admin/tag/{{$val['id']}}/edit">
                                                <button class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </button>
                                            </a>
                                            {{-- 删除 --}}
                                            <a href="javascript:void(0)" onclick="del({{$val['id']}})">
                                                <button class="btn btn-xs btn-danger">
                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div align="center">
                            {{$data->links()}}
                        </div>
                    </div><!-- /.span -->
                </div><!-- /.row -->
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

        function del(id) {
            layer.confirm('确认要删除吗？', function(index) {
                $.ajax({
                    url: '/admin/tag/' + id,
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

