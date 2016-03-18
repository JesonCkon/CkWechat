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
    public function __construct($url = '', $params = array())
    {
        $this->url = self::buildApiUrl($url, $params);
        $this->setCurl();
    }
    public function setUrl($url)
    {
        $this->url = $url;
    }
    public function get($post_data = null, $callback = null)
    {
        $this->curl->get($this->url, $post_data, $callback);

        return $this->curl;
    }
    public function post($post_data = null, $callback = null)
    {
        $this->curl->post($this->url, $post_data, $callback);

        return $this->curl;
    }
    public function setCurl()
    {
        $this->curl = new Curl();
    }
    public function sslPost($post_data = null, $callback = null)
    {
        $curl = new Curl();
        $curl->is_ssl = $this->config->is_ssl;
        $curl->useCert = $this->config->useCert;
        $curl->sslcert_path = $this->config->sslcert_path;
        $curl->sslkey_path = $this->config->sslkey_path;
        $curl->cainfo_path = $this->config->cainfo_path;
        $curl->post($this->url, $post_data, $callback);

        return $curl;
    }
    public static function buildApiUrl($url, $data = array())
    {
        return $url.(empty($data) ? '' : '?'.http_build_query($data));
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
