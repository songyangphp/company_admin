<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-06-23
 * Time: 14:26
 */
namespace wslibs\qyjg;
use think\Db;
use wslibs\qyjg\QLevel;

class QBq
{
    const FUNNAME = "Manager_";

    private $c_id;
    private $exid;
    private $type;

    public function __construct($c_id,$exid,$type){
        $this->c_id = $c_id;
        $this->exid = $exid;
        $this->type = $type;
    }

    public function ManagerBq(){
        $manager_fun = self::FUNNAME.$this->type;
        if(method_exists($this, $manager_fun)){
            Db::startTrans();
            if($this->{$manager_fun}()){
                Db::commit();
                return true;
            }else{
                Db::rollback();
                return false;
            }
        }else
            return false;
    }


    //企业类型标签
    private function Manager_4(){
        $hasbs_id = QCompany::getCompanySimple($this->c_id,"bs_id");
        if((int)$hasbs_id != 0){
            if($hasbs_id == $this->exid) return true;
            if(!QNum::DecNum($this->type,$hasbs_id) && !QCompany::ManagerCompany($this->c_id,array("bs_id"=>$hasbs_id))) return false;
        }

        $re1 = QCompany::ManagerCompany($this->c_id,array("bs_id" => $this->exid));
        $re2 = QNum::IncNum($this->type,$this->exid);

        if($re1 && $re2){
            return true;
        }else
            return false;
    }


    //等级标签
    private function Manager_3(){
        $hasbs_id = QCompany::getCompanySimple($this->c_id,"level_id");
        if((int)$hasbs_id != 0){
            if($hasbs_id == $this->exid) return true;
            if(!QNum::DecNum($this->type,$hasbs_id) && !QCompany::ManagerCompany($this->c_id,array("level_id"=>$hasbs_id))) return false;
        }

        $re1 = QCompany::ManagerCompany($this->c_id,array("level_id" => $this->exid));
        $re2 = QNum::IncNum($this->type,$this->exid);
        $re3 = QLevel::ManagerLevel($this->c_id,$hasbs_id ? $hasbs_id : 0,$this->exid);

        if($re1 && $re2 && $re3){
            return true;
        }else
            return false;
    }
}