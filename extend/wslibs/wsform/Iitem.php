<?php
/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2018/4/27
 * Time: обнГ5:34
 */

namespace wslibs\wsform;


interface Iitem
{
    public function isItem();
    public function isGroup();
    public function isGroupMore();
    public function getData();
}
