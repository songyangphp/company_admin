<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-06-25
 * Time: 16:22
 */

namespace app\admin\controller;
use app\common\controller\Backend;
use think\Db;
use wslibs\qyjg\QBuilding;


class Companymap extends Backend
{
    const KEY ="Z86tajoYOqAFcANAI37EWAX01hxBzzu6";

    public function ajaxGetCity() {
        $typeId = input ('post.typeId', 0, 'intval');
        $map ['pid'] = $typeId;
        $list = array_column(Db::name('area_tree')->field('id,name')->where($map)->select(),"name","id");
        $html = '';
        foreach ($list as $k => $v) {
            $html .= "<option value='" . $k . "'>" . $v . "</option>";
        }
        die($html);
    }

    public function ajaxGetqu() {
        $typeId = input('post.typeId', 0, 'intval');
        $map['pid'] = $typeId;
        $list = array_column(Db::name('area_tree')->field('id,name')->where($map)->select(),"name","id");
        $html = '';
        foreach ($list as $k => $v) {
            $html .= "<option value='" . $k . "'>" . $v . "</option>";
        }
        die($html);
    }

    public function index(){
        echo "<a style='display: none'>11</a>";
        $this->assign("key",self::KEY);
        return $this->fetch();
    }

    public function test(){
        echo "<a style='display: none'>11</a>";
        $this->assign("key",self::KEY);
        return $this->fetch();
    }

    public function addbuilding(){
        if($this->request->isPost()){
            $postdata = $this->request->post("row/a");
            $data = [
                "name" => $postdata['building_name'],
                "province_id" => $postdata['province_id'],
                "city_id" => $postdata['city_id'],
                "area_id" => $postdata['area_id'],
                "is_park" => $postdata['is_park'],
                "floor" => $postdata['floor'],
                "address" => $postdata['address'],
                "lon" => $postdata['lon'],
                "lat" => $postdata['lat'],
                "describe" => $postdata['describe']
            ];

            if($postdata['is_park']){
                $data['park_id'] = $postdata['park_id'];
            }else{
                $data['park_id'] = 0;
            }

            if(QBuilding::addBuilding($data)){
                $this->success("添加楼宇成功");
            }else
                $this->error("添加楼宇失败");

        }else{
            $this->assign("park",Db::name("park")->field("name,id")->select());
            $this->assign("newsType", Db::name("area_tree")->where("pid=1 and type=1 and id=10")->order('id asc')->select());
            $this->assign("row",[]);
            $this->assign("key",self::KEY);
            return $this->fetch();
        }
    }

    public function getarealist(){
        $area = input("area","","trim");
        $map['ci.address'] = ["like","%$area%"];
        $out = [];
        $list = Db::name("company_info")
            ->alias("ci")
            ->join("company c","ci.c_id = c.id")
            ->field("ci.company_name,c.level_id,ci.id")
            ->where($map)
            ->order("ci.id asc")
            ->limit(30)
            ->select();

        foreach ($list as $k => $v){
            switch ($v['level_id']){
                case 1 : $out['A'][] = $v; break;
                case 2 : $out['B'][] = $v; break;
                case 3 : $out['C'][] = $v; break;
                case 4 : $out['D'][] = $v; break;
            }
        }

        $out["A"] = $out["A"] ? $out["A"] : [];
        $out["B"] = $out["B"] ? $out["B"] : [];
        $out["C"] = $out["C"] ? $out["C"] : [];
        $out["D"] = $out["D"] ? $out["D"] : [];

        echo json_encode($out);
    }


    public function nexus(){
        $name = $this->request->param("name/s");
        $data = json_decode(file_get_contents("https://open.api.tianyancha.com/services/v4/open/baseinfo.json?name=".$name),true);
        $tyc_id = $data['result']['id'];
        $wszx_code = md5(md5('wenshijituan'.$tyc_id).$tyc_id);
        $this->redirect("http://www.wszx.cc/Qyzxliantu-index.html?com_id=".$tyc_id."&code=".$wszx_code);
    }
}