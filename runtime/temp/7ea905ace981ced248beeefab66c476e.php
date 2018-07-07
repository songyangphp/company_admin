<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:75:"D:\phpStudy\WWW\FastAdmin\public/../application/admin\view\addon\index.html";i:1523974191;s:68:"D:\phpStudy\WWW\FastAdmin\application\admin\view\layout\default.html";i:1523974191;s:65:"D:\phpStudy\WWW\FastAdmin\application\admin\view\common\meta.html";i:1529971551;s:67:"D:\phpStudy\WWW\FastAdmin\application\admin\view\common\script.html";i:1523974191;}*/ ?>
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
                                <style type="text/css">
    .noimage {width:100%;text-align: center;background:#18bc9c;color:#fff;padding-bottom:66.66%;position:relative;}
    .noimage > div {position: absolute;top:48%;width:100%;text-align:center;}
    .addon {position: relative;border-color:#e4e4e4;}
    .addon > span {position:absolute;left:15px;top:15px;z-index:9;}
    .addon > span a{opacity: 0.5;border:none;color:#fff;}
    .layui-layer-pay .layui-layer-content {padding:0;height:600px!important;}
    .layui-layer-pay {border:none;}
    .payimg{position:relative;width:800px;height:600px;}
    .payimg .alipaycode {position:absolute;left:265px;top:442px;}
    .payimg .wechatcode {position:absolute;left:660px;top:442px;}
    .thumbnail img{width:100%;}
    .fixed-table-toolbar .pull-right.search {
        min-width: 300px;
    }
    .status-disabled .noimage {
        background:#d2d6de;
    }
    @media (min-width: 992px) {
        .addon {
            -webkit-transition:all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }
        .addon:hover {
            border-color: #dddddd;
            -webkit-box-shadow: 0 26px 40px -24px rgba(0,36,100,0.3);
            -moz-box-shadow: 0 26px 40px -24px rgba(0,36,100,0.3);
            box-shadow: 0 26px 40px -24px rgba(0,36,100,0.3);
            -webkit-transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }
    }
</style>
<div class="panel panel-default panel-intro">
    <div class="panel-heading">
        <?php echo build_heading(null,FALSE); ?>
        <ul class="nav nav-tabs nav-category">
            <li class="active"><a href="javascript:;" data-id=""><?php echo __('All'); ?></a></li>
            <li><a href="javascript:;" data-id="0"><?php echo __('Uncategoried'); ?></a></li>
        </ul>

    </div>

    <div class="panel-body">
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="one">
                <div class="widget-body no-padding">
                    <div id="toolbar" class="toolbar">
                        <?php echo build_toolbar('refresh'); ?>
                        <button type="button" id="plupload-addon" class="btn btn-danger plupload" data-url="addon/local" data-mimetype="application/zip" data-multiple="false"><i class="fa fa-upload"></i> <?php echo __('Offline install'); ?></button>
                        <div class="btn-group">
                            <a href="#" class="btn btn-info btn-switch active" data-type="all" data-url="<?php echo $config['fastadmin']['api_url']; ?>/addon/index"><i class="fa fa-list"></i> <?php echo __('全部'); ?></a>
                            <a href="#" class="btn btn-info btn-switch" data-type="free" data-url="<?php echo $config['fastadmin']['api_url']; ?>/addon/index"><i class="fa fa-gift"></i> <?php echo __('免费'); ?></a>
                            <a href="#" class="btn btn-info btn-switch" data-type="price" data-url="<?php echo $config['fastadmin']['api_url']; ?>/addon/index"><i class="fa fa-rmb"></i> <?php echo __('付费'); ?></a>
                            <a href="#" class="btn btn-info btn-switch" data-type="local" data-url="addon/downloaded"><i class="fa fa-laptop"></i> <?php echo __('Local addon'); ?></a>
                        </div>
                        <a class="btn btn-primary btn-userinfo" href="javascript:;"><i class="fa fa-user"></i> <?php echo __('Userinfo'); ?></a>
                    </div>
                    <table id="table" class="table table-striped table-hover" width="100%">

                    </table>

                </div>
            </div>

        </div>
    </div>
</div>
<script id="searchformtpl" type="text/html">
    <form action="" class="form-commonsearch hide">
        <div class="well" style="box-shadow:none;border-radius:2px;margin-bottom:10px;">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="control-label">标题</label>
                        <input class="operate" type="hidden" data-name="title" value="like"/>
                        <input class="form-control" type="text" name="title" placeholder="请输入查找的标题" value=""/>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="control-label">类型</label>
                        <input class="operate" type="hidden" data-name="type" value="="/>
                        <input class="form-control" type="text" name="type" placeholder="all" value=""/>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="control-label">分类</label>
                        <input type="hidden" class="operate" data-name="category_id" value="="/>
                        <input class="form-control" name="category_id" type="text" value="">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="control-label">版本号</label>
                        <input type="hidden" class="operate" data-name="faversion" value="="/>
                        <input class="form-control" name="faversion" type="text" value="<?php echo $config['fastadmin']['version']; ?>">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="form-group">
                        <label class="control-label"></label>
                        <div class="row">
                            <div class="col-xs-6">
                                <input type="submit" class="btn btn-success btn-block" value="提交"/>
                            </div>
                            <div class="col-xs-6">
                                <input type="reset" class="btn btn-primary btn-block" value="重置"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</script>
<script id="logintpl" type="text/html">
    <div>
        <form class="form-horizontal">
            <fieldset>
                <div class="alert alert-dismissable alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong><?php echo __('Warning'); ?></strong><br /><?php echo __('Login tips'); ?>
                </div>
                <div class="form-group">
                    <label for="inputAccount" class="col-lg-3 control-label"><?php echo __('Username'); ?></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" id="inputAccount" value="" placeholder="<?php echo __('Your username or email'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-lg-3 control-label"><?php echo __('Password'); ?></label>
                    <div class="col-lg-9">
                        <input type="password" class="form-control" id="inputPassword" value="" placeholder="<?php echo __('Your password'); ?>">
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</script>
<script id="userinfotpl" type="text/html">
    <div>
        <form class="form-horizontal">
            <fieldset>
                <div class="alert alert-dismissable alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong><?php echo __('Warning'); ?></strong><br /><?php echo __('Logined tips', '<%=username%>'); ?>
                </div>
            </fieldset>
        </form>
    </div>
</script>
<script id="addoninfotpl" type="text/html">
    <div style="font-size:13px;">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th colspan="2"><h4><%=item.title%></h4></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row"><?php echo __('Price'); ?></th>
                    <td><div class="text-<%=item.price>0?'danger':'success'%>"><b>￥<%=item.price%></b></div></td>
                </tr>
                <tr>
                    <th scope="row"><?php echo __('Author'); ?></th>
                    <td><a href="<%=item.url?item.url:'javascript:;'%>" target="_blank"><%=item.author%></a></td>
                </tr>
                <tr>
                    <th scope="row"><?php echo __('Identify'); ?></th>
                    <td><%=item.name%></td>
                </tr>
                <tr>
                    <th scope="row"><?php echo __('Homepage'); ?></th>
                    <td><a href="https://www.fastadmin.net/store/<%=item.name%>.html" target="_blank">https://www.fastadmin.net/store/<%=item.name%>.html</a></td>
                </tr>
                <tr>
                    <th scope="row"><?php echo __('Intro'); ?></th>
                    <td><%=item.intro%></td>
                </tr>
                <tr>
                    <th scope="row"><?php echo __('Version'); ?></th>
                    <td><%=# addon && item && addon.version!=item.version?'<span class="label label-danger">'+addon.version+'</span> -> <span class="label label-success">'+item.version+'</span>':item.version%></td>
                </tr>
                <tr>
                    <th scope="row"><?php echo __('Createtime'); ?></th>
                    <td><%=Moment(item.createtime*1000).format("YYYY-MM-DD HH:mm:ss")%></td>
                </tr>
                <tr>
                    <th scope="row"><?php echo __('Releasetime'); ?></th>
                    <td><%=Moment(item.releasetime*1000).format("YYYY-MM-DD HH:mm:ss")%></td>
                </tr>
            </tbody>
        </table>
    </div>
</script>
<script id="paytpl" type="text/html">
    <div class="payimg" style="background:url('<%=payimg%>') 0 0 no-repeat;background-size:cover;">
        <%if(paycode){%>
        <div class="alipaycode">
            <%=paycode%>
        </div>
        <div class="wechatcode">
            <%=paycode%>
        </div>
        <%}%>
    </div>
</script>
<script id="conflicttpl" type="text/html">
    <div class="alert alert-dismissable alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong><?php echo __('Warning'); ?></strong> <?php echo __('Conflict tips'); ?>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th><?php echo __('File'); ?></th>
            </tr>
        </thead>
        <tbody>
            <%for(var i=0;i < conflictlist.length;i++){%>
            <tr>
                <th scope="row"><%=i+1%></th>
                <td><%=conflictlist[i]%></td>
            </tr>
            <%}%>
        </tbody>
    </table>
</script>
<script id="itemtpl" type="text/html">
    <% var labelarr = ['primary', 'success', 'info', 'danger', 'warning']; %>
    <% var label = labelarr[item.id % 5]; %>
    <% var addon = typeof addons[item.name]!= 'undefined' ? addons[item.name] : null; %>
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 mt-4 status-<%=addon ? (addon.state==1?'enabled':'disabled') : 'uninstalled'%>">
        <div class="thumbnail addon">
            <%if(addon){%>
            <span>
                <a href="<%=addon.url%>" target="_blank" class="btn btn-xs">
                    <i class="fa fa-home"></i>
                </a>
            </span>
            <%}%>
            <a href="<%=item.url%>" class="btn-addonindex" target="_blank">
                <%if(item.image){%>
                <img src="<%=item.image%>" class="img-responsive" alt="<%=item.title%>">
                <%}else{%>
                <div class="noimage"><div><?php echo __('No image'); ?></div></div>
                <%}%>
            </a>
            <div class="caption">
                <h4><%=item.title?item.title:'<?php echo __('None'); ?>'%>
                    <% if(item.flag.indexOf("recommend")>-1){%>
                    <span class="label label-success"><?php echo __('Recommend'); ?></span>
                    <% } %>
                    <% if(item.flag.indexOf("hot")>-1){%>
                    <span class="label label-danger"><?php echo __('Hot'); ?></span>
                    <% } %>
                    <% if(item.flag.indexOf("free")>-1){%>
                    <span class="label label-info"><?php echo __('Free'); ?></span>
                    <% } %>
                    <% if(item.flag.indexOf("sale")>-1){%>
                    <span class="label label-warning"><?php echo __('Sale'); ?></span>
                    <% } %>
                </h4>
                <p class="text-<%=item.price>0?'danger':'success'%>"><b>￥<%=item.price%></b></p>
                <p class="text-muted"><?php echo __('Author'); ?>: <a href="<%=item.url?item.url:'javascript:;'%>" target="_blank"><%=item.author%></a></p>
                <p class="text-muted"><?php echo __('Intro'); ?>: <%=item.intro%></p>
                <p class="text-muted"><?php echo __('Version'); ?>: <%=# addon && item && addon.version!=item.version?'<span class="label label-danger">'+addon.version+'</span> -> <span class="label label-success">'+item.version+'</span>':item.version%></p>
                <p class="text-muted"><?php echo __('Createtime'); ?>: <%=Moment(item.createtime*1000).format("YYYY-MM-DD HH:mm:ss")%></p>
                <div class="operate" data-id="<%=item.id%>" data-name="<%=item.name%>">
                    <% if(!addon){ %>
                    <% if(typeof item.releaselist !="undefined" && item.releaselist.length>1){%>
                    <span class="btn-group">
                        <a href="javascript:;" class="btn btn-primary btn-success btn-install" data-type="<%=item.price<=0?'free':'price';%>" data-donateimage="<%=item.donateimage%>" data-version="<%=item.version%>"><i class="fa fa-cloud-download"></i> <?php echo __('Install'); ?></a>
                        <a class="btn btn-success dropdown-toggle" data-toggle="dropdown" href="javascript:;">
                            <span class="fa fa-caret-down"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <% for(var j=0;j< item.releaselist.length;j++){ %>
                            <li><a href="javascript:;" class="btn-install" data-type="<%=item.price<=0?'free':'price';%>" data-donateimage="<%=item.donateimage%>" data-version="<%=item.releaselist[j].version%>"><%=item.releaselist[j].version%></a></li>
                            <% } %>
                        </ul>
                    </span>
                    <% }else{%>
                    <a href="javascript:;" class="btn btn-primary btn-success btn-install" data-type="<%=item.price<=0?'free':'price';%>" data-donateimage="<%=item.donateimage%>" data-version="<%=item.version%>"><i class="fa fa-cloud-download"></i> <?php echo __('Install'); ?></a>
                    <% } %>
                    <% if(item.demourl){ %>
                    <a href="<%=item.demourl%>" class="btn btn-primary btn-info btn-demo" target="_blank"><i class="fa fa-flash"></i> <?php echo __('Demo'); ?></a>
                    <% } %>
                    <% } %>

                    <% if(addon){ %>
                    <% if(addon.config){ %>
                    <a href="javascript:;" class="btn btn-primary btn-config"><i class="fa fa-pencil"></i> <?php echo __('Setting'); ?></a>
                    <% } %>
                    <% if(addon.state == "1"){ %>
                    <a href="javascript:;" class="btn btn-warning btn-disable" data-action="disable"><i class="fa fa-times"></i> <?php echo __('Disable'); ?></a>
                    <% }else{ %>
                    <a href="javascript:;" class="btn btn-success btn-enable" data-action="enable"><i class="fa fa-check"></i> <?php echo __('Enable'); ?></a>
                    <a href="javascript:;" class="btn btn-danger btn-uninstall"><i class="fa fa-times"></i> <?php echo __('Uninstall'); ?></a>
                    <% } %>
                    <% } %>
                    <% if(addon && item && addon.version!=item.version){%>
                    <% if(typeof item.releaselist !="undefined" && item.releaselist.length>1){%>
                    <span class="btn-group">
                        <a href="javascript:;" class="btn btn-info btn-success btn-upgrade" data-version="<%=item.version%>"><i class="fa fa-cloud"></i> <?php echo __('Upgrade'); ?></a>
                        <a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="javascript:;">
                            <span class="fa fa-caret-down"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <% for(var j=0;j< item.releaselist.length;j++){ %>
                            <li><a href="javascript:;" class="btn-upgrade" data-version="<%=item.releaselist[j].version%>"><%=item.releaselist[j].version%></a></li>
                            <% } %>
                        </ul>
                    </span>
                    <% }else{%>
                    <a href="javascript:;" class="btn btn-info btn-upgrade" data-version="<%=item.version%>"><i class="fa fa-cloud"></i> <?php echo __('Upgrade'); ?></a>
                    <% }%>
                    <% }%>

                    <span class="pull-right" style="margin-top:10px;">
                        <a href="javascript:;" class="btn-addoninfo text-gray" data-index="<%=i%>" title="<%=item.title?item.title:'<?php echo __('None'); ?>'%>"><i class="fa fa-bars"></i></a>
                    </span>

                </div>
            </div>
        </div>
    </div>
</script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>