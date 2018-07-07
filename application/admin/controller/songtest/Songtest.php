<?php
namespace app\admin\controller\songtest;

use think\Db;
use app\common\controller\Backend;
class Songtest extends Backend{
    public function index(){
        $i = input("id","","trim");
        $map = [];
        $map['id'] = $i;
        $list = Db::name("song")->where($map)->select();
        echo "我是接受的参数：".$i."<br>";
        echo "<a href=".url("aaa").">点击跳转</a>";
        dump($list);

        $this->assign("list",$list);

        return view();
    }

    public function aaa(){
        echo "AAAA";
    }
}