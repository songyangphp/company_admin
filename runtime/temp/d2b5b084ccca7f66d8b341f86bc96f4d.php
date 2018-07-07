<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:76:"D:\phpStudy\WWW\FastAdmin\public/../application/admin\view\company\edit.html";i:1529896712;s:68:"D:\phpStudy\WWW\FastAdmin\application\admin\view\layout\default.html";i:1523974191;s:65:"D:\phpStudy\WWW\FastAdmin\application\admin\view\common\meta.html";i:1523974191;s:67:"D:\phpStudy\WWW\FastAdmin\application\admin\view\common\script.html";i:1523974191;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
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
                                <form id="edit-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">

    <div class="form-group">
        <label for="c-company_name" class="control-label col-xs-12 col-sm-2">企业名称:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-company_name5b305725ecf688294" data-rule="required" class="form-control" name="row[company_name]" type="text" value="<?php echo $row['company_name']; ?>" disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label for="c-code" class="control-label col-xs-12 col-sm-2">统一社会信用代码:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-code5b305725ee6d86170" data-rule="required" class="form-control" name="row[code]" type="text" value="<?php echo $row['code']; ?>" disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label for="c-f_name" class="control-label col-xs-12 col-sm-2">法人姓名:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-code5b305725ee6d86170" data-rule="required" class="form-control" name="row[f_name]" type="text" value="<?php echo $row['f_name']; ?>" disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label for="c-b_id" class="control-label col-xs-12 col-sm-2">所属楼宇:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-b_id5b305725ee6d86885" data-rule="required" class="form-control" name="row[b_id]" type="text" value="<?php echo $row['b_id']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-floor" class="control-label col-xs-12 col-sm-2">所属楼层:</label>
        <div class="col-xs-12 col-sm-8">
            <?php  $floorlist=  json_decode('{"1":"1\u5c42","2":"2\u5c42"}',true);   ?>            
            <select  id="c-floor" data-rule="required" class="form-control selectpicker" name="row[floor]">
                <?php if(is_array($floorlist) || $floorlist instanceof \think\Collection || $floorlist instanceof \think\Paginator): if( count($floorlist)==0 ) : echo "" ;else: foreach($floorlist as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['floor'])?$row['floor']:explode(',',$row['floor']))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>
    <div class="form-group">
        <label for="c-level_id" class="control-label col-xs-12 col-sm-2">企业等级:</label>
        <div class="col-xs-12 col-sm-8">

            <select  id="c-level_id" data-rule="required" class="form-control selectpicker" name="row[level_id]">
                <?php if(is_array($level_list) || $level_list instanceof \think\Collection || $level_list instanceof \think\Paginator): if( count($level_list)==0 ) : echo "" ;else: foreach($level_list as $key=>$vo): ?>
                    <option value="<?php echo $vo['id']; ?>" <?php if(in_array(($vo['id']), is_array($row['level_id'])?$row['level_id']:explode(',',$row['level_id']))): ?>selected<?php endif; ?>><?php echo $vo['name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>
    <div class="form-group">
        <label for="c-bs_id" class="control-label col-xs-12 col-sm-2">类型标签:</label>
        <div class="col-xs-12 col-sm-8">
            <select  id="c-bs_id" data-rule="required" class="form-control selectpicker" name="row[bs_id]">
                <?php if(is_array($bs) || $bs instanceof \think\Collection || $bs instanceof \think\Paginator): if( count($bs)==0 ) : echo "" ;else: foreach($bs as $key=>$vo): ?>
                    <option value="<?php echo $vo['id']; ?>" <?php if(in_array(($vo['id']), is_array($row['bs_id'])?$row['bs_id']:explode(',',$row['bs_id']))): ?>selected<?php endif; ?>><?php echo $vo['name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>
</form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>