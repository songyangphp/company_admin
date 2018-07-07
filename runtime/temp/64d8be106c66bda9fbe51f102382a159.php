<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:86:"D:\phpStudy\WWW\FastAdmin\public/../application/admin\view\companymap\addbuilding.html";i:1530086466;s:68:"D:\phpStudy\WWW\FastAdmin\application\admin\view\layout\default.html";i:1523974191;s:65:"D:\phpStudy\WWW\FastAdmin\application\admin\view\common\meta.html";i:1529971551;s:67:"D:\phpStudy\WWW\FastAdmin\application\admin\view\common\script.html";i:1523974191;}*/ ?>
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
                                <head>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=<?php echo $key; ?>"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
</head>
<form id="edit-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">

    <div class="form-group">
        <label for="c-building_name" class="control-label col-xs-12 col-sm-2">楼宇名称:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="text_" data-rule="required" class="form-control" name="row[building_name]" type="text" value="<?php echo $row['building_name']; ?>" onblur="searchByStationName()">
        </div>
    </div>

    <!--<div class="form-group">
        <label for="c-building_name" class="control-label col-xs-12 col-sm-2"  >楼宇名称:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="result_" data-rule="required" class="form-control" name="row[building_name]" type="text" value="<?php echo $row['building_name']; ?>">
        </div>
    </div>-->
    <div class="form-group">
        <label for="c-floor" class="control-label col-xs-12 col-sm-2">楼层数:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-floor5b32efe9826b88247" data-rule="required" class="form-control" name="row[floor]" type="text" value="<?php echo $row['floor']; ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="c-province_id" class="control-label col-xs-12 col-sm-2">选择省:</label>
        <div class="col-xs-12 col-sm-8">
        <select name="row[province_id]" id="typeId" data-rules="required" class="form-control selectpicker">
            <option value="0">请选择</option>
            <?php if(is_array($newsType) || $newsType instanceof \think\Collection || $newsType instanceof \think\Paginator): if( count($newsType)==0 ) : echo "" ;else: foreach($newsType as $key=>$vo): ?>
                <option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
        </div>
    </div>


    <div class="form-group">
        <label for="c-city_id" class="control-label col-xs-12 col-sm-2">选择市:</label>
        <div class="col-xs-12 col-sm-8">
        <select name="row[city_id]" id="parentNews" data-rules="required" class="form-control selectpicker">
            <option value="0">请选择</option>
        </select>
        </div>
    </div>

    <div class="form-group">
        <label for="c-area_id" class="control-label col-xs-12 col-sm-2">选择县、区:</label>
        <div class="col-xs-12 col-sm-8">
        <select name="row[area_id]" id="grandparentNews" data-rules="required" class="form-control selectpicker">
            <option value="52">请选择</option>
        </select>
        </div>
    </div>


    <div class="form-group">
        <label for="c-address" class="control-label col-xs-12 col-sm-2">详细地址:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-address" data-rule="required" class="form-control " rows="5" name="row[address]" cols="50"><?php echo $row['address']; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="c-lon" class="control-label col-xs-12 col-sm-2">经度:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="lon" data-rule="required" class="form-control" name="row[lon]" type="text" value="<?php echo $row['lon']; ?>" readonly >
        </div>
    </div>
    <div class="form-group">
        <label for="c-lat" class="control-label col-xs-12 col-sm-2">纬度:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="lat" data-rule="required" class="form-control" name="row[lat]" type="text" value="<?php echo $row['lat']; ?>" readonly >
        </div>
    </div>
    <div class="form-group">
        <label for="c-is_park" class="control-label col-xs-12 col-sm-2">是否属于园区:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="radio">
                <label><input name="row[is_park]" type="radio" value="0" onclick="showpark(2)" checked/>否</label>
                <label><input name="row[is_park]" type="radio" value="1" onclick="showpark(1)"/>是</label>
            </div>
        </div>
    </div>


    <div class="form-group" id="ispark" style="display: none">
        <label for="c-park_id" class="control-label col-xs-12 col-sm-2">选择园区:</label>
        <div class="col-xs-12 col-sm-8">

            <select  id="c-park_id" data-rule="required" class="form-control selectpicker" name="row[park_id]">
                <option value="0">请选择</option>
                <?php if(is_array($park) || $park instanceof \think\Collection || $park instanceof \think\Paginator): if( count($park)==0 ) : echo "" ;else: foreach($park as $key=>$vo): ?>
                    <option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>
    <div class="form-group">
        <label for="c-describe" class="control-label col-xs-12 col-sm-2">描述:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-describe" data-rule="required" class="form-control " rows="5" name="row[describe]" cols="50"><?php echo $row['describe']; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>
</form>
<div style="width:730px;margin:auto;">
    <!--<div class="inputdiv">要查询的地址：<input id="text_" type="text" value="宁波天一广场" style="margin-right:100px;"/></div>
    <div class="inputdiv">查询结果(经纬度)：<input id="result_" type="text" /></div>-->
    <!--<input type="button" value="查询" onclick="searchByStationName();"/>-->
    <div id="container"></div>
</div>

<script>
    var map = new BMap.Map("container");
    map.centerAndZoom("宁波", 12);
    map.enableScrollWheelZoom();    //启用滚轮放大缩小，默认禁用
    map.enableContinuousZoom();    //启用地图惯性拖拽，默认禁用

    map.addControl(new BMap.NavigationControl());  //添加默认缩放平移控件
    map.addControl(new BMap.OverviewMapControl()); //添加默认缩略地图控件
    map.addControl(new BMap.OverviewMapControl({ isOpen: true, anchor: BMAP_ANCHOR_BOTTOM_RIGHT }));   //右下角，打开

    var localSearch = new BMap.LocalSearch(map);
    localSearch.enableAutoViewport(); //允许自动调节窗体大小
    function searchByStationName() {
        map.clearOverlays();//清空原来的标注
        var keyword = document.getElementById("text_").value;

        localSearch.setSearchCompleteCallback(function (searchResult) {
            console.log(searchResult);
            var poi = searchResult.getPoi(0);

            document.getElementById("lon").value = poi.point.lng;
            document.getElementById("lat").value = poi.point.lat;
            map.centerAndZoom(poi.point, 13);
            var marker = new BMap.Marker(new BMap.Point(poi.point.lng, poi.point.lat));  // 创建标注，为要查询的地方对应的经纬度
            map.addOverlay(marker);
            var content = document.getElementById("text_").value + "<br/><br/>经度：" + poi.point.lng + "<br/>纬度：" + poi.point.lat;
            var infoWindow = new BMap.InfoWindow("<p style='font-size:14px;'>" + content + "</p>");
            marker.addEventListener("click", function () { this.openInfoWindow(infoWindow); });
            // marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
        });
        localSearch.search(keyword);
    }

    function showpark(isshow){
        if(isshow==1){
            document.getElementById("ispark").style.display= "block"
        }else{
            document.getElementById("ispark").style.display= "none"
        }
    }
</script>

<script type="text/javascript">
    $(function() {
        $(':checkbox').click(function() {
                $("#" + $(this).attr('pid')).attr('checked', true);
                $("#" + $(this).attr('gpid')).attr('checked', true);
                var id = $(this).attr('id');

                var inputs = $('input[pid=' + id + ']');
                $(this).attr('checked') ? inputs.attr('checked', true) : inputs.attr('checked', false);

                var ginputs = $('input[gpid=' + id + ']');
                $(this).attr('checked') ? ginputs.attr('checked', true) : ginputs.attr('checked', false);
            }
        );

    <?php if(empty($news)):?>

        $(document).ready(function() {
            //alert($(this).val());
            $.post('/admin/companymap/ajaxGetCity', {
                typeId: 2
            }, function(data) {
                $('#parentNews').empty();
                $('#parentNews').append(data);
            });
        });

    <?php endif;?>

        $('#typeId').change(function() {
            //alert($(this).val());
            $.post('/admin/companymap/ajaxGetCity', {
                typeId: $(this).val()
            }, function(data) {
                $('#parentNews').empty();
                $('#parentNews').append(data);
            });
        });

        $('#parentNews').change(function() {
            //alert($(this).val());
            $.post('/admin/companymap/ajaxGetqu', {
                typeId: $(this).val()
            }, function(data) {

                $('#grandparentNews').empty();
                $('#grandparentNews').append(data);
            });
        });
    });
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