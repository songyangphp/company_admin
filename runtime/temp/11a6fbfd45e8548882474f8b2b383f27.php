<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:74:"D:\phpStudy\WWW\FastAdmin\public/../application/admin\view\task\index.html";i:1530926740;s:68:"D:\phpStudy\WWW\FastAdmin\application\admin\view\layout\default.html";i:1523974191;s:65:"D:\phpStudy\WWW\FastAdmin\application\admin\view\common\meta.html";i:1529971551;s:67:"D:\phpStudy\WWW\FastAdmin\application\admin\view\common\script.html";i:1523974191;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<!--<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>-->
<title>企业监管平台</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config:  <?php echo json_encode($config); ?>
    };
</script>
    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG): ?>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <?php foreach($breadcrumb as $vo): ?>
                                    <li><a href="javascript:;" data-url="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
        }
        .main{
            width: 95%;
            height: 100%;
            margin: 0 auto;
        }
        .quarter-div{
            width: 50%;
            height: 40%;
            float: left;
        }
        .blue{
            /*height: 50%;*/
            /*background-color: #5BC0DE;*/
        }
        .green{
            /*height: 50%;*/
            /*background-color: #5CB85C;*/
        }
        .orange{
            /*height: 50%;*/
            /*background-color: #F0AD4E;*/
        }
        .yellow{
            /*height: 50%;*/
            /*background-color: #FFC706;*/
        }
        .row{
            width: 95%;
            margin: 0 auto;
        }
    </style>

    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div class="row">
    <div class="col-lg-12">
    </div>
    <div class="col-xs-6 col-md-3">
        <div class="panel bg-blue">
            <div class="panel-body">
                <div class="panel-title">
                    <span class="label label-success pull-right">实时</span>
                    <h5>今日任务</h5>
                </div>
                <div class="panel-content">
                    <h1 class="no-margins">21</h1>
                    <div class="stat-percent font-bold text-gray"><i class="fa fa-commenting"></i> 889</div>
                    <small>总任务</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-6 col-md-3">
        <div class="panel bg-red">
            <div class="panel-body">
                <div class="ibox-title">
                    <span class="label label-info pull-right">实时</span>
                    <h5>正在办理</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">2</h1>
                    <div class="stat-percent font-bold text-gray"><i class="fa fa-modx"></i> 19</div>
                    <small>累计办理</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-6 col-md-3">
        <div class="panel bg-aqua-gradient">
            <div class="panel-body">
                <div class="ibox-title">
                    <span class="label label-info pull-right">实时</span>
                    <h5>我的发布</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">18</h1>
                    <div class="stat-percent font-bold text-gray"><i class="fa fa-modx"></i> 5</div>
                    <small>逾期未办</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-6 col-md-3">
        <div class="panel bg-yellow">
            <div class="panel-body">
                <div class="panel-title">
                    <span class="label label-success pull-right">实时</span>
                    <h5>紧急任务</h5>
                </div>
                <div class="panel-content">
                    <h1 class="no-margins">8</h1>
                    <div class="stat-percent font-bold text-gray"><i class="fa fa-commenting"></i> 150</div>
                    <small>累计</small>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main">
    <div class="quarter-div blue">
        <canvas id="myChart1"></canvas>
    </div>
    <div class="quarter-div green">
        <canvas id="myChart2"></canvas>
    </div>
    <div class="quarter-div orange">
        <canvas id="myChart3"></canvas>
    </div>
    <div class="quarter-div yellow">
        <canvas id="myChart4"></canvas>
    </div>
</div>

</body>
<script>
    var ctx = document.getElementById("myChart1").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
            datasets: [{
                label: '任务增长分析',
                data: [90, 200, 40, 80, 102, 72 , 155 , 10 , 10 , 70 , 260 , 120],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)'

                ],
                borderColor: [
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });

    var ctx2 = document.getElementById("myChart2").getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
            datasets: [
                {
                    label: "新增任务",
                    backgroundColor:"rgba(255,0,0,0.5)",
                    fillColor: "rgba(255,0,0,0.5)",
                    strokeColor: "rgba(220,220,220,0.8)",
                    highlightFill: "rgba(220,220,220,0.75)",
                    highlightStroke: "rgba(220,220,220,1)",
                    data: [90, 57, 40, 80, 102, 72 , 155 , 25 , 10 , 70 , 75 , 102]
                },
                {
                    label: "办结任务",
                    backgroundColor:"rgba(19,29,255,0.5)",
                    fillColor: "rgba(19,29,255,0.5)",
                    strokeColor: "rgba(151,187,205,0.8)",
                    highlightFill: "rgba(151,187,205,0.75)",
                    highlightStroke: "rgba(151,187,205,1)",
                    data: [28, 48, 40, 19, 86, 27, 90, 52, 14, 40, 63, 89]
                }
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });

    var ctx3 = document.getElementById("myChart3").getContext('2d');
    var myChart3 = new Chart(ctx3, {
        type: 'line',
        data: {
            labels: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"],
            datasets: [{
                label: '任务所涉猎到的公司变化',
                data: [44, 57, 98, 25, 29, 58 , 29 , 65 , 47 , 12 , 54 , 89],
                backgroundColor: [
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });


    var ctx4 = document.getElementById("myChart4").getContext('2d');

    var myChart4 = new Chart(ctx4, {
        type: 'pie',
        data: {
            labels: ["科技类", "网络类", "广告类", "传媒类", "生产类"],
            datasets: [{
                label: '# of Votes',
                data: [44, 57, 98, 25, 29],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });

</script>
</html>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>