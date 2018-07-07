<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:83:"D:\phpStudy\WWW\FastAdmin\public/../application/admin\view\companymanager\info.html";i:1530855648;s:68:"D:\phpStudy\WWW\FastAdmin\application\admin\view\layout\default.html";i:1523974191;s:65:"D:\phpStudy\WWW\FastAdmin\application\admin\view\common\meta.html";i:1529971551;s:67:"D:\phpStudy\WWW\FastAdmin\application\admin\view\common\script.html";i:1523974191;}*/ ?>
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
                                
<style>
    .box_p{
        float: right;
        margin-left: 15px;
    }
</style>
    <div class="col-xs-9" id="ws-body" style="font-size: larger;width: 100%">
        <div class="box box-success">
            <div class="box-header" style="text-align: center">
                <h3 class="box-title" style="float: left"><b><?php echo $info['company_name']; ?></b> 信息资料 </h3>
                <!--<p class="box_p"><a class="btn btn-xs btn-danger btn-dialog" title="<?php echo $info['company_name']; ?>企业年报" href="<?php echo url('Wszxdata/annualreport',array('name'=>$info['company_name'])); ?>">企业年报</a></p>
                <p class="box_p"><a class="btn btn-xs btn-default btn-dialog" title="<?php echo $info['company_name']; ?>股权结构" href="<?php echo url('Wszxdata/gqjg',array('name'=>$info['company_name'])); ?>">股权结构</a></p>
                <p class="box_p"><a class="btn btn-xs btn-primary btn-dialog" title="<?php echo $info['company_name']; ?>变更记录" href="<?php echo url('Wszxdata/change',array('name'=>$info['company_name'])); ?>">变更记录</a></p>
                <p class="box_p"><a class="btn btn-xs btn-success btn-dialog" title="<?php echo $info['company_name']; ?>投资关系" href="<?php echo url('Wszxdata/invest',array('name'=>$info['company_name'])); ?>">投资关系</a></p>
                <p class="box_p"><a class="btn btn-xs btn-info btn-dialog" title="<?php echo $info['company_name']; ?>关系族谱" href="<?php echo url('Wszxdata/family',array('name'=>$info['company_name'])); ?>">关系族谱</a></p>
                <p class="box_p"><a class="btn btn-xs btn-warning btn-dialog" title="<?php echo $info['company_name']; ?>企业链图" href="<?php echo url('Wszxdata/nexus',array('name'=>$info['company_name'])); ?>">企业链图</a></p>-->

                <?php if(is_array($btn) || $btn instanceof \think\Collection || $btn instanceof \think\Paginator): if( count($btn)==0 ) : echo "" ;else: foreach($btn as $key=>$vo): ?>
                <p class="box_p"><a class="<?php echo $vo['class']; ?>" title="<?php echo $info['company_name']; ?><?php echo $vo['title']; ?>" href="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?><?php echo $vo['tip']; ?></a></p>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>

            <div class="box-body table-responsive">
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>企业名称</b> <a class="pull-right"><?php echo $info['company_name']; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>社会统一信用代码</b> <a class="pull-right"><?php echo $info['code']; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>登记类别</b> <a class="pull-right"><?php echo $info['dj_type']; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>企业类型</b> <a class="pull-right"><?php echo $info['company_type']; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>注册号</b> <a class="pull-right"><?php echo $info['register_num']; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>成立日期</b> <a class="pull-right"><?php echo $info['found_time']; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>法人姓名</b> <a class="pull-right"><?php echo $info['f_name']; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>法人身份证号</b> <a class="pull-right"><?php echo $info['f_idcards']; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>联络员姓名</b> <a class="pull-right"><?php echo $info['lly_name']; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>联络员联系方式</b> <a class="pull-right"><?php echo $info['lly_phone']; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>注册资本（万元）</b> <a class="pull-right"><?php echo $info['zc_money']; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>实收资本（万元）</b> <a class="pull-right"><?php echo $info['ss_money']; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>企业联系电话</b> <a class="pull-right"><?php echo $info['company_phone']; ?></a>
                    </li>
                    <li class="list-group-item" style="display:inline-block">
                        <b>经营范围</b> <a class="pull-right" style=""><?php echo $info['operation']; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>经营期限</b> <a class="pull-right"><?php echo $info['jy_time']; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>登记机关</b> <a class="pull-right"><?php echo $info['dj_jigou']; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>邮政编号</b> <a class="pull-right"><?php echo $info['postalcode']; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>住所</b> <a class="pull-right"><?php echo $info['address']; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>监管部门</b> <a class="pull-right"><?php echo $info['jg_jigou']; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>状态</b> <a class="pull-right"><?php echo $info['status']; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>核准日期</b> <a class="pull-right"><?php echo $info['hz_time']; ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>