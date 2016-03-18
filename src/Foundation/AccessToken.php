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
    public function get($callback = null)
    {
        echo getcwd();
        $this->http->setUrl(ApiUrl::ACCESSTOKEN);
        $this->makeTokenData();
        return $this->http->get($this->get_data, $callback);
    }
    public function makeTokenData()
    {
        $this->get_data['grant_type'] = 'client_credential';
        $this->get_data['appid'] = $this->config->app_id;
        $this->get_data['secret'] = $this->config->secret;
    }
}
