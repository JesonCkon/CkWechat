<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/8
 * Time: 16:26.
 */
namespace CkWechat\Core;
use CkWechat\Plugins\Cache;


abstract class AbstractApi
{
    protected $http;
    protected $api_url;
    protected $access_token;
    protected $di;
    public function __construct()
    {
        $args = func_get_args();
        if (count($args)>0 && ($args[0] instanceof Container)) {
            $this->di = $args[0];
            if ($this->di->config instanceof Config) {
                $this->config = $this->di->config;
            }
            if ($this->di->cache) {
                $this->cache = $this->di->cache;
            }
            if ($this->di->access_token) {
                $this->access_token = $this->di->access_token;
            }
        }
        $this->getHttp();
        $this->getApiUrl();
    }
    private function getHttp()
    {
        if (is_null($this->http)) {
            $this->http = new Http();
            $this->http->config = $this->config;
        }

        return $this->http;
    }
    private function getApiUrl()
    {
        if (is_null($this->api_url)) {
            $this->api_url = new ApiUrl();
        }

        return $this->api_url;
    }
    public function call()
    {
        $args = func_get_args();
        $function = array_shift($args);
        if (is_callable($function)) {
            array_unshift($args, $this);
            call_user_func_array($function, $args);
        }
    }
}
