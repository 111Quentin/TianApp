<!-- 继承模板 -->
@extends("admin.layout.main")

@section('title')
    <li>
        <i class="ace-icon fa fa-home home-icon"></i>
        <a href="/admin/index/index">首页</a>
    </li>

    <li>
        <a href="/admin/tag/index">标签管理</a>
    </li>
    <li class="active">新增标签</li>
@endsection

@section('content')
    <div class="page-container">
        <ul class="nav nav-tabs">
            <li><a href="/admin/tag">标签列表</a></li>
            <li class="active"><a href="/admin/tag/create">新增标签</a></li>
        </ul>
        <form action="/admin/tag" method="post" class="form-horizontal" role="form">
            {{csrf_field()}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">标签管理</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">标签</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        
                    </div>
                    @include("admin.layout.error")
                </div>
            </div>
            
            <button class="btn btn-primary">保存数据</button>
        </form>
    </div>
@endsection

