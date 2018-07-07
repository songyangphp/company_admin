<?php

namespace app\admin\model;

use think\Model;

class Dm extends Model
{
    // 表名
    protected $name = 'dm';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    
    // 追加属性
    protected $append = [
        'addtime_text',
        'type_text',
        'create_type_text'
    ];
    

    
    public function getTypeList()
    {
        return ['4' => __('Type 4')];
    }     

    public function getCreateTypeList()
    {
        return ['4' => __('Create_type 4')];
    }     


    public function getAddtimeTextAttr($value, $data)
    {
        $value = $value ? $value : $data['addtime'];
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getTypeTextAttr($value, $data)
    {        
        $value = $value ? $value : $data['type'];
        $list = $this->getTypeList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getCreateTypeTextAttr($value, $data)
    {        
        $value = $value ? $value : $data['create_type'];
        $list = $this->getCreateTypeList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    protected function setAddtimeAttr($value)
    {
        return $value && !is_numeric($value) ? strtotime($value) : $value;
    }


}
