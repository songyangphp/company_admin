<?php
/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2018/4/27
 * Time: 下午6:00
 */

namespace wslibs\wsform;


class GroupMoreItem extends WsForm implements Iitem
{

    private $data = array();

    function __construct(WsForm $pform, $title, $var_name, $num_var = "", $more_tip = "增加")
    {



        parent::__construct();
        if (!$num_var) {
            $num_var = $var_name . "_num";
        }

        $this->as_data = $pform->as_data;
        $this->mk_type = $pform->mk_type;
        $this->setMakeType(WsForm::Type_Form);
        $this->setInFrom($pform, $var_name);
        $this->setIsInMore();
        $this->data['title'] = $title;
        $this->data['num_var'] = $num_var;
        $this->data['more_tip'] = $more_tip;
    }

    public function isItem()
    {
        // TODO: Implement isItem() method.
        return false;
    }

    public function isGroup()
    {
        // TODO: Implement isGroup() method.
        return false;
    }

    public function isGroupMore()
    {
        // TODO: Implement isGroupMore() method.
        return true;
    }

    public function getData()
    {
        // TODO: Implement getData() method.
        return $this->data;
    }
}