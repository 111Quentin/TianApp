{{-- Blade的两个优点。一个就是extends继承,另一个就是区块(yield) --}}
{{-- 集成main模板 --}}
@extends("admin.layout.main")
{{-- 编辑标题栏 --}}
@section('title')
    <li>
        <i class="ace-icon fa fa-home home-icon"></i>
        <a href="/admin/index/index">首页</a>
    </li>
    <li class="active">个人信息页</li>
@endsection

{{-- 编辑可变内容区域 --}}
@section('content')
    {{-- 欢迎框 --}}
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="alert alert-block alert-success">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                </button>
                <i class="ace-icon fa fa-check green"></i>
                管理员个人信息
            </div>
        </div><!-- /.col -->
    </div>


   <div class="row" align="center" style="margin-left: 200px;margin-top: 15px;">
       <!-- Main content -->
       <section class="content">
           <div class="row">
               <div class="col-md-9">
                   <!-- Profile Image -->
                   <div class="box box-primary">
                       <div class="box-body box-profile">
                           <img class="profile-user-img img-responsive img-circle" src="{{Auth::guard('admin')->user()->avatar}}" alt="User profile picture" width="128">

                           <h3 class="profile-username text-center">{{Auth::guard('admin')->user()->username}}</h3>

                           <p class="text-muted text-center">@if (Auth::guard('admin')->user()->gender == 1)  男@elseif(Auth::guard('admin')->user()->username == 2)  女  @else 未知 @endif</p>

                           <ul class="list-group list-group-unbordered">
                               <li class="list-group-item">
                                   <b>手机号</b> <a class="pull-right">{{Auth::guard('admin')->user()->mobile}}</a>
                               </li>
                               <li class="list-group-item">
                                   <b style="padding-left: 38px;">邮箱</b> <a class="pull-right">{{Auth::guard('admin')->user()->email}}</a>
                               </li>
                           </ul>

                           <a href="#" class="btn btn-primary btn-block" onclick="admin_edit('管理员编辑','/admin/manager/edit?id={{Auth::guard('admin')->user()->id}}',{{Auth::guard('admin')->user()->id}},'800','600')"><b>修改</b></a>
                       </div>
                       <!-- /.box-body -->
                   </div>
                   <!-- /.box -->
               </div>
           </div>
           <!-- /.row -->

       </section>
   </div>
    <!-- /.content -->
    {{-- js --}}
    <script src="/admin/assets/js/jquery-2.1.4.min.js"></script>
    <script src="/admin/js/adminlte.min.js"></script>

@endsection

