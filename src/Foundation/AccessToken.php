<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/18
 * Time: 11:57.
 */
namespace CkWechat\Foundation;

use CkWechat\Core\AbstractApi as AbstractApi;
use CkWechat\Core\ApiUrl as ApiUrl;

class AccessToken extends AbstractApi
{
    protected $get_data = array();
    protected $cache_key = '';
    public $access_token = '';
    public function get($callback = null)
    {
        $access_token = '';
        $this->makeCacheKey();
        $is_cache = $this->cache->get($this->cache_key);
        if ($is_cache == false) {
            $access_token = $this->getToken();
            $this->cache->set($this->cache_key, $access_token);

            return $access_token;
        }
        return $is_cache;
    }
    private function getToken()
    {
        $this->http->setUrl(ApiUrl::ACCESSTOKEN);
        $this->makeTokenData();
        $ch = $this->http->get($this->get_data, $callback);
        $json_data = json_decode($ch->rawResponse, true);

        return isset($json_data['access_token']) ? $json_data['access_token'] : '';
    }
    private function makeCacheKey()
    {
        $this->cache_key = md5($this->config->app_id.$this->config->secret);
    }
    private function makeTokenData()
    {
        $this->get_data['grant_type'] = 'client_credential';
        $this->get_data['appid'] = $this->config->app_id;
        $this->get_data['secret'] = $this->config->secret;
    }
}
