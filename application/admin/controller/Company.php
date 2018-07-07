<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Db;
use wslibs\qyjg\QBq;
use wslibs\qyjg\QNum;

/**
 * 
 *
 * @icon fa fa-circle-o
 */
class Company extends Backend
{
    
    /**
     * Company模型对象
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('Company');
        $this->view->assign("floorList", $this->model->getFloorList());
        $this->view->assign("LevelList", $this->model->getLevelList());
    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
    

    /**
     * 查看
     */
    public function index()
    {
        //当前是否为关联查询
        $this->relationSearch = true;
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax())
        {
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model
                    ->with(['companylevel'])
                    ->where($where)
                    ->order($sort, $order)
                    ->count();

            $list = $this->model
                    ->with(['companylevel'])
                    ->where($where)
                    ->order($sort, "asc")
                    ->limit($offset, $limit)
                    ->select();

            foreach ($list as $row) {
                $row->visible(['id','company_name','code','f_name']);
                $row->visible(['companylevel']);
				$row->getRelation('companylevel')->visible(['name']);
            }

            $list = collection($list)->toArray();
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }


        return $this->view->fetch();
    }


    public function edit($ids=null){
        $c_id = $this->request->param("ids/s");
        if($this->request->isPost()){

            $bs_id = $this->request->post("row/a")['bs_id'];
            $re1 = (new QBq($c_id,$bs_id,QNum::TYPE_BS))->ManagerBq();

            $l_id = $this->request->post("row/a")['level_id'];
            $re2 = (new QBq($c_id,$l_id,QNum::TYPE_LEVEL))->ManagerBq();


            if($re1 && $re2){
                $this->success("修改成功");
            }else{
                $this->error("修改失败");
            }

        }else{
            $row = Db::name("company")->where("id",$c_id)->find();
            $this->assign("level_list",Db::name("company_level")->field("id,name")->select());
            $this->assign("bs",Db::name("business_scope")->field("id,name")->select());
            $this->assign("row",$row);
            return $this->fetch();
        }
    }
}
