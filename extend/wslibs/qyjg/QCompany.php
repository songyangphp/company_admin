<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-06-22
 * Time: 16:46
 */

namespace wslibs\qyjg;
use think\Db;

class QCompany
{
    //获取简版信息
    public static function getCompanySimple($c_id,$field = ''){
        if(!empty($field)){
            return Db::name("company")->where("id = '$c_id'")->value($field);
        }
        return Db::name("company")->where("id = '$c_id'")->find();
    }

    //获取全纬度信息
    public static function getCompanyInfo($c_id,$field = ''){
        if(!empty($field)){
            return Db::name("company_info")->where("c_id",$c_id)->value($field);
        }
        return Db::name("company_info")->where("c_id = '$c_id'")->find();
    }

    public static function ManagerCompany($c_id,$data){
        if(!$c_id || !$data) return false;
        if(Db::name("company")->where("id",$c_id)->where($data)->find()) return true;

        return Db::name("company")->where("id = '$c_id'")->update($data);
    }
}