<?php

namespace wslibs\wsform;

use app\common\controller\Backend;
use Exception;
use fast\Form;

use think\Lang;
use think\Log;

/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2018/4/26
 * Time: 下午1:18
 */
class WsForm
{
    protected $stubList = [];
    private $itemlist = [];

    const Type_Form = "form";
    const Type_Table = "table";
    public $as_data = array();
    public $mk_type = "form";
    public $is_in_form = false;

    public $is_in_group_more = false;

    private $group_filed_extend = "";
    private $group_filed_name_extend = "";
    private $group_filed_name_extend_pre = "";
    private $group_filed_value_extend_pre = "";
    private $is_display = false;

    private $is_has_group = false;
    private $_display_data = array();

    public function addDisplayData($name, $value = null)
    {
        if (is_array($name)) {
            $this->_display_data = $name;
        } else
            $this->_display_data[$name] = $value;
        return $this;
    }

    function __construct()
    {
        $this->setPriKey("id");
        $this->as_data['order'] = "id";
        $this->as_data['form_title'] = "请仔细填写信息";
    }

    public function setFormTitleTip($tip, $isvar = false)
    {
        $this->as_data['form_title'] = $isvar ? "\$$tip" : $tip;
        return false;
    }

    public function addItem(Iitem $item)
    {
        $this->itemlist[] = $item;
        return $this;
    }

    public function setOrder($f)
    {
        $this->as_data['order'] = $f;
        return $this;
    }

    public function setMakeType($type)
    {
        $this->mk_type = $type;
        return $this;
    }

    public function isTable()
    {
        return $this->mk_type == self::Type_Table;
    }

    public function isForm()
    {
        return $this->mk_type == self::Type_Form;
    }

    public function setPriKey($key)
    {
        $this->as_data["pk"] = $key;
        return $this;
    }

    public function setListUrl($url)
    {
        $this->as_data["list_url"] = $url;
        return $this;
    }

    public function setAddUrl($url)
    {
        $this->as_data["add_url"] = $url;
        return $this;
    }

    public function setEditUrl($url)
    {
        $this->as_data["edit_url"] = $url;
        return $this;
    }

    public function setDelUrl($url)
    {
        $this->as_data["del_url"] = $url;
        return $this;
    }

    public function setMultiUrl($url)
    {
        $this->as_data["multi_url"] = $url;
        return $this;
    }

    protected function setInFrom(WsForm $pform, $group_var_name = "")
    {
        $this->is_in_form = true;
        $this->group_filed_name_extend_pre = $pform->getFiledNameExtendPre();
        $this->group_filed_value_extend_pre = $pform->getFiledValueExtendPre();
        if ($group_var_name) {
            $this->group_filed_name_extend_pre = $this->group_filed_name_extend_pre . "[" . $group_var_name . "]";
            $this->group_filed_value_extend_pre = $this->group_filed_value_extend_pre . "." . $group_var_name;
        }
        return $this;
    }

    public function getFiledNameExtendPre()
    {
        return $this->group_filed_name_extend_pre;
    }

    public function getFiledValueExtendPre()
    {
        return $this->group_filed_value_extend_pre;
    }

    protected function setIsInMore()
    {
        if (!$this->is_in_form) {
            echo "groupMore Must after InFrom()";
            exit;
        }
        $this->is_in_group_more = true;
        $this->group_filed_name_extend =   "[]";
        $this->group_filed_extend =   "[\$__index]";


        return $this;
    }


    public function display(Backend $controller)
    {
        $controller->use_action_js("form", "wsform", "wscommon");
        $this->is_display = true;
        $content = $this->makeForm();
     //   var_dump($content);

        foreach ($this->_display_data as $key=>$value)
        {

            $controller->assign($key,$value);
        }

        return $controller->display($content);
    }

    public function makeForm($tpl = "", $app = "admin")
    {


        $addList = [];
        $editList = [];
        $javascriptList = [];
        $priKey = isset($this->as_data['pk']) ? $this->as_data['pk'] : "id";
        $order = isset($this->as_data['order']) ? $this->as_data['order'] : $priKey;

        try {
            Form::setEscapeHtml(false);

            $appendAttrList = [];


            if (!$this->is_in_form) {
                $hasgroup = false;
                foreach ($this->itemlist as $value) {
                    if ($value->isGroup() || $value->isGroupMore()) {
                        $hasgroup = true;
                    }
                }
                if ($hasgroup) {

                    $tmplist = $this->itemlist;
                    $this->itemlist = array();
                    $newGroup = null;
                    $newGroup_key = null;
                    foreach ($tmplist as $value) {
                        if ($value->isGroup() || $value->isGroupMore()) {
                            $this->itemlist[] = $value;
                        } else {
                            if (!$newGroup) {
                                $newGroup = new GroupItem($this, "请填写资料", "");
                                $newGroup->addItem($value);
                                if ($newGroup_key === null) {
                                    $newGroup_key = count($this->itemlist);
                                }
                                $this->itemlist[] = $newGroup;
                            } else {
                                $this->itemlist[$newGroup_key]->addItem($value);
                            }

                        }
                    }
                }
            }


//            $columnList = array(
//
//                array("required" => 1, "inputType" => "select", "COLUMN_DEFAULT" => 1, 'COLUMN_NAME' => 'category_id', 'COLUMN_TITLE' => "类别", "DATA_TYPE" => "enum", "itemArrValName" => "namelist" ,"itemArr"=>[])
//                , array("required" => 1, "inputType" => "radio", "COLUMN_DEFAULT" => 1, 'COLUMN_NAME' => 'tadeid', 'COLUMN_TITLE' => "类别22", "DATA_TYPE" => "enum", "itemArrValName" => "namelist", "itemArr" => array(0 => "男", "1" => "女"))
//            ,   array("required" => 1, "inputType" => "number", "COLUMN_DEFAULT" => 1, 'COLUMN_NAME' => 'tadeidasdf', 'COLUMN_TITLE' => "类dddd别22", "DATA_TYPE" => "enum", "itemArrValName" => "namelist", "itemArr" => [])
//            );
            ;

            // \think\Log::write($columnList,'notice');

            //循环所有字段,开始构造视图的HTML和JS信息
            foreach ($this->itemlist as $k => $v) {


                if ($v->isItem()) {


                    $field = $v['COLUMN_NAME'];
                    $itemArr = $v['itemArr'];

                    // 语言列表


                    $inputType = $v['inputType'];

                    // 如果是number类型时增加一个步长
                    $step = $inputType == 'number' ? "1" : 0;

                    $attrArr = ['id' => "c-{$field}"];
                    $cssClassArr = ['form-control'];
                    $fieldName = "row{$this->group_filed_name_extend_pre}[{$field}]{$this->group_filed_name_extend}";
                    $defaultValue = $v['COLUMN_DEFAULT'];
                    $editValue = "{\$row{$this->group_filed_value_extend_pre}.{$field}{$this->group_filed_extend}}";
                    // 如果默认值非null,则是一个必选项
                    if ($v['required']) {
                        $attrArr['data-rule'] = 'required';
                    }

                    if ($inputType == 'select') {
                        $cssClassArr[] = 'selectpicker';
                        $attrArr['class'] = implode(' ', $cssClassArr);
                        if ($v['DATA_TYPE'] == 'set') {
                            $attrArr['multiple'] = '';
                            $fieldName .= "[]";
                        }
                        $attrArr['name'] = $fieldName;

                        // $this->getEnum($getEnumArr, $controllerAssignList, $field, $itemArr, $v['DATA_TYPE'] == 'set' ? 'multiple' : 'select');

//                    $itemArr = $this->getLangArray($itemArr, FALSE);
//                    //添加一个获取器
//                    $this->getAttr($getAttrArr, $field, $v['DATA_TYPE'] == 'set' ? 'multiple' : 'select');
//                    if ($v['DATA_TYPE'] == 'set') {
//                        $this->setAttr($setAttrArr, $field, $inputType);
//                    }
                        $this->appendAttr($appendAttrList, $field);
                        $formAddElement = $this->mkViewField($v) . $this->getReplacedStub('html/select', ['field' => $field, 'fieldName' => $fieldName, 'fieldList' => $this->getFieldListName($v['itemArrValName']), 'attrStr' => Form::attributes($attrArr), 'selectedValue' => $defaultValue]);
                        $formEditElement = $this->mkViewField($v) . $this->getReplacedStub('html/select', ['field' => $field, 'fieldName' => $fieldName, 'fieldList' => $this->getFieldListName($v['itemArrValName']), 'attrStr' => Form::attributes($attrArr), 'selectedValue' => "\$row{$this->group_filed_value_extend_pre}.{$field}{$this->group_filed_extend}"]);


                    } else if ($inputType == 'datetime') {
                        $cssClassArr[] = 'datetimepicker';
                        $attrArr['class'] = implode(' ', $cssClassArr);
                        $format = "YYYY-MM-DD HH:mm:ss";
                        $phpFormat = "Y-m-d H:i:s";
                        $fieldFunc = '';
                        switch ($v['DATA_TYPE']) {
                            case 'year';
                                $format = "YYYY";
                                $phpFormat = 'Y';
                                break;
                            case 'date';
                                $format = "YYYY-MM-DD";
                                $phpFormat = 'Y-m-d';
                                break;
                            case 'time';
                                $format = "HH:mm:ss";
                                $phpFormat = 'H:i:s';
                                break;
                            case 'timestamp';
                                $fieldFunc = 'datetime';

                            case 'datetime';
                                $format = "YYYY-MM-DD HH:mm:ss";
                                $phpFormat = 'Y-m-d H:i:s';
                                break;
                            default:
                                $fieldFunc = 'datetime';

                                $this->appendAttr($appendAttrList, $field);
                                break;
                        }

                     
                        $defaultDateTime = "{:date('{$phpFormat}')}";

                        $attrArr['data-date-format'] = $format;
                        $attrArr['data-use-current'] = "true";
                        $fieldFunc = $fieldFunc ? "|{$fieldFunc}" : "";
                        $formAddElement = Form::text($fieldName, $defaultDateTime, $attrArr);
                        $formEditElement = Form::text($fieldName, "{\$row{$this->group_filed_value_extend_pre}.{$field}{$this->group_filed_extend}{$fieldFunc}}", $attrArr);


                    } else if ($inputType == 'checkbox' || $inputType == 'radio') {
                        unset($attrArr['data-rule']);
                        $fieldName = $inputType == 'checkbox' ? $fieldName .= "[]" : $fieldName;
                        $attrArr['name'] = "row[{$fieldName}]";


                        $this->appendAttr($appendAttrList, $field);
                        $defaultValue = $inputType == 'radio' && !$defaultValue ? key($itemArr) : $defaultValue;

                        $formAddElement = $this->mkViewField($v) . $this->getReplacedStub('html/' . $inputType, ['field' => $field, 'fieldName' => $fieldName, 'fieldList' => $this->getFieldListName($v['itemArrValName']), 'attrStr' => Form::attributes($attrArr), 'selectedValue' => $defaultValue]);
                        $formEditElement = $this->mkViewField($v) . $this->getReplacedStub('html/' . $inputType, ['field' => $field, 'fieldName' => $fieldName, 'fieldList' => $this->getFieldListName($v['itemArrValName']), 'attrStr' => Form::attributes($attrArr), 'selectedValue' => "\$row{$this->group_filed_value_extend_pre}.{$field}{$this->group_filed_extend}"]);
                    } else if ($inputType == 'textarea' || $inputType == 'content') {
                        $cssClassArr[] = $inputType == 'content' ? "editor" : '';
                        $inputType = "textarea";
                        $attrArr['class'] = implode(' ', $cssClassArr);
                        $attrArr['rows'] = 5;
                        $formAddElement = Form::textarea($fieldName, $defaultValue, $attrArr);
                        $formEditElement = Form::textarea($fieldName, $editValue, $attrArr);
                    } else if ($inputType == 'switch') {
                        unset($attrArr['data-rule']);
                        if ($defaultValue === '1' || $defaultValue === 'Y') {
                            $yes = $defaultValue;
                            $no = $defaultValue === '1' ? '0' : 'N';
                        } else {
                            $no = $defaultValue;
                            $yes = $defaultValue === '0' ? '1' : 'Y';
                        }
                        $formAddElement = $formEditElement = Form::hidden($fieldName, $no, array_merge(['checked' => ''], $attrArr));
                        $attrArr['id'] = $fieldName . "-switch";
                        $formAddElement .= sprintf(Form::label("{$attrArr['id']}", "%s {:__('Yes')}", ['class' => 'control-label']), Form::checkbox($fieldName, $yes, $defaultValue === $yes, $attrArr));
                        $formEditElement .= sprintf(Form::label("{$attrArr['id']}", "%s {:__('Yes')}", ['class' => 'control-label']), Form::checkbox($fieldName, $yes, 0, $attrArr));
                        $formEditElement = str_replace('type="checkbox"', 'type="checkbox" {in name="' . "\$row{$this->group_filed_value_extend_pre}.{$field}{$this->group_filed_extend}" . '" value="' . $yes . '"}checked{/in}', $formEditElement);
                    } else if ($inputType == 'citypicker') {
                        $attrArr['class'] = implode(' ', $cssClassArr);
                        $attrArr['data-toggle'] = "city-picker";
                        $formAddElement = sprintf("<div class='control-relative'>%s</div>", Form::input('text', $fieldName, $defaultValue, $attrArr));
                        $formEditElement = sprintf("<div class='control-relative'>%s</div>", Form::input('text', $fieldName, $editValue, $attrArr));
                    } else {
                        $search = $replace = '';

                        //因为有自动完成可输入其它内容
                        $step = array_intersect($cssClassArr, ['selectpage']) ? 0 : $step;
                        $attrArr['class'] = implode(' ', $cssClassArr);
                        $isUpload = false;
                        if ($v['isUpload']) {
                            $isUpload = true;
                        }
                        //如果是步长则加上步长
                        if ($step) {
                            $attrArr['step'] = $step;
                        }
                        //如果是图片加上个size
                        if ($isUpload) {
                            $attrArr['size'] = 50;
                        }
                        $weiyi = uniqid().random_int(1,10000);
                        $attrArr['id'] =  $attrArr['id'] .$weiyi;

                        $formAddElement = Form::input($inputType, $fieldName, $defaultValue, $attrArr);
                        $formEditElement = Form::input($inputType, $fieldName, $editValue, $attrArr);

                        if ($search && $replace) {
                            $formAddElement = str_replace($search, $replace, $formAddElement);
                            $formEditElement = str_replace($search, $replace, $formEditElement);
                        }

                        //如果是图片或文件
                        if ($isUpload) {
                            $formAddElement = $formAddElement.Form::input("hidden", str_replace("[{$field}]","[{$field}_id]",$fieldName), 0, array("id"=>$attrArr['id']."_id"));
                            $formEditElement = $formEditElement.Form::input("hidden", str_replace("[{$field}]","[{$field}_id]",$fieldName), str_replace(".{$field}",".{$field}_id",$editValue), array("id"=>$attrArr['id']."_id"));
                            $formAddElement = $this->getImageUpload($v, $formAddElement,$weiyi);
                            $formEditElement = $this->getImageUpload($v, $formEditElement,$weiyi);
                        }
                    }


                    //构造添加和编辑HTML信息
                    $addList[] = $this->getFormGroup($v, $formAddElement);

                    $editList[] = $this->getFormGroup($v, $formEditElement);


                    //过滤text类型字段
                    if (isset($this->as_data['pk']) && ($v['COLUMN_NAME'] == $this->as_data['pk'])) {

                        $javascriptList[] = "{checkbox: true}";
                    }

                    //构造JS列信息
                    $javascriptList[] = $this->getJsColumn($v, $v['DATA_TYPE'], $inputType && in_array($inputType, ['select', 'checkbox', 'radio']) ? '_text' : '', $itemArr);


                } else if ($v->isGroup()) {

                    $htmls = $v->makeForm();
                    $editList[] = $this->getReplacedStub('html/group', array_merge(["items" => $htmls], $v->getData()));
                    $this->is_has_group = true;
                } else if ($v->isGroupMore()) {
                    $htmls = $v->makeForm();
                    //var_dump($htmls[0]);
                    $this->is_has_group = true;
                    $editList[] = $tmp = $this->getReplacedStub('html/groupmore', array_merge(["items" => $htmls[0], "additem" => $htmls[1]], $v->getData()));


                }

            }


            //JS最后一列加上操作列
            $javascriptList[] = str_repeat(" ", 24) . "{field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}";


            $addList = implode("\n", array_filter($addList));

            $editList = implode("\n", array_filter($editList));
            $javascriptList = implode(",\n", array_filter($javascriptList));


            $data = [

                "controllerUrl" => $tpl,
                'addList' => $addList,
                'editList' => $editList,
                'javascriptList' => $javascriptList,

                'appendAttrList' => implode(",\n", $appendAttrList),


            ];


            if ($this->is_in_form) {


                if ($this->is_in_group_more)
                    return [$data['editList'], $data['addList']];
                else {
                    return $data['editList'];
                }
            }
            foreach ($this->as_data as $a_k => $as_datum) {
                $data[$a_k] = $as_datum;
            }

            // Log::write(($data), "notice");

            if ($tpl) {
                $file = APP_PATH . $app . DS . "view" . DS . $tpl . ".html";
                $javascriptFile = ROOT_PATH . 'public' . DS . 'assets' . DS . 'js' . DS . 'backend' . DS . $tpl . '.js';
            } else {
                $file = null;
                $javascriptFile = null;
            }
            if ($javascriptFile) {
                $this->writeToFile('javascript_' . ($this->isForm() ? "wsfrom" : "table"), $data, $javascriptFile);
            }


            return $this->writeToFile($this->isForm() ? ($this->is_has_group ? "wsedit" : 'edit') : "index_table", $data, $file);


        } catch (\think\exception\ErrorException $e) {
            throw new Exception("Code: " . $e->getCode() . "\nLine: " . $e->getLine() . "\nMessage: " . $e->getMessage() . "\nFile: " . $e->getFile());
        }

    }


    protected function getLangItem($field_array)
    {
        $field = $field_array['COLUMN_NAME'];

        if (!Lang::has($field)) {

            $itemArr = [$field => $field_array['COLUMN_TITLE']];


            foreach ($field_array['itemArr'] as $k => $v) {
                $valArr = explode('=', $v);
                if (count($valArr) == 2) {
                    list($key, $value) = $valArr;
                    $itemArr[$field . ' ' . $key] = $value;
                }
            }

            $resultArr = [];
            foreach ($itemArr as $k => $v) {
                $resultArr[] = "    '" . mb_ucfirst($k) . "'  =>  '{$v}'";
            }
            return implode(",\n", $resultArr);
        } else {
            return '';
        }
    }

    /**
     * 判断是否符合指定后缀
     * @param string $field 字段名称
     * @param mixed $suffixArr 后缀
     * @return boolean
     */
    protected function isMatchSuffix($field, $suffixArr)
    {
        $suffixArr = is_array($suffixArr) ? $suffixArr : explode(',', $suffixArr);
        foreach ($suffixArr as $k => $v) {
            if (preg_match("/{$v}$/i", $field)) {
                return true;
            }
        }
        return false;
    }

    protected function getFieldType(& $v)
    {
        $inputType = 'text';
        switch ($v['DATA_TYPE']) {
            case 'bigint':
            case 'int':
            case 'mediumint':
            case 'smallint':
            case 'tinyint':
            case 'number':
                $inputType = 'number';
                break;
            case 'enum':
            case 'set':
            case 'select':
                $inputType = 'select';
                break;
            case 'decimal':
            case 'double':
            case 'float':
                $inputType = 'number';
                break;
            case 'longtext':
            case 'text':
            case 'mediumtext':
            case 'smalltext':
            case 'tinytext':
            case 'textarea':
                $inputType = 'textarea';
                break;
            case 'year';
            case 'date';
            case 'time';
            case 'datetime';
            case 'timestamp';
                $inputType = 'datetime';
                break;
            default:
                break;
        }


        $inputType = "radio";


        $inputType = "checkbox";

        $inputType = "switch";

        return $inputType;
    }

    /**
     * 读取数据和语言数组列表
     * @param array $arr
     * @param boolean $withTpl
     * @return array
     */
    protected function getLangArray($arr, $withTpl = TRUE)
    {
        $langArr = [];
        foreach ($arr as $k => $v) {
            $langArr[$k] = is_numeric($k) ? ($withTpl ? "{:" : "") . "__('" . mb_ucfirst($v) . "')" . ($withTpl ? "}" : "") : $v;
        }
        return $langArr;
    }

    protected function getCamelizeName($uncamelized_words, $separator = '_')
    {
        $uncamelized_words = $separator . str_replace($separator, " ", strtolower($uncamelized_words));
        return ltrim(str_replace(" ", "", ucwords($uncamelized_words)), $separator);
    }

    protected function getFieldListName($field)
    {
        return "\$" . $field;
    }

    protected function appendAttr(&$appendAttrList, $field)
    {
        $appendAttrList[] = <<<EOD
        '{$field}_text'
EOD;
    }


    private function mkViewVar($name, $value)
    {
        $v_string = is_array($value) ? json_encode($value, true) : "\"$value\"";

        return "<?php  $" . $name . "=  json_decode('$v_string',true);   ?>";
    }

    private function mkViewField($v)
    {
        if (!$v['itemArr']) {
            return "";
        } else {


            return $this->mkViewVar($v['itemArrValName'], $v['itemArr']);
        }

    }


    /**
     * 获取替换后的数据
     * @param string $name
     * @param array $data
     * @return string
     */
    protected function getReplacedStub($name, $data)
    {
        foreach ($data as $index => &$datum) {
            $datum = is_array($datum) ? '' : $datum;
        }
        unset($datum);
        $search = $replace = [];
        foreach ($data as $k => $v) {
            $search[] = "{%{$k}%}";
            $replace[] = $v;
        }
        $stubname = $this->getStub($name);
        if (isset($this->stubList[$stubname])) {
            $stub = $this->stubList[$stubname];
        } else {
            $this->stubList[$stubname] = $stub = file_get_contents($stubname);
        }


        $content = str_replace($search, $replace, $stub);
        return $content;
    }

    protected function getImageUpload($v, $content,$weiyi)
    {
        $field = $v['COLUMN_NAME'];

        $uploadfilter = $selectfilter = '';
        if ($v['isUpload'] == 1) {
            $uploadfilter = ' data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp"';
            $selectfilter = ' data-mimetype="image/*"';
        }
        $multiple = substr($field, -1) == 's' ? ' data-multiple="true"' : ' data-multiple="false"';
        $preview = $uploadfilter ? ' data-preview-id="p-' . $field . '"' : '';
        $previewcontainer = $preview ? '<ul class="row list-inline plupload-preview" id="p-' . $field . '"></ul>' : '';
        return <<<EOD
<div class="input-group">
                {$content}
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button" id="plupload-{$field}{$weiyi}" class="btn btn-danger plupload" data-input-id="c-{$field}{$weiyi}"{$uploadfilter}{$multiple}{$preview}><i class="fa fa-upload"></i> {:__('Upload')}</button></span>
                    <span><button type="button" id="fachoose-{$field}{$weiyi}" class="btn btn-primary fachoose" data-input-id="c-{$field}{$weiyi}"{$selectfilter}{$multiple}><i class="fa fa-list"></i> {:__('Choose')}</button></span>
                </div>
                <span class="msg-box n-right" for="c-{$field}"></span>
            </div>
            {$previewcontainer}
EOD;
    }

    /**
     * 获取基础模板
     * @param string $name
     * @return string
     */
    protected function getStub($name)
    {
        return APP_PATH . "admin" . DS . "command" . DS . 'Crud' . DS . 'stubs' . DS . $name . '.stub';
    }


    /**
     * 获取表单分组数据
     * @param string $field
     * @param string $content
     * @return string
     */
    protected function getFormGroup($v, $content)
    {
        $field = $v['COLUMN_NAME'];
        $langField = mb_ucfirst($field);
        return <<<EOD
    <div class="form-group">
        <label for="c-{$field}" class="control-label col-xs-12 col-sm-2">{$v['COLUMN_TITLE']}:</label>
        <div class="col-xs-12 col-sm-8">
            {$content}
        </div>
    </div>
EOD;
    }


    protected $fieldFormatterSuffix = [
        'status' => ['type' => ['varchar'], 'name' => 'status'],
        'icon' => 'icon',
        'flag' => 'flag',
        'url' => 'url',
        'image' => 'image',
        'images' => 'images',
        'time' => ['type' => ['int', 'timestamp'], 'name' => 'datetime']
    ];

    /**
     * 获取JS列数据
     * @param string $field
     * @param string $datatype
     * @param string $extend
     * @param array $itemArr
     * @return string
     */
    protected function getJsColumn($f, $datatype = '', $extend = '', $itemArr = [])
    {
        $field = $f['COLUMN_NAME'];
        $lang = mb_ucfirst($field);
        $formatter = '';
        foreach ($this->fieldFormatterSuffix as $k => $v) {
            if (preg_match("/{$k}$/i", $field)) {
                if (is_array($v)) {
                    if (in_array($datatype, $v['type'])) {
                        $formatter = $v['name'];
                        break;
                    }
                } else {
                    $formatter = $v;
                    break;
                }
            }
        }
        if ($formatter) {
            $extend = '';
        }
        $html = str_repeat(" ", 24) . "{field: '{$field}{$extend}', title: '{$f['COLUMN_TITLE']}' ";
        //$formatter = $extend ? '' : $formatter;
        if ($extend) {
            $html .= ", operate:false";
            if ($datatype == 'set') {
                $formatter = 'label';
            }
        }
        foreach ($itemArr as $k => &$v) {
//            if (substr($v, 0, 3) !== '__(')
//                $v = "'" . $v . "'";
        }
        unset($v);
        $searchList = json_encode($itemArr, JSON_FORCE_OBJECT);
        //$searchList = str_replace(['":"', '"}', ')","'], ['":', '}', '),"'], $searchList);
        if ($itemArr && !$extend) {
            $html .= ", searchList: " . $searchList;
        }
        if (in_array($datatype, ['date', 'datetime']) || $formatter === 'datetime') {
            $html .= ", operate:'RANGE', addclass:'datetimerange'";
        } else if (in_array($datatype, ['float', 'double', 'decimal'])) {
            $html .= ", operate:'BETWEEN'";
        }
        if ($formatter)
            $html .= ", formatter: Table.api.formatter." . $formatter . "}";
        else
            $html .= "}";
        if ($extend) {
            $origin = str_repeat(" ", 24) . "{field: '{$field}', title: '{$f['COLUMN_TITLE']}', visible:false";
            if ($searchList) {
                $origin .= ", searchList: " . $searchList;
            }
            $origin .= "}";
            $html = $origin . ",\n" . $html;
        }
        return $html;
    }


    /**
     * 写入到文件
     * @param string $name
     * @param array $data
     * @param string $pathname
     * @return mixed
     */
    protected function writeToFile($name, $data, $pathname = null)
    {
        foreach ($data as $index => &$datum) {
            $datum = is_array($datum) ? '' : $datum;
        }
        unset($datum);
        $content = $this->getReplacedStub($name, $data);


        if ($pathname = strtolower($pathname)) {
            if (!is_dir(dirname($pathname))) {
                mkdir(dirname($pathname), 0755, true);

            }
            return file_put_contents($pathname, $content);

        } else return ($this->is_display ? "" : "{__NOLAYOUT__}") . $content;
    }
}