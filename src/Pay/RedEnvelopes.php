<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/15
 * Time: 15:37.
 */
namespace CkWechat\Pay;

use CkWechat\Core\AbstractApi as AbstractApi;
use CkWechat\Core\ApiUrl as ApiUrl;
use CkWechat\Core\DataBase as DataBase;

class RedEnvelopes extends AbstractApi
{
    protected $send_data = array();
    public function send(array $post_data, $callback = null)
    {
        $this->http->setUrl(ApiUrl::REDENVELOPES_SEND);
        $this->makeSendData($post_data);
        $xml = DataBase::toXml($this->send_data);
        return $this->http->sslPost($xml, $callback);
    }

    public function makeSendData(array $params)
    {
        $this->send_data = array_merge($this->send_data, $params);
        $this->send_data['wxappid'] = $this->config->app_id;
        $this->send_data['mch_id'] = $this->config->mch_id;
        $this->send_data['mch_billno'] = $this->buildBillno();
        $this->send_data['sign'] = DataBase::wxMakeSign($this->send_data, $this->config->mch_key);
    }
    //商户订单号（每个订单号必须唯一） 组成：mch_id+yyyymmdd+10位一天内不能重复的数字。接口根据商户订单号支持重入，如出现超时可再调用。
    public function buildBillno()
    {
        return $this->config->mch_id.date('Ymd', time()).rand(1000000000, 9999999999);
    }
}
