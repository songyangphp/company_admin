<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-06-22
 * Time: 15:36
 */

namespace wslibs\qyjg;
use think\Db;

class QNum
{
    const INCREASE = 1; //+
    const REDUCE = 2; //-

    const TYPE_BUILDING = 1; //楼宇
    const TYPE_PARK = 2; //园区
    const TYPE_LEVEL = 3; //企业等级
    const TYPE_BS = 4; //经营类型

    public static function IncNum($numtype,$exid){
        if(!self::getNum($numtype,$exid)){
            self::addNum($numtype,$exid);
        }
        return self::ManagerNum(self::INCREASE,$numtype,$exid);
    }

    public static function DecNum($numtype,$exid){
        if(!self::getNum($numtype,$exid)){
            self::addNum($numtype,$exid);
        }
        return self::ManagerNum(self::REDUCE,$numtype,$exid);
    }

    public static function addNum($numtype,$exid){
        if($has = Db::name("num")->where("num_type = '$numtype' and exid = '$exid'")->find()){
            return $has['id'];
        }else{
            return Db::name("num")->insertGetId(array("num_type" => $numtype,"exid" => $exid,"num" => 0));
        }
    }

    public static function getNum($numtype,$exid=0){
        $map['num_type'] = $numtype;
        if($exid){
            $map['exid'] = $exid;
        }

        return Db::name("num")->where($map)->find("num");
    }

    private static function ManagerNum($type,$numtype,$exid){
        if($type == self::INCREASE){
            $re = Db::name("num")->where("num_type = '$numtype' and exid = '$exid'")->setInc("num" , 1);
        }else{
            $re = Db::name("num")->where("num_type = '$numtype' and exid = '$exid'")->setDec("num" , 1);
        }

        if($re){
            return true;
        }else
            return false;
    }
}