//提示：下面的代码用jquery，所以如果有不能运行的情况请引用后尝试
//百度地图api container对应前端div名称 前端要引用2.0版本的百度地图api
//需引用api.map.baidu.com/library/AreaRestriction/1.2/src/AreaRestriction_min.js
var map = new BMap.Map("container", { enableMapClick: false }); // 创建地图实例，禁止点击地图底图
map.addControl(new BMap.MapTypeControl()); //设置三维地图控件
map.enableScrollWheelZoom(true);
var top_left_navigation = new BMap.NavigationControl();
map.addControl(top_left_navigation);
//设置样式
/*map.setMapStyle({
    styleJson: [
        {//不显示点信息
            "featureType": "poi",
            "elementType": "all",
            "stylers": {
                "color": "#ffffff",
                "visibility": "off"
            }
        }
    ]
});*/

//map.disableDragging();//禁止拖动
//map.disableDoubleClickZoom();//禁止双击缩放
var blist = [];
var districtLoading = 0;

function getBoundary() {
    addDistrict("石家庄市裕华区");
    addDistrict("石家庄市桥西区");
    addDistrict("石家庄市新华区");
    addDistrict("石家庄市长安区");
    addDistrict("石家庄市鹿泉区");
    addDistrict("石家庄市藁城区");
    addDistrict("石家庄市栾城区");
    addDistrict("石家庄市正定县");
    addDistrict("石家庄市元氏县");
    addDistrict("石家庄市平山县");
    addDistrict("石家庄市灵寿县");
    addDistrict("石家庄市行唐县");
    addDistrict("石家庄市新乐市");
    addDistrict("石家庄市无极县");
    addDistrict("石家庄市深泽县");
    addDistrict("石家庄市赵县");
    addDistrict("石家庄市赞皇县");
    addDistrict("石家庄市晋州市");
    addDistrict("石家庄市辛集市");
    addDistrict("石家庄市高邑县");
    addDistrict("石家庄市井陉矿区");
    addDistrict("石家庄市井陉县");
}

/**
 * 添加行政区划
 * @param {} districtName 行政区划名
 * @returns  无返回值
 */
function addDistrict(districtName) {
    //使用计数器来控制加载过程
    districtLoading++;
    var bdary = new BMap.Boundary();
    bdary.get(districtName, function (rs) {       //获取行政区域
        var count = rs.boundaries.length; //行政区域的点有多少个
        if (count === 0) {
            alert('未能获取当前输入行政区域');
            return;
        }
        for (var i = 0; i < count; i++) {
            blist.push({ points: rs.boundaries[i], name: districtName });
        };
        //加载完成区域点后计数器-1
        districtLoading--;
        if (districtLoading == 0) {
            //全加载完成后画端点
            drawBoundary();
        }
    });
}

function getMousePos(event) {
    var e = event || window.event;
    return {0:e.layerX+"px",1:e.layerY+"px"}
}

/**
 * 各种鼠标事件绑定
 */

function click(evt) {
    var posX = getMousePos()["0"];
    var posY = getMousePos()["1"];
    $.ajax({
        url: "/admin/companymap/getarealist",
        type: 'post',
        data: {
            area:evt.target.name
        },

        success: function (res) {
            var Adata = JSON.parse(res)["A"];
            var Bdata = JSON.parse(res)["B"];
            var Cdata = JSON.parse(res)["C"];
            var Ddata = JSON.parse(res)["D"];
            var Ahtml = "<div class='div_class'><h1>"+evt.target.name+"</h1><ul>";
            for (var i = 0;i < Adata.length;i++){
                Ahtml = Ahtml+"<li><a class='btn btn-xs btn-primary btn-dialog' title='详细信息' href='/admin/companymanager/info/ids/"+Adata[i]['id']+"'>"+Adata[i]['company_name']+"</a></li>";
            }
            Ahtml = Ahtml+"</ul></div>";

            var Bhtml = "<div class='div_class'><h1>"+evt.target.name+"</h1><ul>";
            for (var i = 0;i < Bdata.length;i++){
                Bhtml = Bhtml+"<li><a class='btn btn-xs btn-primary btn-dialog' title='详细信息' href='/admin/companymanager/info/ids/"+Bdata[i]['id']+"'>"+Bdata[i]['company_name']+"</a></li>";
            }
            Bhtml = Bhtml+"</ul></div>";

            var Chtml = "<div class='div_class'><h1>"+evt.target.name+"</h1><ul>";
            for (var i = 0;i < Cdata.length;i++){
                Chtml = Chtml+"<li><a class='btn btn-xs btn-primary btn-dialog' title='详细信息' href='/admin/companymanager/info/ids/"+Cdata[i]['id']+"'>"+Cdata[i]['company_name']+"</a></li>";
            }
            Chtml = Chtml+"</ul></div>";

            var Dhtml = "<div class='div_class'><h1>"+evt.target.name+"</h1><ul>";
            for (var i = 0;i < Ddata.length;i++){
                Dhtml = Dhtml+"<li><a class='btn btn-xs btn-primary btn-dialog' title='详细信息' href='/admin/companymanager/info/ids/"+Ddata[i]['id']+"'>"+Ddata[i]['company_name']+"</a></li>";
            }
            Dhtml = Dhtml+"</ul></div>";

            layer.tab({
                offset:["100px","100px"],
                area: ['450px', '700px'],
                //title: evt.target.name+"的企业",
                tab: [
                    {
                        title: "<p style='background-color: #18BC9C; color: white; width: 100%'>A类企业</p>",
                        content: Ahtml
                    },
                    {
                        title: "<p style='background-color: #4B97FF; color: white; width: 100%'>B类企业</p>",
                        content: Bhtml
                    },
                    {
                        title: "<p style='background-color: #ff0000; color: white; width: 100%'>C类企业</p>",
                        content: Chtml
                    },
                    {
                        title: "<p style='background-color: #000000; color: white; width: 100%'>D类企业</p>",
                        content: Dhtml
                    }
                ]
            });
        }
    });
}

function mouseover(evt) {
    evt.target.label.setZIndex(99);
    evt.target.label.setPosition(evt.point);
    evt.target.label.show();
    //layer.msg(evt.target.name);
}

function mousemove(evt) {
    evt.target.label.setPosition(evt.point);
}

function mouseout(evt) {
    evt.target.label.hide();
}

function drawBoundary() {
    //包含所有区域的点数组
    var pointArray = [];

    /*画遮蔽层的相关方法
    *思路: 首先在中国地图最外画一圈，圈住理论上所有的中国领土，然后再将每个闭合区域合并进来，并全部连到西北角。
    *      这样就做出了一个经过多次西北角的闭合多边形*/
    //定义中国东南西北端点，作为第一层
    var pNW = { lat: 59.0, lng: 73.0 }
    var pNE = { lat: 59.0, lng: 136.0 }
    var pSE = { lat: 3.0, lng: 136.0 }
    var pSW = { lat: 3.0, lng: 73.0 }
    //向数组中添加一次闭合多边形，并将西北角再加一次作为之后画闭合区域的起点
    var pArray = [];
    pArray.push(pNW);
    pArray.push(pSW);
    pArray.push(pSE);
    pArray.push(pNE);
    pArray.push(pNW);

    //颜色随机生成
    var getRandomColor = function(){
        return '#'+Math.floor(Math.random()*16777215).toString(16);
    }

    //循环添加各闭合区域
    for (var i = 0; i < blist.length; i++) {
        //添加显示用标签层
        var label = new BMap.Label(blist[i].name, { offset: new BMap.Size(20, -10) });
        label.hide();
        map.addOverlay(label);

        //添加多边形层并显示
        var ply = new BMap.Polygon(blist[i].points, {fillColor: getRandomColor(), strokeWeight: 2, strokeColor: "#000000", fillOpacity: 0.4}); //建立多边形覆盖物
        ply.name = blist[i].name;
        ply.label = label;
        ply.addEventListener("click", click);
        ply.addEventListener("mouseover", mouseover);
        ply.addEventListener("mouseout", mouseout);
        ply.addEventListener("mousemove", mousemove);
        map.addOverlay(ply);

        //添加名称标签层
        /*var centerlabel = new BMap.Label(blist[i].name, { offset: new BMap.Size(0, 0) });
        centerlabel.setPosition(ply.getBounds().getCenter());
        map.addOverlay(centerlabel);*/

        //将点增加到视野范围内
        var path = ply.getPath();
        pointArray = pointArray.concat(path);
        //将闭合区域加到遮蔽层上，每次添加完后要再加一次西北角作为下次添加的起点和最后一次的终点
        pArray = pArray.concat(path);
        pArray.push(pArray[0]);
    }

    //限定显示区域，需要引用api库
    var boundply = new BMap.Polygon(pointArray);
    //BMapLib.AreaRestriction.setBounds(map, boundply.getBounds());
    map.setViewport(pointArray);    //调整视野

    //添加遮蔽层
    var plyall = new BMap.Polygon(pArray, { strokeOpacity: 0.0000001, strokeColor: "#000000", strokeWeight: 0.00001, fillColor: "#DDE4F0", fillOpacity: 0.4 }); //建立多边形覆盖物
    map.addOverlay(plyall);
}

setTimeout(function () {
    getBoundary();
}, 100);