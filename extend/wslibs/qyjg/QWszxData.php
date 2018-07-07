<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-07-04
 * Time: 11:33
 */

namespace wslibs\qyjg;


class QWszxData
{
    const POST_URL = "http://www.wszx.cc/api.php";
    const WS_TOKEN = "2dac280a9c58ff6e70a7cd2c0849f845576946";

    private $_postdata = [];

    public function __construct($mod,$action,$postdata)
    {
        $this->_postdata['mod'] = $mod;
        $this->_postdata['action'] = $action;
        $this->_postdata['u_token'] = self::WS_TOKEN;
        $this->_postdata['json'] = 1;
        foreach ($postdata as $k => $v) {
            $this->_postdata[$k] = $v;
        }
    }

    public function getData()
    {
        return $this->PostCurl();
    }

    private function PostCurl()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::POST_URL);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_postdata);
        $data = curl_exec($ch);
        curl_close($ch);

        return unserialize($data);
    }

    public static function getComIDbyComName($c_name){
        $data = json_decode(file_get_contents("https://open.api.tianyancha.com/services/v4/open/baseinfo.json?name=".$c_name),true);
        return $data['result']['id'];
    }
}