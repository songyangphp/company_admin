<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-06-22
 * Time: 10:22
 */

namespace wslibs\qyjg;
use think\Db;


class QBuilding
{
    public static function addBuilding($data){
        if(!$data) return false;
        $building_name = $data['name'];
        if($has = Db::name("building")->where("name = '$building_name'")->find()) return $has['id'];

        $Insertdata = [
            "name" => $data['name'],
            "province_id" => $data['province_id'],
            "city_id" => $data['city_id'],
            "area_id" => $data['area_id'],
            "is_park" => $data['is_park'],
            "park_id" => $data['park_id'],
            "addtime" => time(),
            "address" => $data['address'],
            "floor" => $data['floor'],
            "lon" => $data['lon'],
            "lat" => $data['lat'],
            "describe" => $data['describe']
        ];

        return Db::name("building")->insertGetId($Insertdata);
    }

    private static function getAreaNameById($a_id){
        if(!$a_id) return false;
        return Db::name("area_tree")->where("id = '$a_id'")->value("name");
    }
}