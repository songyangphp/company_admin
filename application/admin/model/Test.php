<?php

namespace app\admin\model;

use think\Model;

class Test extends Model
{
    // 表名
    protected $name = 'test';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    
    // 追加属性
    protected $append = [
        'week_text',
        'flag_text',
        'genderdata_text',
        'hobbydata_text',
        'refreshtime_text',
        'status_text',
        'state_text'
    ];
    

    protected static function init()
    {
        self::afterInsert(function ($row) {
            $pk = $row->getPk();
            $row->getQuery()->where($pk, $row[$pk])->update(['weigh' => $row[$pk]]);
        });
    }

    
    public function getWeekList()
    {
        return ['monday' => __('Week monday'),'tuesday' => __('Week tuesday'),'wednesday' => __('Week wednesday')];
    }     

    public function getFlagList()
    {
        return ['hot' => __('Flag hot'),'index' => __('Flag index'),'recommend' => __('Flag recommend')];
    }     

    public function getGenderdataList()
    {
        return ['male' => __('Genderdata male'),'female' => __('Genderdata female')];
    }     

    public function getHobbydataList()
    {
        return ['music' => __('Hobbydata music'),'reading' => __('Hobbydata reading'),'swimming' => __('Hobbydata swimming')];
    }     

    public function getStatusList()
    {
        return ['normal' => __('Normal'),'hidden' => __('Hidden')];
    }     

    public function getStateList()
    {
        return ['0' => __('State 0'),'1' => __('State 1'),'2' => __('State 2')];
    }     


    public function getWeekTextAttr($value, $data)
    {        
        $value = $value ? $value : $data['week'];
        $list = $this->getWeekList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getFlagTextAttr($value, $data)
    {
        $value = $value ? $value : $data['flag'];
        $valueArr = explode(',', $value);
        $list = $this->getFlagList();
        return implode(',', array_intersect_key($list, array_flip($valueArr)));
    }


    public function getGenderdataTextAttr($value, $data)
    {        
        $value = $value ? $value : $data['genderdata'];
        $list = $this->getGenderdataList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getHobbydataTextAttr($value, $data)
    {
        $value = $value ? $value : $data['hobbydata'];
        $valueArr = explode(',', $value);
        $list = $this->getHobbydataList();
        return implode(',', array_intersect_key($list, array_flip($valueArr)));
    }


    public function getRefreshtimeTextAttr($value, $data)
    {
        $value = $value ? $value : $data['refreshtime'];
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getStatusTextAttr($value, $data)
    {        
        $value = $value ? $value : $data['status'];
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getStateTextAttr($value, $data)
    {        
        $value = $value ? $value : $data['state'];
        $list = $this->getStateList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    protected function setFlagAttr($value)
    {
        return is_array($value) ? implode(',', $value) : $value;
    }

    protected function setHobbydataAttr($value)
    {
        return is_array($value) ? implode(',', $value) : $value;
    }

    protected function setRefreshtimeAttr($value)
    {
        return $value && !is_numeric($value) ? strtotime($value) : $value;
    }


    public function category()
    {
        return $this->belongsTo('Category', 'category_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
}
