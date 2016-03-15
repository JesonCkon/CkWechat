<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/8
 * Time: 16:59.
 */

namespace CkWechat\Core;

class Http
{
    public $url;
    public $config;
    public function __construct($url='', $params = array())
    {
        $this->url = self::buildApiUrl($url, $params);
    }
    public function get()
    {
        # code...
    }
    public function post($post_data = null)
    {
        
    }
    public static function buildApiUrl($url, $data = array())
    {
        return $url . (empty($data) ? '' : '?' . http_build_query($data));
    }
    public static function http_build_multi_query($data, $key = null)
    {
        $query = array();
        if (empty($data)) {
            return $key.'=';
        }
        $is_array_assoc = self::is_array_assoc($data);
        foreach ($data as $k => $value) {
            if (is_string($value) || is_numeric($value)) {
                $brackets = $is_array_assoc ? '['.$k.']' : '[]';
                $query[] = urlencode($key === null ? $k : $key.$brackets).'='.rawurlencode($value);
            } elseif (is_array($value)) {
                $nested = $key === null ? $k : $key.'['.$k.']';
                $query[] = self::http_build_multi_query($value, $nested);
            }
        }

        return implode('&', $query);
    }
    public static function is_array_assoc($array)
    {
        return (bool) count(array_filter(array_keys($array), 'is_string'));
    }
}
