<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/18
 * Time: 17:16.
 */
namespace CkWechat\Foundation;

use CkWechat\Core\AbstractApi as AbstractApi;
use CkWechat\Core\ApiUrl as ApiUrl;

class WxBackIps extends AbstractApi
{
    public $get_data;
    public $iplist = array();
    /**
     * 通过API获取 微信服务器ip列表
     * @method get
     * @return array array(0=>'ip1',1=>'ip2')
     */

    public function get()
    {
        $this->http->setUrl(ApiUrl::BACKIPS);
        $this->get_data['access_token'] = $this->di->access_token;
        $ch = $this->http->get($this->get_data, $callback);
        $json_data = json_decode($ch->rawResponse, true);
        $this->iplist = isset($json_data['ip_list']) ? $json_data['ip_list'] : '';

        return $this->iplist;
    }
    /**
     * 检验是否为合法的微信服务器ip
     * @method checkoutIps
     * @param  string      $ip need to check wechat backserver ips
     * @return boolean     true or false
     */

    public function checkoutIps($ip='')
    {
        if (empty($this->iplist)) {
            $this->get();
        }
        $is_true = array_search($ip, $this->iplist, true);
        return (boolean)$is_true;
    }
}
