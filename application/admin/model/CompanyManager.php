<?php

namespace app\admin\model;

use think\Model;
use think\Db;

class CompanyManager extends Model
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
    

    public function getBsList(){
            return array_column(Db::name("business_scope")->field("name,id")->select(),"name","name");
    }
    
    public function getFloorList()
    {
        return ['4' => __('Floor 4')];
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


    public function businessscope()
    {
        return $this->belongsTo('BusinessScope', 'bs_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
}
