@extends("admin.layout.main")

@section('title')
    <li>
        <i class="ace-icon fa fa-home home-icon"></i>
        <a href="/admin/index/index">首页</a>
    </li>

    <li>
        <a href="/admin/manager/index">管理员管理</a>
    </li>
    <li class="active">管理员列表</li>
@endsection


@section('content')
<div class="page-container">
    <br>
        <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="admin_add('添加管理员','/admin/manager/add','800','600')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加管理员</a></span> <span class="r">共有数据：<strong>{{$counts}}</strong> 条</span> </div>
    <br>
    <table class="table table-border table-bordered table-bg" id="table">
                <thead>
                        <tr>
                            <th scope="col" colspan="9">管理员列表</th>
                        </tr>
                        <tr class="text-c">
                            <th width="25">
                                <input type="checkbox" name="" value="">
                            </th>
                            <th width="40">ID</th>
                            <th width="150">用户名</th>
                            <th width="100">头像</th>
                            <th width="90">手机</th>
                            <th width="180">邮箱</th>
                            <th width="80">角色</th>
                            <th width="130">加入时间</th>
                            <th width="100">是否已启用</th>
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
                            <td>{{$val -> username}}</td>
                            <td><img src="{{$val -> avatar}}" width="60" /></td>
                            <td>{{$val -> mobile}}</td>
                            <td>{{$val -> email}}</td>
                            <td>{{$val -> role -> role_name}}</td>
                            <td>{{$val -> created_at}}</td>
                            <td class="td-status">
                                <!-- 判断帐号状态 -->
                                @if($val -> status == '2')
                                <span class="label label-success radius">已启用</span>
                                @else
                                <span class="label radius">已停用</span>
                                @endif
                            </td>
                            <td class="td-manage">
                                 <a title="编辑" href="javascript:;" onclick="admin_edit('管理员编辑','/admin/manager/edit?id={{$val -> id}}',{{$val -> id}},'800','600')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                                 <a title="删除" href="javascript:;" onclick="admin_del(this,{{$val -> id}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
                        </tr>
                          
                        @endforeach
                    </tbody>
        </table>
    </div>
@endsection

