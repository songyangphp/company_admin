<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Config;
use wslibs\qyjg\QNum;
use think\Db;

/**
 * 控制台
 *
 * @icon fa fa-dashboard
 * @remark 用于展示当前系统中的统计数据、统计报表及重要实时数据
 */
class Dashboard extends Backend
{

    /**
     * 查看
     */
    public function index()
    {
        $seventtime = \fast\Date::unixtime('day', -7);
        $paylist = $createlist = [];
        for ($i = 0; $i < 7; $i++)
        {
            $day = date("Y-m-d", $seventtime + ($i * 86400));
            $createlist[$day] = mt_rand(20, 200);
            $paylist[$day] = mt_rand(1, mt_rand(1, $createlist[$day]));
        }
        $hooks = config('addons.hooks');
        $uploadmode = isset($hooks['upload_config_init']) && $hooks['upload_config_init'] ? implode(',', $hooks['upload_config_init']) : 'local';
        $addonComposerCfg = ROOT_PATH . '/vendor/karsonzhang/fastadmin-addons/composer.json';
        Config::parse($addonComposerCfg, "json", "composer");
        $config = Config::get("composer");
        $addonVersion = isset($config['version']) ? $config['version'] : __('Unknown');

        $level = array_column(Db::name("num")->alias("n")->join("company_level cl","n.exid = cl.id")->where("num_type",QNum::TYPE_LEVEL)->field("cl.name,n.num")->select(),"num","name");

        $this->view->assign([
            'A'   => $level['A'] ? $level['A'] : 0,
            'B'   => $level['B'] ? $level['B'] : 0,
            'C'   => $level['C'] ? $level['C'] : 0,
            'D'   => $level['D'] ? $level['D'] : 0,
            'diaoxiao'   => Db::name("company_anjian")->count(),
            'yichang'  => Db::name("company_lieyi")->count(),
            'todayorder'       => 2324,
            'unsettleorder'    => 132,
            'sevendnu'         => '80%',
            'sevendau'         => '32%',
            'paylist'          => $paylist,
            'createlist'       => $createlist,
            'addonversion'     => $addonVersion,
            'uploadmode'       => $uploadmode,
            'yclist'           => $this->getyclist(),
            'dslist'           => $this->getdxlist()
        ]);
        return $this->view->fetch();
    }


    private function getyclist(){
        $list = Db::name("company_lieyi")->field("company_name,ly_time")->order("id desc")->limit(15)->select();
        foreach ($list as $k => $v){
            $list[$k]['ly_time'] = date("Y-m-d",$v['ly_time']);
        }
        return $list;
    }

    private function getdxlist(){
        $list = Db::name("company_anjian")->field("aj_name,ja_time")->order("id desc")->limit(15)->select();
        foreach ($list as $k => $v){
            $list[$k]['ja_time'] = date("Y-m-d",$v['ja_time']);
        }
        return $list;
    }

}
