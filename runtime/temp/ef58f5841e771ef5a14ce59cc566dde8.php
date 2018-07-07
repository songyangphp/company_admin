<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:75:"D:\phpStudy\WWW\FastAdmin\public/../application/admin\view\company\add.html";i:1529888651;s:68:"D:\phpStudy\WWW\FastAdmin\application\admin\view\layout\default.html";i:1523974191;s:65:"D:\phpStudy\WWW\FastAdmin\application\admin\view\common\meta.html";i:1523974191;s:67:"D:\phpStudy\WWW\FastAdmin\application\admin\view\common\script.html";i:1523974191;}*/ ?>
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
                                <form id="add-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">

    <div class="form-group">
        <label for="c-company_name" class="control-label col-xs-12 col-sm-2"><?php echo __('Company_name'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-company_name" data-rule="required" class="form-control" name="row[company_name]" type="text">
        </div>
    </div>
    <div class="form-group">
        <label for="c-code" class="control-label col-xs-12 col-sm-2"><?php echo __('Code'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-code" data-rule="required" class="form-control" name="row[code]" type="text">
        </div>
    </div>
    <div class="form-group">
        <label for="c-f_name" class="control-label col-xs-12 col-sm-2"><?php echo __('F_name'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-f_name" data-rule="required" class="form-control" name="row[f_name]" type="text">
        </div>
    </div>
    <div class="form-group">
        <label for="c-addtime" class="control-label col-xs-12 col-sm-2"><?php echo __('Addtime'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-addtime" data-rule="required" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[addtime]" type="text" value="<?php echo date('Y-m-d H:i:s'); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-b_id" class="control-label col-xs-12 col-sm-2"><?php echo __('B_id'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-b_id" data-rule="required" data-source="b/index" class="form-control selectpage" name="row[b_id]" type="text" value="">
        </div>
    </div>
    <div class="form-group">
        <label for="c-floor" class="control-label col-xs-12 col-sm-2"><?php echo __('Floor'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
                        
            <select  id="c-floor" data-rule="required" class="form-control selectpicker" name="row[floor]">
                <?php if(is_array($floorList) || $floorList instanceof \think\Collection || $floorList instanceof \think\Paginator): if( count($floorList)==0 ) : echo "" ;else: foreach($floorList as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',""))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>
    <div class="form-group">
        <label for="c-level_id" class="control-label col-xs-12 col-sm-2"><?php echo __('Level_id'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-level_id" data-rule="required" data-source="level/index" class="form-control selectpage" name="row[level_id]" type="text" value="">
        </div>
    </div>
    <div class="form-group">
        <label for="c-bs_id" class="control-label col-xs-12 col-sm-2"><?php echo __('Bs_id'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-bs_id" data-rule="required" data-source="bs/index" class="form-control selectpage" name="row[bs_id]" type="text" value="">
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