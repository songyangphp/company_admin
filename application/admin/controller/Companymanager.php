<?php

namespace app\admin\controller;

use app\common\controller\Backend;

use think\Db;
use wslibs\qyjg\QBq;
use wslibs\qyjg\QNum;
use wslibs\qyjg\QCompany;
use wslibs\qyjg\QWszxData;


class Companymanager extends Backend
{
    private $btnconfig = [
        ["title"=>"变更记录","class"=>"btn btn-xs btn-danger btn-dialog"],
        ["title"=>"企业年报","class"=>"btn btn-xs btn-default btn-dialog"],
        ["title"=>"股权结构","class"=>"btn btn-xs btn-primary btn-dialog"],
        ["title"=>"投资关系","class"=>"btn btn-xs btn-success btn-dialog"],
        ["title"=>"企业链图","class"=>"btn btn-xs btn-info btn-dialog"],
        ["title"=>"关联族谱","class"=>"btn btn-xs btn-warning btn-dialog"],
    ];

    private $canseeconfig = ["关联族谱","企业链图","股权结构"];


    protected $searchFields = 'company_name,f_name';

    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('CompanyManager');
        $this->view->assign("floorList", $this->model->getFloorList());
    }

    public function index()
    {
        //当前是否为关联查询
        $this->relationSearch = true;
        //设置过滤方法
        $this->request->filter(['strip_tags']);

        if ($this->request->isAjax())
        {
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model
                    ->with(['companylevel','businessscope'])
                    ->where($where)
                    ->order($sort, $order)
                    ->count();

            $list = $this->model
                    ->with(['companylevel','businessscope'])
                    ->where($where)
                    ->order($sort, "asc")
                    ->limit($offset, 25)
                    ->select();

            foreach ($list as $row) {
                $row->visible(['id','company_name','code','f_name','addtime','floor']);
                $row->visible(['companylevel']);
				$row->getRelation('companylevel')->visible(['name']);
				$row->visible(['businessscope']);
				$row->getRelation('businessscope')->visible(['name']);
            }
            $list = collection($list)->toArray();

            $result = array("total" => $total, "rows" => $list);
            return json($result);
        }

        $this->assignconfig("bs_list",json_encode($this->model->getBsList()));
        return $this->view->fetch();
    }


    public function edit($ids=null){
        $c_id = $this->request->param("ids/s");
        if($this->request->isPost()){

            $bs_id = $this->request->post("row/a")['bs_id'];
            $re1 = (new QBq($c_id,$bs_id,QNum::TYPE_BS))->ManagerBq();

            $l_id = $this->request->post("row/a")['level_id'];
            $re2 = (new QBq($c_id,$l_id,QNum::TYPE_LEVEL))->ManagerBq();

            QCompany::ManagerCompany($c_id,['floor' => $this->request->post("row/a")['floor'],'b_id' => $this->request->post("row/a")['b_id']]);

            if($re1 && $re2){
                $this->success("修改成功");
            }else{
                $this->error("修改失败");
            }

        }else{
            $row = QCompany::getCompanySimple($c_id);
            $this->assign("row",$row);
            $this->assign("building",Db::name("building")->field("id,name")->select());
            $this->assign("level_list",Db::name("company_level")->field("id,name")->select());
            $this->assign("bs",Db::name("business_scope")->field("id,name")->select());

            return $this->fetch();
        }
    }

    public function info(){
        $c_id = $this->request->param("ids/s");
        $company_info = QCompany::getCompanyInfo($c_id);

        $btnlist = (new QWszxData("qyzx_cominfo","index",["com_id" => QWszxData::getComIDbyComName($company_info['company_name']) , "name" => $company_info['company_name']]))->getData();
        //$btnlist = (new QWszxData("qyzx_cominfo","index",["com_id" => QWszxData::getComIDbyComName("河北文始征信服务有限公司") , "name" => "河北文始征信服务有限公司"]))->getData();

        $num = [];$title = [];
        foreach ($btnlist as $k => $v){
            foreach ($v as $key => $value){
                if(strpos($key,'title') !== false){
                    $title[]["title"] = $value;
                }
                if(strpos($key,'num') !== false){
                    $num[]["num"] = $value;
                }
            }
        }

        foreach ($title as $k => $v){
            echo 111;
            if(!in_array($v['title'],array_column($this->btnconfig,"title"))){
                unset($title[$k]);
                continue;
            }
            $title[$k]['num'] = $num[$k]['num'];
        }

        foreach ($title as $k => $v){
            $title[$k]['class'] = array_column($this->btnconfig,"class")[$k-1];
            if($v['num'] > 0){
                $title[$k]['tip'] = "[".$v['num']."]";
            }else{
                if(!in_array($v['title'],$this->canseeconfig)){
                    $title[$k]['class'] .= " disabled";
                }
                $title[$k]['tip'] = "";
            }
            $title[$k]['url'] = $this->CreateUrl($company_info['company_name'],$v['title']);
        }


        if(input("sy")==1){
            dump($title);
            dump($company_info);
        }

        $this->assign("btn",$btn = $title);
        $this->assign("info",$company_info);
        return $this->fetch();
    }



    private function CreateUrl($c_name,$type_name){
        switch ($type_name){
            case "变更记录" : $url = url('Wszxdata/change',array('name'=>$c_name)); break;
            case "企业年报" : $url = url('Wszxdata/annualreport',array('name'=>$c_name)); break;
            case "股权结构" : $url = url('Wszxdata/gqjg',array('name'=>$c_name)); break;
            case "投资关系" : $url = url('Wszxdata/invest',array('name'=>$c_name)); break;
            case "企业链图" : $url = url('Wszxdata/nexus',array('name'=>$c_name)); break;
            case "关联族谱" : $url = url('Wszxdata/family',array('name'=>$c_name)); break;
        }
        return $url;
    }
}
