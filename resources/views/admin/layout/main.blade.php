<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>TianApp Admin</title>
        {{-- csrf --}}
        <meta name="csrf-token" content="{{csrf_token()}}">
        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- favicon 图标 -->
        <link rel="shortcut icon" href="/admin/images/favicon4.ico">

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="/admin/assets/css/bootstrap.min.css" />
        <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

        <!-- chart.css -->
        {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css">--}}
        <!-- page specific plugin styles -->
        {{--<link rel="stylesheet" href="/admin/assets/css/select2.min.css" />--}}
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <!-- text fonts -->
        <link rel="stylesheet" href="/admin/assets/css/fonts.googleapis.com.css" />

        <!-- ace styles -->
        <link rel="stylesheet" href="/admin/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

        <!--[if lte IE 9]>
            <link rel="stylesheet" href="/admin/assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
        <![endif]-->
        <link rel="stylesheet" href="/admin/assets/css/ace-skins.min.css" />
        <link rel="stylesheet" href="/admin/assets/css/ace-rtl.min.css" />

        <!-- iconfont styles -->
        <link rel="stylesheet" href="/admin/css/iconfont.css">
        <link rel="stylesheet" href="https://cdn.bootcss.com/ionicons/2.0.1/css/ionicons.min.css">
        {{-- 自定义css样式 --}}
        <link rel="stylesheet" href="/admin/css/index.css" />
        <!-- 引入webuploader的需要css文件 -->
        <link rel="stylesheet" type="text/css" href="/statics/webuploader-0.1.5/webuploader.css">
    </head>
        <!-- inline styles related to this page -->

        <!-- ace settings handler -->
        <script src="/admin/assets/js/ace-extra.min.js"></script>

  
    </head>

    <body class="no-skin">

         {{-- 头部导航内容 --}}
         @include("admin.layout.header")

        <div class="main-container ace-save-state" id="main-container">
            <script type="text/javascript">
                try{ace.settings.loadState('main-container')}catch(e){}
            </script>

            <!-- 侧边栏内容 -->
            @include("admin.layout.sizebar")

            <!-- 主体内容 -->
            <div class="main-content">
                <div class="main-content-inner">
                    {{-- 标题栏 --}}
                    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                        <ul class="breadcrumb">
                            @yield('title')
                        </ul><!-- /.breadcrumb -->

                        <div class="nav-search" id="nav-search">
                            <form class="form-search">
                                <span class="input-icon">
                                    <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off">
                                    <i class="ace-icon fa fa-search nav-search-icon"></i>
                                </span>
                            </form>
                        </div><!-- /.nav-search -->
                    </div>

                    <div class="page-content">
                        <div class="ace-settings-container" id="ace-settings-container">
                            <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                                <i class="ace-icon fa fa-cog bigger-130"></i>
                            </div>

                            <div class="ace-settings-box clearfix" id="ace-settings-box">
                                <div class="pull-left width-50">
                                    <div class="ace-settings-item">
                                        <div class="pull-left">
                                            <select id="skin-colorpicker" class="hide">
                                                <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                                                <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                                                <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                                                <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                                            </select>
                                        </div>
                                        <span>&nbsp; Choose Skin</span>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-sidebar" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-breadcrumbs" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-add-container" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-add-container">
                                            Inside
                                            <b>.container</b>
                                        </label>
                                    </div>
                                </div><!-- /.pull-left -->

                                <div class="pull-left width-50">
                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
                                    </div>
                                </div><!-- /.pull-left -->
                            </div><!-- /.ace-settings-box -->
                        </div><!-- /.ace-settings-container -->


                         <!-- 可变内容区域 -->
                         @yield('content')
                         {{-- yield进行占位 --}}

                    </div><!-- /.page-content -->
                </div>
            </div><!-- /.main-content -->

           {{-- 尾部内容 --}}
             @include("admin.layout.footer")



            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
             <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
        </div>

        <!-- /.main-container -->

        <!-- basic scripts -->

        <!--[if !IE]> -->
        <script src="/admin/assets/js/jquery-2.1.4.min.js"></script>
         
        <!-- <![endif]-->

        <!--[if IE]>
<script src="/admin/assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
        <script type="text/javascript">
            if('ontouchstart' in document.documentElement) document.write("<script src='/admin/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>
        <script src="/admin/assets/js/bootstrap.min.js"></script>

      



        <!-- page specific plugin scripts -->
        <script src="/admin/assets/js/jquery.dataTables.min.js"></script>
        <script src="/admin/assets/js/jquery.dataTables.bootstrap.min.js"></script>
        <script src="/admin/assets/js/dataTables.buttons.min.js"></script>
        <script src="/admin/assets/js/buttons.flash.min.js"></script>
        <script src="/admin/assets/js/buttons.html5.min.js"></script>
         {{-- 引入select2的js--}}
         <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
         {{--<script src="/admin/assets/js/select2.min.js"></script>--}}
        {{-- <script src="/admin/assets/js/buttons.print.min.js"></script> --}}
        <script src="/admin/assets/js/buttons.colVis.min.js"></script>
        <script src="/admin/assets/js/dataTables.select.min.js"></script>
        <script src="/admin/lib/layer/2.4/layer.js"></script>
        <script src="/admin/js/util.js"></script>

        <!--[if lte IE 8]>
          <script src="/admin/assets/js/excanvas.min.js"></script>
        <![endif]-->
        <script src="/admin/assets/js/jquery-ui.custom.min.js"></script>
        <script src="/admin/assets/js/jquery.ui.touch-punch.min.js"></script>
        <script src="/admin/assets/js/jquery.easypiechart.min.js"></script>
        <script src="/admin/assets/js/jquery.sparkline.index.min.js"></script>
        <script src="/admin/assets/js/jquery.flot.min.js"></script>
        <script src="/admin/assets/js/jquery.flot.pie.min.js"></script>
        <script src="/admin/assets/js/jquery.flot.resize.min.js"></script>

        <!-- ace scripts -->
        <script src="/admin/assets/js/ace-elements.min.js"></script>
        <script src="/admin/assets/js/ace.min.js"></script>
        <!-- inline scripts related to this page -->
        <script type="text/javascript">
            jQuery(function($) {
                $('.easy-pie-chart.percentage').each(function(){
                    var $box = $(this).closest('.infobox');
                    var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
                    var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
                    var size = parseInt($(this).data('size')) || 50;
                    $(this).easyPieChart({
                        barColor: barColor,
                        trackColor: trackColor,
                        scaleColor: false,
                        lineCap: 'butt',
                        lineWidth: parseInt(size/10),
                        animate: ace.vars['old_ie'] ? false : 1000,
                        size: size
                    });
                })

                $('.sparkline').each(function(){
                    var $box = $(this).closest('.infobox');
                    var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
                    $(this).sparkline('html',
                                     {
                                        tagValuesAttribute:'data-values',
                                        type: 'bar',
                                        barColor: barColor ,
                                        chartRangeMin:$(this).data('min') || 0
                                     });
                });



              $.resize.throttleWindow = false;
              var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
              var data = [
                { label: "social networks",  data: 38.7, color: "#68BC31"},
                { label: "search engines",  data: 24.5, color: "#2091CF"},
                { label: "ad campaigns",  data: 8.2, color: "#AF4E96"},
                { label: "direct traffic",  data: 18.6, color: "#DA5430"},
                { label: "other",  data: 10, color: "#FEE074"}
              ]
              function drawPieChart(placeholder, data, position) {
                  $.plot(placeholder, data, {
                    series: {
                        pie: {
                            show: true,
                            tilt:0.8,
                            highlight: {
                                opacity: 0.25
                            },
                            stroke: {
                                color: '#fff',
                                width: 2
                            },
                            startAngle: 2
                        }
                    },
                    legend: {
                        show: true,
                        position: position || "ne",
                        labelBoxBorderColor: null,
                        margin:[-30,15]
                    }
                    ,
                    grid: {
                        hoverable: true,
                        clickable: true
                    }
                 })
             }
             drawPieChart(placeholder, data);

             /**
             we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
             so that's not needed actually.
             */
             placeholder.data('chart', data);
             placeholder.data('draw', drawPieChart);


              //pie chart tooltip example
              var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
              var previousPoint = null;

              placeholder.on('plothover', function (event, pos, item) {
                if(item) {
                    if (previousPoint != item.seriesIndex) {
                        previousPoint = item.seriesIndex;
                        var tip = item.series['label'] + " : " + item.series['percent']+'%';
                        $tooltip.show().children(0).text(tip);
                    }
                    $tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
                } else {
                    $tooltip.hide();
                    previousPoint = null;
                }

             });

                /////////////////////////////////////
                $(document).one('ajaxloadstart.page', function(e) {
                    $tooltip.remove();
                });




                var d1 = [];
                for (var i = 0; i < Math.PI * 2; i += 0.5) {
                    d1.push([i, Math.sin(i)]);
                }

                var d2 = [];
                for (var i = 0; i < Math.PI * 2; i += 0.5) {
                    d2.push([i, Math.cos(i)]);
                }

                var d3 = [];
                for (var i = 0; i < Math.PI * 2; i += 0.2) {
                    d3.push([i, Math.tan(i)]);
                }


                var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
                $.plot("#sales-charts", [
                    { label: "Domains", data: d1 },
                    { label: "Hosting", data: d2 },
                    { label: "Services", data: d3 }
                ], {
                    hoverable: true,
                    shadowSize: 0,
                    series: {
                        lines: { show: true },
                        points: { show: true }
                    },
                    xaxis: {
                        tickLength: 0
                    },
                    yaxis: {
                        ticks: 10,
                        min: -2,
                        max: 2,
                        tickDecimals: 3
                    },
                    grid: {
                        backgroundColor: { colors: [ "#fff", "#fff" ] },
                        borderWidth: 1,
                        borderColor:'#555'
                    }
                });


                $('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
                function tooltip_placement(context, source) {
                    var $source = $(source);
                    var $parent = $source.closest('.tab-content')
                    var off1 = $parent.offset();
                    var w1 = $parent.width();

                    var off2 = $source.offset();
                    //var w2 = $source.width();

                    if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
                    return 'left';
                }


                $('.dialogs,.comments').ace_scroll({
                    size: 300
                });


                //Android's default browser somehow is confused when tapping on label which will lead to dragging the task
                //so disable dragging when clicking on label
                var agent = navigator.userAgent.toLowerCase();
                if(ace.vars['touch'] && ace.vars['android']) {
                  $('#tasks').on('touchstart', function(e){
                    var li = $(e.target).closest('#tasks li');
                    if(li.length == 0)return;
                    var label = li.find('label.inline').get(0);
                    if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
                  });
                }

                $('#tasks').sortable({
                    opacity:0.8,
                    revert:true,
                    forceHelperSize:true,
                    placeholder: 'draggable-placeholder',
                    forcePlaceholderSize:true,
                    tolerance:'pointer',
                    stop: function( event, ui ) {
                        //just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
                        $(ui.item).css('z-index', 'auto');
                    }
                    }
                );
                $('#tasks').disableSelection();
                $('#tasks input:checkbox').removeAttr('checked').on('click', function(){
                    if(this.checked) $(this).closest('li').addClass('selected');
                    else $(this).closest('li').removeClass('selected');
                });


                //show the dropdowns on top or bottom depending on window height and menu position
                $('#task-tab .dropdown-hover').on('mouseenter', function(e) {
                    var offset = $(this).offset();
                    var $w = $(window)
                    if (offset.top > $w.scrollTop() + $w.innerHeight() - 100)
                        $(this).addClass('dropup');
                    else $(this).removeClass('dropup');
                });

            });
        </script>

        <!-- 引入layui js脚本-->
        <script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script>
        <script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script>
       
         


        {{-- 管理员模块 --}}
        <script>
            //实例化datatables插件
            $('#table').dataTable({
                //禁用掉第一列的排序
                "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0 ] }],
                //默认在初始化的时候按照哪一列进行排序
                "aaSorting": [[ 1, "asc" ]],
            });


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

            /*管理员-添加*/
            function admin_add(title, url, w, h) {
                layer_show(title, url, w, h);
            }

            /*管理员-删除*/
            function admin_del(obj, id) {
                layer.confirm('确认要删除吗？', function(index) {
                    $.ajax({
                        type: 'GET',
                        url: '/admin/manager/delete?id=' + id,
                        // dataType: 'json',
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

            /*管理员-编辑*/
            function admin_edit(title, url, id, w, h) {
                layer_show(title, url, w, h);
            }
            /*管理员-停用*/
            function admin_stop(obj, id) {
                layer.confirm('确认要停用吗？', function(index) {
                //此处请求后台程序，下方是成功后的前台处理……
                    $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_start(this,id)" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已禁用</span>');
                    $(obj).remove();
                    layer.msg('已停用!', { icon: 5, time: 1000 });
                });
            }

            /*管理员-启用*/
            function admin_start(obj, id) {
                layer.confirm('确认要启用吗？', function(index) {
                //此处请求后台程序，下方是成功后的前台处理……
                $(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,id)" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
                $(obj).remove();
                layer.msg('已启用!', { icon: 6, time: 1000 });
                });
            }
        </script>

        {{-- 角色模块 --}}
        <script type="text/javascript">
            /*管理员-角色-添加*/
            function admin_role_add(title, url, w, h) {
                layer_show(title, url, w, h);
            }
            /*管理员-角色-分派权限*/
            function admin_role_assign(title, url, id, w, h) {
                layer_show(title, url + '?id=' + id, w, h);
            }
            /*管理员-角色-编辑*/
            function admin_role_edit(title, url, id, w, h) {
                layer_show(title, url, w, h);
            }
            /*管理员-角色-删除*/
            function admin_role_del(obj, id) {
                layer.confirm('角色删除须谨慎，确认要删除吗', function(index) {
                    $.ajax({
                        type: 'GET',
                        url: '/admin/role/delete?id=' + id,
                        // dataType: 'json',
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
    
        <!-- 权限模块-->
        <script type="text/javascript">
            /*管理员-权限-添加*/
            function admin_permission_add(title,url,w,h){
                layer_show(title,url,w,h);
            }
            /*管理员-权限-编辑*/
            function admin_permission_edit(title,url,id,w,h){
                layer_show(title,url,w,h);
            }
            /*管理员-角色-分派权限*/
            function admin_role_assign(title, url, id, w, h) {
                layer_show(title, url + '?id=' + id, w, h);
            }
            /*管理员-权限-删除*/
            function admin_permission_del(obj,id){
                layer.confirm('确认要删除吗？',function(index){
                    $.ajax({
                        type: 'GET',
                        url: '/admin/auth/delete?id=' + id,
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

       <!-- 会员模块 -->
        <script>
            /*用户-添加*/
            function member_add(title, url, w, h) {
                layer_show(title, url, w, h);
            }
            /*用户-查看*/
            function member_show(title, url, id, w, h) {
                layer_show(title, url, w, h);
            }
            /*用户-停用*/
            function member_stop(obj, id) {
                layer.confirm('确认要停用吗？', function(index) {
                    $.ajax({
                        type: 'POST',
                        url: '',
                        dataType: 'json',
                        success: function(data) {
                            $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
                            $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
                            $(obj).remove();
                            layer.msg('已停用!', { icon: 5, time: 1000 });
                        },
                        error: function(data) {
                            console.log(data.msg);
                        },
                    });
                });
            }


            /*用户-编辑*/
            function member_edit(title, url, id, w, h) {
                layer_show(title, url, w, h);
            }
            /*密码-修改*/
            function change_password(title, url, id, w, h) {
                layer_show(title, url, w, h);
            }
            /*用户-删除*/
            function member_del(obj, id) {
                layer.confirm('确认要删除吗？', function(index) {
                    $.ajax({
                        type: 'POST',
                        url: '/admin/member/' + id,
                        method:'DELETE',
                        dataType: 'json',
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


</body>
</html>
