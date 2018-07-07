<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-06-28
 * Time: 9:59
 */

namespace app\admin\controller;
use app\common\controller\Backend;
use wslibs\qyjg\QDataupload;


class Dataupload extends Backend
{
    public function companyindex(){
        return $this->fetch();
    }

    public function companyupload(){
        if(!QDataupload::UploadCompany()){
            $this->error("上传失败");
        }else{
            $this->success("上传成功");
        }
    }


    public function companyyearindex(){
        return $this->fetch();
    }

    public function companyyearupload(){
        if(!QDataupload::uploadcompanyyear()){
            $this->error("上传失败");
        }else{
            $this->success("上传成功");
        }
    }

    public function companylieyiindex(){
        return $this->fetch();
    }

    public function companylieyiupload(){
        if(!QDataupload::uploadcompanylieyi()){
            $this->error("上传失败");
        }else{
            $this->success("上传成功");
        }
    }

    public function companyanjianindex(){
        return $this->fetch();
    }

    public function companyanjianupload(){
        if(!QDataupload::UploadanjianCompany()){
            $this->error("上传失败");
        }else{
            $this->success("上传成功");
        }
    }
}