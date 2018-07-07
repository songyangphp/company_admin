<?php
/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2018/4/26
 * Time: ÏÂÎç1:37
 */

namespace wslibs\wsform;


class Item implements \ArrayAccess,Iitem
{
    private $data;

    public function __construct()
    {
        $this->data = array("required" => 0, "inputType" => "", "COLUMN_DEFAULT" => "", 'COLUMN_NAME' => '', 'COLUMN_TITLE' => "", "DATA_TYPE" => "text", "itemArrValName" => "", "itemArr" => [],"isUpload"=>0);

    }


    public function required($is = true)
    {
        if ($is) {
            $this->data['required'] = 1;
        }
        return $this;
    }
    public function isUploadImg($is = true)
    {
        if ($is) {
            $this->data['isUpload'] = 1;

        }else{
            $this->data['isUpload'] = 0;
        }
        return $this;
    }
    public function isUploadFile($is = true)
    {
        if ($is) {
            $this->data['isUpload'] = 2;
        }else{
            $this->data['isUpload'] = 0;
        }
        return $this;
    }
    public function inputType($type = InputType::text)
    {

        $this->data['inputType'] = $type;

        return $this;
    }

    public function defaultValue($v)
    {

        $this->data['COLUMN_DEFAULT'] = $v;

        return $this;
    }

    public function varName($v)
    {

        $this->data['COLUMN_NAME'] = $v;

        return $this;
    }

    public function varTitle($v)
    {

        $this->data['COLUMN_TITLE'] = $v;

        return $this;
    }

    public function varType($v)
    {

        $this->data['DATA_TYPE'] = $v;

        return $this;
    }

    public function itemArrValName($v)
    {

        $this->data['itemArrValName'] = $v;

        return $this;
    }

    public function itemArr($v)
    {

        $this->data['itemArr'] = $v;

        return $this;
    }

    /**
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        // TODO: Implement offsetGet() method.
        if($offset==="itemArrValName")
        {
            if(!$this->data[$offset])
            {
                return $this->data["COLUMN_NAME"]."list";
            }
        }
        return $this->data[$offset];
    }

    /**
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    /**
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        // TODO: Implement offsetUnset() method.
        unset($this->data[$offset]);
    }

    public function isItem()
    {
        // TODO: Implement isItem() method.
        return true;
    }

    public function isGroup()
    {
        // TODO: Implement isGroup() method.
        return false;
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