<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/8
 * Time: 16:36.
 */
namespace CkWechat\Core;

class Config
{
    private $_data = array();
    public function __construct($data)
    {
        $this->_data = $data;

        return $this;
    }
    public function __get($name)
    {
        if (array_key_exists($name, $this->_data)) {
            return $this->_data[$name];
        }
    }
    public function __set($name, $value)
    {
        $this->_data[$name] = $value;
    }
    public function __isset($name)
    {
        return isset($this->_data[$name]);
    }
    public function __unset($name)
    {
        unset($this->_data[$name]);
    }
}
