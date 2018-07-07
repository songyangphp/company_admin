<?php

namespace app\admin\model;

use think\Model;
use think\Db;

class Company extends Model
{
    // 表名
    protected $name = 'company';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    
    // 追加属性
    protected $append = [
        'addtime_text',
        'floor_text'
    ];
    

    public function getLevelList()
    {
        $list = array_column((array)Db::name("company_level")->field("id,name")->select(),"name","id");
        return $list;
    }

    
    public function getFloorList()
    {
        $list = array_column((array)Db::name("company_level")->field("id,name")->select(),"name","id");
        return $list;
    }


    public function getAddtimeTextAttr($value, $data)
    {
        $value = $value ? $value : $data['addtime'];
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getFloorTextAttr($value, $data)
    {        
        $value = $value ? $value : $data['floor'];
        $list = $this->getFloorList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    protected function setAddtimeAttr($value)
    {
        return $value && !is_numeric($value) ? strtotime($value) : $value;
    }


    public function companylevel()
    {
        return $this->belongsTo('CompanyLevel', 'level_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
}
