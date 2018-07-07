<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-06-28
 * Time: 9:54
 */

namespace wslibs\qyjg;
use think\Db;


class QDataupload
{
    const COMPANY = 1;
    const COMPANY_YEAR = 2;
    const COMPANY_LIEYI = 3;
    const COMPANY_DIAOXIAO = 4;

    public static function UploadCompany(){
        ini_set('memory_limit','1024M');
        if (!empty($_FILES)) {
            $file = request()->file('image');

            // 移动到框架应用根目录/public/uploads/ 目录下
            if($file){
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    /*// 成功上传后 获取上传信息
                    // 输出 jpg
                    echo $info->getExtension();
                    // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                    echo $info->getSaveName();
                    // 输出 42a79759f284b767dfcb2a0197904287.jpg
                    echo $info->getFilename();*/
                    vendor("PHPExcel.PHPExcel");
                    $file_name= UPLOAD_PATH.$info->getSaveName();
                    /*dump($info->getExtension());
                    dump($file_name);die;*/
                    $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));//判断导入表格后缀格式
                    if ($extension == 'xlsx') {
                        $objReader =\PHPExcel_IOFactory::createReader('Excel2007');
                        $objPHPExcel =$objReader->load($file_name, $encode = 'utf-8');
                    } else if ($extension == 'xls'){
                        $objReader =\PHPExcel_IOFactory::createReader('Excel5');
                        $objPHPExcel =$objReader->load($file_name, $encode = 'utf-8');
                    }
                    $sheet =$objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow();//取得总行数
                    $highestColumn =$sheet->getHighestColumn(); //取得总列数

                    Db::startTrans();
                    for ($i = 2; $i <= $highestRow; $i++) {
                        $c_data['company_name'] = $objPHPExcel->getActiveSheet()->getCell("C" .$i)->getValue();
                        $c_data['code'] = $objPHPExcel->getActiveSheet()->getCell("A" .$i)->getValue();
                        $c_data['f_name'] = $objPHPExcel->getActiveSheet()->getCell("F" .$i)->getValue();
                        $c_data['addtime'] = time();

                        $c_re = Db::name('company')->insertGetId($c_data);
                        if(!$c_re){
                            Db::rollback();
                            return false;
                        }

                        $c_id = Db::getLastInsID();
                        $info_data['code'] = $objPHPExcel->getActiveSheet()->getCell("A" . $i)->getValue();
                        $info_data['register_num'] =$objPHPExcel->getActiveSheet()->getCell("B" .$i)->getValue();
                        $info_data['company_name'] =$objPHPExcel->getActiveSheet()->getCell("C" .$i)->getValue();
                        $info_data['dj_type'] = $objPHPExcel->getActiveSheet()->getCell("D". $i)->getValue();
                        $info_data['company_type'] = $objPHPExcel->getActiveSheet()->getCell("E". $i)->getValue();
                        $info_data['f_name'] = $objPHPExcel->getActiveSheet()->getCell("F". $i)->getValue();
                        $info_data['f_idcards'] = $objPHPExcel->getActiveSheet()->getCell("G". $i)->getValue();
                        $info_data['lly_name'] = $objPHPExcel->getActiveSheet()->getCell("H". $i)->getValue();
                        $info_data['lly_phone'] = $objPHPExcel->getActiveSheet()->getCell("I". $i)->getValue();
                        $info_data['zc_money'] = $objPHPExcel->getActiveSheet()->getCell("J". $i)->getValue();
                        $info_data['ss_money'] = $objPHPExcel->getActiveSheet()->getCell("K". $i)->getValue();
                        $info_data['company_phone'] = $objPHPExcel->getActiveSheet()->getCell("L". $i)->getValue();
                        $info_data['operation'] = $objPHPExcel->getActiveSheet()->getCell("M". $i)->getValue();
                        $info_data['found_time'] = $objPHPExcel->getActiveSheet()->getCell("N". $i)->getValue();
                        $info_data['jy_time'] = $objPHPExcel->getActiveSheet()->getCell("O". $i)->getValue();
                        $info_data['dj_jigou'] = $objPHPExcel->getActiveSheet()->getCell("P". $i)->getValue();
                        $info_data['postalcode'] = $objPHPExcel->getActiveSheet()->getCell("Q". $i)->getValue();
                        $info_data['address'] = $objPHPExcel->getActiveSheet()->getCell("R". $i)->getValue();
                        $info_data['jg_jigou'] = $objPHPExcel->getActiveSheet()->getCell("S". $i)->getValue();
                        $info_data['status'] = $objPHPExcel->getActiveSheet()->getCell("T". $i)->getValue();
                        $info_data['hy_code'] = $objPHPExcel->getActiveSheet()->getCell("U". $i)->getValue();
                        $info_data['hz_time'] = $objPHPExcel->getActiveSheet()->getCell("V". $i)->getValue();
                        $info_data['c_id'] = $c_id;
                        $info_data['addtime'] = time();


                        $info_re = Db::name('company_info')->insertGetId($info_data);
                        if(!$info_re){
                            Db::rollback();
                            return false;
                        }
                    }

                    Db::commit();
                    return true;
                }else{
                    // 上传失败获取错误信息
                    echo $file->getError();
                    return false;
                }
            }else{
                return false;
            }
        } else {
            return false;
        }
    }

    public static function uploadcompanyyear(){
        ini_set('memory_limit','1024M');
        if (!empty($_FILES)) {
            $file = request()->file('image');

            // 移动到框架应用根目录/public/uploads/ 目录下
            if($file){
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    /*// 成功上传后 获取上传信息
                    // 输出 jpg
                    echo $info->getExtension();
                    // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                    echo $info->getSaveName();
                    // 输出 42a79759f284b767dfcb2a0197904287.jpg
                    echo $info->getFilename();*/
                    vendor("PHPExcel.PHPExcel");
                    $file_name= UPLOAD_PATH.$info->getSaveName();
                    /*dump($info->getExtension());
                    dump($file_name);die;*/
                    $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));//判断导入表格后缀格式
                    if ($extension == 'xlsx') {
                        $objReader =\PHPExcel_IOFactory::createReader('Excel2007');
                        $objPHPExcel =$objReader->load($file_name, $encode = 'utf-8');
                    } else if ($extension == 'xls'){
                        $objReader =\PHPExcel_IOFactory::createReader('Excel5');
                        $objPHPExcel =$objReader->load($file_name, $encode = 'utf-8');
                    }
                    $sheet =$objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow();//取得总行数
                    $highestColumn =$sheet->getHighestColumn(); //取得总列数

                    Db::startTrans();
                    for ($i = 2; $i <= $highestRow; $i++) {
                        $info_data['sort'] = $objPHPExcel->getActiveSheet()->getCell("A" . $i)->getValue();
                        $info_data['company_name'] =$objPHPExcel->getActiveSheet()->getCell("B" .$i)->getValue();
                        $info_data['code'] =$objPHPExcel->getActiveSheet()->getCell("C" .$i)->getValue();
                        $info_data['register_num'] = $objPHPExcel->getActiveSheet()->getCell("D". $i)->getValue();
                        $info_data['address'] = $objPHPExcel->getActiveSheet()->getCell("E". $i)->getValue();
                        $info_data['company_phone'] = $objPHPExcel->getActiveSheet()->getCell("F". $i)->getValue();
                        $info_data['year'] = $objPHPExcel->getActiveSheet()->getCell("G". $i)->getValue();
                        $info_data['set_time'] = $objPHPExcel->getActiveSheet()->getCell("H". $i)->getValue();
                        $info_data['company_status'] = $objPHPExcel->getActiveSheet()->getCell("I". $i)->getValue()=="开业"?1:2;
                        $info_data['is_wangdian'] = $objPHPExcel->getActiveSheet()->getCell("J". $i)->getValue()=="是"?1:2;
                        $info_data['is_guquan'] = $objPHPExcel->getActiveSheet()->getCell("K". $i)->getValue()=="是"?1:2;
                        $info_data['is_tz'] = $objPHPExcel->getActiveSheet()->getCell("L". $i)->getValue()=="是"?1:2;
                        $info_data['addtime'] = time();

                        /*dump($info_data);*/


                        $info_re = Db::name('company_yearreport')->insertGetId($info_data);
                        if(!$info_re){
                            Db::rollback();
                            return false;
                        }
                    }
                    Db::commit();
                    return true;
                }else{
                    // 上传失败获取错误信息
                    echo $file->getError();
                    return false;
                }
            }else{
                return false;
            }
        } else {
            return false;
        }
    }




    public static function uploadcompanylieyi(){
        ini_set('memory_limit','1024M');
        if (!empty($_FILES)) {
            $file = request()->file('image');

            // 移动到框架应用根目录/public/uploads/ 目录下
            if($file){
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    /*// 成功上传后 获取上传信息
                    // 输出 jpg
                    echo $info->getExtension();
                    // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                    echo $info->getSaveName();
                    // 输出 42a79759f284b767dfcb2a0197904287.jpg
                    echo $info->getFilename();*/
                    vendor("PHPExcel.PHPExcel");
                    $file_name= UPLOAD_PATH.$info->getSaveName();
                    /*dump($info->getExtension());
                    dump($file_name);die;*/
                    $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));//判断导入表格后缀格式
                    if ($extension == 'xlsx') {
                        $objReader =\PHPExcel_IOFactory::createReader('Excel2007');
                        $objPHPExcel =$objReader->load($file_name, $encode = 'utf-8');
                    } else if ($extension == 'xls'){
                        $objReader =\PHPExcel_IOFactory::createReader('Excel5');
                        $objPHPExcel =$objReader->load($file_name, $encode = 'utf-8');
                    }
                    $sheet =$objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow();//取得总行数
                    $highestColumn =$sheet->getHighestColumn(); //取得总列数

                    Db::startTrans();
                    for ($i = 2; $i <= $highestRow; $i++) {
                        $info_data['company_name'] = $objPHPExcel->getActiveSheet()->getCell("A" . $i)->getValue();
                        $info_data['code'] =$objPHPExcel->getActiveSheet()->getCell("B" .$i)->getValue();
                        $info_data['register_num'] =$objPHPExcel->getActiveSheet()->getCell("C" .$i)->getValue();
                        $info_data['zc_money'] = $objPHPExcel->getActiveSheet()->getCell("D". $i)->getValue();
                        $info_data['address'] = $objPHPExcel->getActiveSheet()->getCell("E". $i)->getValue();
                        $info_data['f_name'] = $objPHPExcel->getActiveSheet()->getCell("F". $i)->getValue();
                        $info_data['dj_jigou'] = $objPHPExcel->getActiveSheet()->getCell("G". $i)->getValue();
                        $info_data['hy_menlei'] = $objPHPExcel->getActiveSheet()->getCell("H". $i)->getValue();
                        $info_data['hy_code'] = $objPHPExcel->getActiveSheet()->getCell("I". $i)->getValue();
                        $info_data['operation'] = $objPHPExcel->getActiveSheet()->getCell("J". $i)->getValue();

                        $arr = date_parse_from_format("Y年m月d日",$objPHPExcel->getActiveSheet()->getCell("K". $i)->getValue());
                        $time = mktime(0,0,0,$arr['month'],$arr['day'],$arr['year']);
                        $info_data['found_time'] = $time;


                        $info_data['ly_jigou'] = $objPHPExcel->getActiveSheet()->getCell("L". $i)->getValue();
                        $info_data['ly_reason'] = $objPHPExcel->getActiveSheet()->getCell("M". $i)->getValue();

                        $arr = date_parse_from_format("Y年m月d日",$objPHPExcel->getActiveSheet()->getCell("N". $i)->getValue());
                        $time = mktime(0,0,0,$arr['month'],$arr['day'],$arr['year']);
                        $info_data['ly_time'] = $time;

                        $info_data['addtime'] = time();

                        //dump($info_data);
                        $info_re = Db::name('company_lieyi')->insertGetId($info_data);
                        if(!$info_re){
                            Db::rollback();
                            return false;
                        }
                    }
                    //die;
                    Db::commit();
                    return true;
                }else{
                    // 上传失败获取错误信息
                    echo $file->getError();
                    return false;
                }
            }else{
                return false;
            }
        } else {
            return false;
        }
    }


    public static function UploadanjianCompany(){
        ini_set('memory_limit','1024M');
        if (!empty($_FILES)) {
            $file = request()->file('image');

            // 移动到框架应用根目录/public/uploads/ 目录下
            if($file){
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    /*// 成功上传后 获取上传信息
                    // 输出 jpg
                    echo $info->getExtension();
                    // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                    echo $info->getSaveName();
                    // 输出 42a79759f284b767dfcb2a0197904287.jpg
                    echo $info->getFilename();*/
                    vendor("PHPExcel.PHPExcel");
                    $file_name= UPLOAD_PATH.$info->getSaveName();
                    /*dump($info->getExtension());
                    dump($file_name);die;*/
                    $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));//判断导入表格后缀格式
                    if ($extension == 'xlsx') {
                        $objReader =\PHPExcel_IOFactory::createReader('Excel2007');
                        $objPHPExcel =$objReader->load($file_name, $encode = 'utf-8');
                    } else if ($extension == 'xls'){
                        $objReader =\PHPExcel_IOFactory::createReader('Excel5');
                        $objPHPExcel =$objReader->load($file_name, $encode = 'utf-8');
                    }
                    $sheet =$objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow();//取得总行数
                    $highestColumn =$sheet->getHighestColumn(); //取得总列数

                    Db::startTrans();
                    for ($i = 2; $i <= $highestRow; $i++) {
                        $info_data['aj_code'] = $objPHPExcel->getActiveSheet()->getCell("A" . $i)->getValue();
                        $info_data['aj_name'] =$objPHPExcel->getActiveSheet()->getCell("B" .$i)->getValue();
                        $info_data['dsr_name'] =$objPHPExcel->getActiveSheet()->getCell("C" .$i)->getValue();
                        $info_data['dsr_ztlb'] = $objPHPExcel->getActiveSheet()->getCell("D". $i)->getValue();


                        $timestr = $objPHPExcel->getActiveSheet()->getCell("E". $i)->getValue();
                        $year=((int)substr($timestr,0,4));//取得年份；
                        $month=((int)substr($timestr,5,2));//取得月份；
                        $day=((int)substr($timestr,8,2));//取得几号；
                        $info_data['la_time'] = mktime(0,0,0,$month,$day,$year);

                        $timestr = $objPHPExcel->getActiveSheet()->getCell("F". $i)->getValue();
                        $year=((int)substr($timestr,0,4));//取得年份；
                        $month=((int)substr($timestr,5,2));//取得月份；
                        $day=((int)substr($timestr,8,2));//取得几号；
                        $info_data['ja_time'] = mktime(0,0,0,$month,$day,$year);



                        $info_data['ba_shixian'] = $objPHPExcel->getActiveSheet()->getCell("G". $i)->getValue();
                        $info_data['aj_jieduan'] = $objPHPExcel->getActiveSheet()->getCell("H". $i)->getValue();
                        $info_data['sy_chengxu'] = $objPHPExcel->getActiveSheet()->getCell("I". $i)->getValue();
                        $info_data['la_jigou'] = $objPHPExcel->getActiveSheet()->getCell("J". $i)->getValue();
                        $info_data['ba_jigou'] = $objPHPExcel->getActiveSheet()->getCell("K". $i)->getValue();
                        $info_data['cbr1'] = $objPHPExcel->getActiveSheet()->getCell("L". $i)->getValue();
                        $info_data['cbr2'] = $objPHPExcel->getActiveSheet()->getCell("M". $i)->getValue();
                        $info_data['rkwc_time'] = $objPHPExcel->getActiveSheet()->getCell("N". $i)->getValue();
                        $info_data['bj_time'] = $objPHPExcel->getActiveSheet()->getCell("O". $i)->getValue();
                        $info_data['tk_time'] = $objPHPExcel->getActiveSheet()->getCell("P". $i)->getValue();
                        $info_data['fm_money'] = $objPHPExcel->getActiveSheet()->getCell("Q". $i)->getValue();
                        $info_data['fakuan'] = $objPHPExcel->getActiveSheet()->getCell("R". $i)->getValue();
                        $info_data['ms_money'] = $objPHPExcel->getActiveSheet()->getCell("S". $i)->getValue();
                        $info_data['bj_money'] = $objPHPExcel->getActiveSheet()->getCell("T". $i)->getValue();
                        $info_data['rk_money'] = $objPHPExcel->getActiveSheet()->getCell("U". $i)->getValue();
                        $info_data['tk_money'] = $objPHPExcel->getActiveSheet()->getCell("V". $i)->getValue();
                        $info_data['aj_bjzt'] = $objPHPExcel->getActiveSheet()->getCell("W". $i)->getValue();
                        $info_data['is_gs'] = $objPHPExcel->getActiveSheet()->getCell("X". $i)->getValue()=="是"?1:2;
                        $info_data['addtime'] = time();



                        $info_re = Db::name('company_anjian')->insertGetId($info_data);
                        if(!$info_re){
                            Db::rollback();
                            return false;
                        }
                    }

                    Db::commit();
                    return true;
                }else{
                    // 上传失败获取错误信息
                    echo $file->getError();
                    return false;
                }
            }else{
                return false;
            }
        } else {
            return false;
        }
    }
}