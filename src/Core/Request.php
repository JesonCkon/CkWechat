<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/8
 * Time: 23:00.
 */
namespace CkWechat\Core;

class Request
{
    private $_rawBody;
    private $_headers;
    private $_method;
    private $_userIp;
    private $_postData;
    private $_isTranslator = false;
    public $_methodParam = '_method';

    public function getPostData()
    {
        return $this->_postData;
    }
    public function getParams($value = '')
    {
        if (is_string($value)) {
            return isset($_GET[$value]) ? $_GET[$value] : null;
        } elseif (is_array($value)) {
            return array_intersect_key($_GET, array_flip($value));
        } else {
            return;
        }
    }
    /**
     * [postParams description]
     * @method postParams
     * @param  string     $value post_data key
     * @return string/array     返回对应键值的数据  字符串或者数组
     */

    public function postParams($value = '')
    {
        $result = null;
        if (is_string($value)) {
            $result = isset($_POST[$value]) ? $_POST[$value] : null;
        } elseif (is_array($value)) {
            $result = array_intersect_key($_POST, array_flip($value));
        }
        if ($this->_isTranslator == true && empty($result)) {
            if (is_string($value)) {
                $result = isset($this->_postData[$value]) ? $this->_postData[$value] : null;
            } elseif (is_array($value)) {
                $result = array_intersect_key($this->_postData, array_flip($value));
            }
        }

        return $result;
    }
    public function __construct()
    {
        $this->_method = self::getMethod();
        $this->_headers = self::getMethod();
        $this->_rawBody = self::getRawBody();
        $this->dataTranslator();
        $this->_userIp = self::getUserIP();
    }
    public function dataTranslator()
    {
        $is_json = DataBase::checkJson($this->_rawBody);
        if ($is_json == false) {
            $is_xml = DataBase::xmlToArray($this->_rawBody);
            if ($is_xml == false) {
                return;
            }
            $this->_postData = $is_xml;
        } else {
            $this->_postData = $is_json;
        }
        $this->_isTranslator = true;
    }
    private static function getMethod()
    {
        if (isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'])) {
            return strtoupper($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']);
        }

        if (isset($_SERVER['REQUEST_METHOD'])) {
            return strtoupper($_SERVER['REQUEST_METHOD']);
        }

        return 'GET';
    }
    private static function getallheaders()
    {
        foreach ($_SERVER as $K => $V) {
            $a = explode('_', $K);
            if (array_shift($a) == 'HTTP') {
                array_walk($a, function (&$v) {$v = ucfirst(strtolower($v));});
                $retval[implode('-', $a)] = $V;
            }
        }

        return $retval;
    }
    private static function getRawBody()
    {
        return file_get_contents('php://input');
    }

    private static function getUserIP()
    {
        return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null;
    }
}
