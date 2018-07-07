<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-07-06
 * Time: 14:08
 */

namespace app\admin\controller;
use app\common\controller\Backend;


class Task extends Backend
{
    public function index(){
        return $this->fetch();
    }
}