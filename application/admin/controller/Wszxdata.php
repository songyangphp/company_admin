<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-07-04
 * Time: 13:59
 */

namespace app\admin\controller;
use app\common\controller\Backend;
use wslibs\qyjg\QWszxData;


class Wszxdata extends Backend
{
    //关系族谱
    public function family(){
        $name = $this->request->param("name/s");
        $tyc_id = QWszxData::getComIDbyComName($name);
        $wszx_code = md5(md5('wenshijituan'.$tyc_id).$tyc_id);
        $this->redirect("http://www.wszx.cc/Qyzxliantu-index.html?com_id=".$tyc_id."&code=".$wszx_code);
    }


    //企业链图
    public function nexus(){
        $name = $this->request->param("name/s");
        $tyc_id = QWszxData::getComIDbyComName($name);
        $wszx_code = md5(md5('wenshijituan'.$tyc_id).$tyc_id);
        $this->redirect("http://www.wszx.cc/Qyzxliantu-liantu.html?com_id=".$tyc_id."&code=".$wszx_code);
    }


    //股权结构
    public function gqjg(){
        $c_name = $this->request->param("name/s");
        $c_id = QWszxData::getComIDbyComName($c_name);
        $list = ((new QWszxData("qyzx_sharehold","sharehold",["com_id" => $c_id]))->getData());

        if(!$list){
            $this->testdata($c_name);
            $list = ((new QWszxData("qyzx_sharehold","sharehold",["com_id" => $c_id]))->getData());
            if(!$list){
                $this->error("暂无信息");
            }
        }

        foreach ($list as $k => $v){
            if($v['link_status'] == 1){
                $list[$k]['name'] .= "（企业股东）";
            } else {
                $list[$k]['name'] .= "（自然人股东）";
            }
        }

        $this->assign("list",$list);
        return $this->fetch();
    }

    //变更记录
    public function change(){
        $c_name = $this->request->param("name/s");
        $c_id = QWszxData::getComIDbyComName($c_name);
        $list = ((new QWszxData("qyzx_changerecordlist","bgjjlist",["com_id" => $c_id]))->getData());

        if(!$list){
            $this->testdata($c_name);
            $list = ((new QWszxData("qyzx_changerecordlist","bgjjlist",["com_id" => $c_id]))->getData());
            if(!$list){
                echo "<script>alert('该企业暂无信息变更记录')</script>";exit;
                //$this->error("该企业暂无信息变更记录",url("",["alert"=>1]));
            }
        }


        $this->assign("list",$list);
        return $this->fetch();
    }


    //投资关系
    public function invest(){
        $c_name = $this->request->param("name/s");
        $c_id = QWszxData::getComIDbyComName($c_name);
        $list = ((new QWszxData("qyzx_investrelation","invest",["com_id" => $c_id , "type" => 1]))->getData());

        if(!$list){
            $this->testdata($c_name);
            $list = ((new QWszxData("qyzx_investrelation","invest",["com_id" => $c_id , "type" => 1]))->getData());
            if(!$list){
                $this->error("该企业暂无信息");
            }
        }

        $this->assign("list",$list);
        return $this->fetch();
    }


    public function annualreport(){
        $c_name = $this->request->param("name/s");
        $c_id = QWszxData::getComIDbyComName($c_name);
        $list = ((new QWszxData("qyzx_annualreport","index",["id" => $c_id]))->getData());

        if(!$list){
            $this->testdata($c_name);
            $list = ((new QWszxData("qyzx_annualreport","index",["id" => $c_id]))->getData());
            if(!$list){
                $this->error("该企业暂无年报信息");
            }
        }
        //dump($list);die;

        $this->assign("list",$list);
        return $this->fetch();
    }


    private function testdata($name){
        $tyc_id = QWszxData::getComIDbyComName($name);
        $wszx_code = md5(md5('wenshijituan'.$tyc_id).$tyc_id);
        $url = "http://www.wszx.cc/Qyzxliantu-index.html?com_id=".$tyc_id."&code=".$wszx_code;
        file_get_contents($url);
    }
}