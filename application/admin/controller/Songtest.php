<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use wslibs\wsform\InputType;
use wslibs\wsform\WsForm;
use wslibs\wsform\Item;
use think\Db;
use wslibs\qyjg\QNum;
use wslibs\qyjg\QWszxData;

class Songtest extends Backend
{
    public function index(){
        $level = Db::name("num")->alias("n")->join("company_level cl","n.exid = cl.id")->where("num_type",QNum::TYPE_LEVEL)->field("cl.name,n.num")->select();
        $bs = Db::name("num")->alias("n")->join("business_scope bs","n.exid = bs.id")->where("num_type",QNum::TYPE_BS)->field("bs.name,n.num")->select();
        dump($bs);
        dump($level);
    }

    public function song(){
        $eq50 = "50万以下的：".Db::name("company_info")->field("count(*)")->where("zc_money","<","50")->find()['count(*)']."家";
        $b200and50 = "50-200万的：".Db::name("company_info")->field("count(*)")->where("zc_money","BETWEEN","50,200")->find()['count(*)']."家";
        $gt200 = "200万以上的：".Db::name("company_info")->field("count(*)")->where("zc_money",">","200")->find()['count(*)']."家";

        dump($eq50);
        dump($b200and50);
        dump($gt200);
    }

    public function yang(){

        $post_data = array(
            "com_id"=>"431732303",
        );

        dump((new QWszxData("qyzx_sharehold","sharehold",$post_data))->getData());die;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://www.wszx.cc/api.php");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $data = curl_exec($ch);
        curl_close($ch);
        dump($data);
        echo "<hr>";
        dump(unserialize($data));
        die;


        $map['ci.address'] = ["like","%石家庄市桥西区%"];
        $list = Db::name("company_info")
            ->alias("ci")
            ->join("company c","ci.c_id = c.id")
            ->field("ci.company_name,c.level_id")
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
        dump($out);
    }

    public function initedit(){
        $form = new WsForm();
        $item = new Item();
        $item->varName("company_name")->varTitle("企业名称")->inputType(InputType::text)->required(true);
        $form->addItem($item);

        $item = new Item();
        $item->varName("code")->varTitle("统一社会信用代码")->inputType(InputType::text)->required(true);
        $form->addItem($item);

        $item = new Item();
        $item->varName("b_id")->varTitle("所属楼宇")->inputType(InputType::text)->required(true);
        $form->addItem($item);

        $item = new Item();
        $item->varName("floor")->varTitle("所属楼层")->inputType(InputType::select)->required(true);
        $item->itemArr([1=>"1层",2=>"2层"]);
        $form->addItem($item);

        $item = new Item();
        $item->varName("level_id")->varTitle("企业等级")->inputType(InputType::select)->required(true);
        $item->itemArr([1=>"1层",2=>"2层"]);
        $form->addItem($item);

        $item = new Item();
        $item->varName("bs_id")->varTitle("类型标签")->inputType(InputType::select)->required(true);
        $item->itemArr([1=>"1层",2=>"2层"]);
        $form->addItem($item);

        $form->setMakeType(WsForm::Type_Form);
        $form->makeForm("company/edit");
    }


    public function initbuilding(){
        $form = new WsForm();
        $item = new Item();
        $item->varName("building_name")->varTitle("楼宇名称")->inputType(InputType::text)->required(true);
        $form->addItem($item);

        $item = new Item();
        $item->varName("floor")->varTitle("楼层数")->inputType(InputType::text)->required(true);
        $form->addItem($item);

        $item = new Item();
        $item->varName("address")->varTitle("详细地址")->inputType(InputType::textarea)->required(true);
        $form->addItem($item);

        $item = new Item();
        $item->varName("lon")->varTitle("经度")->inputType(InputType::text)->required(true);
        $form->addItem($item);

        $item = new Item();
        $item->varName("lat")->varTitle("纬度")->inputType(InputType::text)->required(true);
        $form->addItem($item);

        $item = new Item();
        $item->varName("is_park")->varTitle("类型标签")->inputType(InputType::radio)->required(true);
        $item->itemArr([0=>"大厦",1=>"园区"]);
        $form->addItem($item);

        $item = new Item();
        $item->varName("park_id")->varTitle("选择园区")->inputType(InputType::select)->required(true);
        $item->itemArr([0=>"a大厦",1=>"b园区"]);
        $form->addItem($item);

        $item = new Item();
        $item->varName("describe")->varTitle("描述")->inputType(InputType::textarea)->required(true);
        $form->addItem($item);

        $form->setMakeType(WsForm::Type_Form);
        $form->makeForm("companymap/test1");
    }
}
