<!-- 继承模板 -->
@extends("admin.layout.main")


@section('title')
    <li>
        <i class="ace-icon fa fa-home home-icon"></i>
        <a href="/admin/index/index">首页</a>
    </li>

    <li>
        <a href="/admin/manager/index">管理员管理</a>
    </li>
    <li class="active">角色管理</li>
@endsection


@section('content')
<div class="page-container">
    <br>
<div class="cl pd-5 bg-1 bk-gray"> <span class="l"> <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a class="btn btn-primary radius" href="javascript:;" onclick="admin_role_add('添加角色','/admin/role/add','800')"><i class="Hui-iconfont">&#xe600;</i> 添加角色</a> </span> <span class="r">共有数据：<strong>54</strong> 条</span> </div>
    <br>
    <table class="table table-border table-bordered table-bg" id="table">
            <thead>
                    <tr>
                        <th scope="col" colspan="6">角色管理</th>
                    </tr>
                    <tr class="text-c">
                        <th width="25">
                            <input type="checkbox" value="" name="">
                        </th>
                        <th width="40">ID</th>
                        <th width="100">角色名</th>
                        <th width="150">权限id集合</th>
                        <th width="150">权限ac集合</th>
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
                    <td>{{$val -> role_name}}</td>
                    <td>{!!str_limit($val -> auth_ids,30,'...')!!}</td>
                    <td>{!!str_limit($val -> auth_ac,90,'...')!!}</td>
                    <td class="f-14">
                    	<a title="分派权限" href="javascript:;" onclick="admin_role_assign('分派权限','/admin/role/assign','{{$val -> id}}')" style="text-decoration:none"><i class="Hui-iconfont">&#xe603;</i></a>
                    	&nbsp;
                        <a title="编辑" href="javascript:;" onclick="admin_role_edit('角色编辑','/admin/role/edit?id={{$val -> id}}',{{$val -> id}})" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                        &nbsp;
                        <a title="删除" href="javascript:;" onclick="admin_role_del(this,{{$val -> id}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

