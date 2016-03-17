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
    protected $send_xml = "";
    protected $query_data = array();
    protected $query_xml = "";
    public function send(array $post_data, $callback = null)
    {
        $this->http->setUrl(ApiUrl::REDENVELOPES_SEND);
        $this->makeSendData($post_data);
        $this->send_xml = DataBase::toXml($this->send_data);
        return $this->http->sslPost($this->send_xml, $callback);
    }
    public function query(array $post_data, $callback = null)
    {
        $this->http->setUrl(ApiUrl::REDENVELOPES_QUERY);
        $this->makeQueryData($post_data);
        $this->send_xml = DataBase::toXml($this->query_data);
        $this->query_xml = DataBase::toXml($this->query_data);
        return $this->http->sslPost($this->query_xml, $callback);
    }
    public function makeSendData(array $params)
    {
        $this->send_data = array_merge($this->send_data, $params);
        $this->send_data['wxappid'] = $this->config->app_id;
        $this->send_data['mch_id'] = $this->config->mch_id;
        $this->send_data['mch_billno'] = $this->buildBillno();
        $this->send_data['sign'] = DataBase::wxMakeSign($this->send_data, $this->config->mch_key);
    }
    public function makeQueryData(array $params)
    {
        $this->query_data = array_merge($this->query_data, $params);
        $this->query_data['appid'] = $this->config->app_id;
        $this->query_data['mch_id'] = $this->config->mch_id;
        $this->query_data['bill_type'] = 'MCHT';
        $this->query_data['nonce_str'] = DataBase::makeNonceStr();
        $this->query_data['sign'] = DataBase::wxMakeSign($this->query_data, $this->config->mch_key);
    }
    //商户订单号（每个订单号必须唯一） 组成：mch_id+yyyymmdd+10位一天内不能重复的数字。接口根据商户订单号支持重入，如出现超时可再调用。
    public function buildBillno()
    {
        return $this->config->mch_id.date('Ymd', time()).rand(1000000000, 9999999999);
    }
}
