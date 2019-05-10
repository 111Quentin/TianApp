
@extends("admin.layout.main")


@section('title')
    <li>
        <i class="ace-icon fa fa-home home-icon"></i>
        <a href="/admin/index/index">首页</a>
    </li>

    <li>
        <a href="/admin/manager/index">管理员管理</a>
    </li>
    <li class="active">权限管理</li>
@endsection


@section('content')
<div class="page-container">
    <br>
        <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="admin_permission_add('添加权限节点','/admin/auth/add','','400')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加权限节点</a></span> <span class="r">共有数据：<strong>54</strong> 条</span> </div>
    <br>
        <table class="table table-border table-bordered table-bg" id="table">
            <thead>
                <tr>
                    <th scope="col" colspan="8">权限节点</th>
                </tr>
                <tr class="text-c">
                    <th width="25">
                        <input type="checkbox" name="" value="">
                    </th>
                    <th width="60">ID</th>
                    <th width="150">权限名称</th>
                    <th width="150">控制器名</th>
                    <th width="150">方法名</th>
                    <th width="150">父级权限</th>
                    <th width="150">作为导航</th>
                    <th width="100">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $val)
                <tr class="text-c">
                    <td>
                        <input type="checkbox" value="{{$val -> id}}" name="">
                    </td>
                    <td>{{$val -> id}}</td>
                    <td>{{$val -> auth_name}}</td>
                    <td>@if($val -> controller){{$val -> controller}}@else N/A @endif</td>
                    <td>@if($val -> action){{$val -> action}}@else N/A @endif</td>
                    <td>
                        @if($val -> parent_name)
                            {{$val -> parent_name}}
                        @else
                            顶级权限
                        @endif
                    </td>
                    <td>@if($val -> is_nav == '1')是 @else 否 @endif</td>
                    <td>
                        <a title="编辑" href="javascript:;" onclick="admin_permission_edit('权限编辑','/admin/auth/edit?id={{$val -> id}}',{{$val -> id}},'800','450')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> 
                        <a title="删除" href="javascript:;" onclick="admin_permission_del(this,{{$val -> id}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

