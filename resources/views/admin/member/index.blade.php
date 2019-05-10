
@extends("admin.layout.main")

@section('title')
    <li>
        <i class="ace-icon fa fa-home home-icon"></i>
        <a href="/admin/index/index">首页</a>
    </li>

    <li>
        <a href="/admin/manager/index">会员管理</a>
    </li>
    <li class="active">会员列表</li>
@endsection

@section('content')
<div class="page-container">
    <br><br>
        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="member_add('添加会员','/admin/member/create','','510')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加会员</a></span> <span class="r">共有数据：<strong>{{$counts}}</strong> 条</span>
        </div>
    <br>
        <table class="table table-border table-bordered table-bg" id="table">
            <thead>
                    <tr class="text-c">
                        <th width="25">
                            <input type="checkbox" name="" value="">
                        </th>
                        <th width="40">ID</th>
                        <th width="100">会员名</th>
                        <th width="100">头像</th>
                        <th width="60">性别</th>
                        <th width="90">手机</th>
                        <th width="80">邮箱</th>
                        <th width="130">加入时间</th>
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
                        <td>@if($val -> gender == '1')男@elseif($val -> gender == '2')女@else保密@endif</td>
                        <td>{{$val -> mobile}}</td>
                        <td>{{$val -> email}}</td>
                        <td>{{$val -> created_at}}</td>
                        <td class="td-manage">
                            <a title="编辑" href="javascript:;" onclick="member_edit('编辑','member/{{$val -> id}}/edit',{{$val -> id}},'800','510')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                            <a title="删除" href="javascript:;" onclick="member_del(this,{{$val -> id}})" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
</div>
@endsection

