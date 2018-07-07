<?php
/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2018/4/27
 * Time: ÏÂÎç6:00
 */

namespace wslibs\wsform;


class GroupItem extends WsForm implements Iitem
{
    private $data;

    function __construct(WsForm $pform,$title,$varname="")
    {

        parent::__construct();
        $this->as_data = $pform->as_data;
        $this->setMakeType(WsForm::Type_Form);
        $this->setInFrom($pform,$varname);
        $this->data['title']=$title;


    }

    public function isItem()
    {
        // TODO: Implement isItem() method.
        return false;
    }

    public function isGroup()
    {
        // TODO: Implement isGroup() method.
        return true;
    }

    public function isGroupMore()
    {
        // TODO: Implement isGroupMore() method.
        return false;
    }

    public function getData()
    {
        // TODO: Implement getData() method.
        return $this->data;
    }
}