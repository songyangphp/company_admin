<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-06-25
 * Time: 16:52
 */

namespace wslibs\qyjg;
use think\Db;


class QLevel
{
    const STRING = "管理员操作";

    public static function ManagerLevel($c_id,$before,$after){
        if(!$c_id || !$after) return false;

        $insertData = ["c_id" => $c_id , "before_lid" => $before , "after_lid" => $after , "addtime" => time() , "reason" => self::STRING];
        return Db::name("company_level_record")->insertGetId($insertData);
    }
}