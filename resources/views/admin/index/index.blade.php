{{-- Blade的两个优点。一个就是extends继承,另一个就是区块(yield) --}}
{{-- 集成main模板 --}}
@extends("admin.layout.main")
{{-- 编辑标题栏 --}}
@section('title')
    <li>
        <i class="ace-icon fa fa-home home-icon"></i>
        <a href="/admin/index/index">首页</a>
    </li>
    <li class="active">主页</li>
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
                     欢迎回来鸭！
                    <strong class="green">
                        {{Auth::guard('admin')->user()->username}}
                    </strong>
                    管理员
                </div>
            </div><!-- /.col -->
        </div>
    {{-- 标签--}}
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">PHP 版本</span>
                    <span class="info-box-number">{{$version}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="icon ion-ios-videocam-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">课程数</span>
                    <span class="info-box-number">{{$lessons}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">会员数</span>
                    <span class="info-box-number">{{$members}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="icon ion-chatbox-working"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">评论数</span>
                    <span class="info-box-number">{{$comments}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    {{-- chart.js --}}

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <!-- AREA CHART -->
                <div class="box" >
                    <div class="box-header with-border">
                        <h3 class="box-title">各语言课程数量占比图</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn1 btn1-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn1 btn1-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="my_chart"></canvas>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col (LEFT) -->
            <div class="col-md-6">
                <!-- LINE CHART -->
                <div class="box" style=" border-top: 3px solid #dd4b39 !important;">
                    <div class="box-header with-border">
                        <h3 class="box-title">近七天的会员注册人数</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn1 btn1-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn1 btn1-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="lineChart"></canvas>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
    {{-- js --}}
    <script src="/admin/assets/js/jquery-2.1.4.min.js"></script>
    <script src="/admin/js/adminlte.min.js"></script>
    <script src="/admin/js/Chart.bundle.min.js"></script>
    <script>
        window.chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(201, 203, 207)'
        };
        $(function(){
            // 第一个图
            $.get('/admin/getChartData',function (data, status) {
                var ctx = document.getElementById("my_chart").getContext("2d");
                var my_chart = new Chart(ctx,{
                    type: 'doughnut',
                    data: {
                        labels: [
                            "PHP",
                            "HTML",
                            "CSS",
                            "Mysql",
                            "Linux",
                        ],
                        datasets: [{
                            data: data,
                            backgroundColor: [
                                window.chartColors.red,
                                window.chartColors.orange,
                                window.chartColors.purple,
                                window.chartColors.green,
                                window.chartColors.blue,
                            ],
                        }]
                    },
                    options: {
                        responsive: true,
                    }
                });
            });

            // 第二个图
            $.get('/admin/getLineChartData',function (data, status) {
                var  value = [];
                for (let i in data.data) {
                    value.push(data.data[i]);
                }

                var  label = [];
                for (let i in data.label) {
                    label.push(data.label[i]); //属性
                }

                var  lineChartCanvas = document.getElementById("lineChart").getContext("2d");
                var line_chart = new Chart(lineChartCanvas,{
                    type: 'line',
                    data: {
                        labels: label,
                        datasets: [
                            {
                                label  : "当天会员注册人数",
                                backgroundColor: [
                                    window.chartColors.red,
                                ],
                                borderColor: "rgb(255, 99, 132)", //路径颜色
                                pointBackgroundColor: "rgb(255, 99, 132)", //数据点颜色
                                pointBorderColor: "rgb(255, 99, 132)", //数据点边框颜色
                                data: value,
                                fill:false
                           }
                        ]
                    },
                    options: {
                        // //Boolean - If we should show the scale at all
                        // showScale               : true,
                        // //Boolean - Whether grid lines are shown across the chart
                        // scaleShowGridLines      : false,
                        // //String - Colour of the grid lines
                        // scaleGridLineColor      : 'rgba(0,0,0,.05)',
                        // //Number - Width of the grid lines
                        // scaleGridLineWidth      : 1,
                        // //Boolean - Whether to show horizontal lines (except X axis)
                        // scaleShowHorizontalLines: true,
                        // //Boolean - Whether to show vertical lines (except Y axis)
                        // scaleShowVerticalLines  : true,
                        // //Boolean - Whether the line is curved between points
                        // bezierCurve             : true,
                        // //Number - Tension of the bezier curve between points
                        // bezierCurveTension      : 0.3,
                        // //Boolean - Whether to show a dot for each point
                        // pointDot                : false,
                        // //Number - Radius of each point dot in pixels
                        // pointDotRadius          : 4,
                        // //Number - Pixel width of point dot stroke
                        // pointDotStrokeWidth     : 1,
                        // //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                        // pointHitDetectionRadius : 20,
                        // //Boolean - Whether to show a stroke for datasets
                        // datasetStroke           : true,
                        // //Number - Pixel width of dataset stroke
                        // datasetStrokeWidth      : 2,
                        // //Boolean - Whether to fill the dataset with a color
                        datasetFill             : false,
                        // //String - A legend template
                        // maintainAspectRatio     : true,
                        // //Boolean - whether to make the chart responsive to window resizing
                        responsive : true
                    }
                });

            });
        });
    </script>
@endsection

