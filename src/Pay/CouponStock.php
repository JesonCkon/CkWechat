<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/17
 * Time: 16:19.
 */
namespace CkWechat\Pay;

use CkWechat\Core\AbstractApi as AbstractApi;
use CkWechat\Core\ApiUrl as ApiUrl;
use CkWechat\Core\DataBase as DataBase;

class CouponStock extends AbstractApi
{
    protected $query_data = array();
    protected $query_xml = '';
    protected $send_data = array();
    protected $send_xml = '';
    public function send(array $post_data, $callback = null)
    {
        $this->http->setUrl(ApiUrl::SEND_COUPON);
        $this->makeSendData($post_data);
        $this->send_xml = DataBase::toXml($this->send_data);

        return $this->http->sslPost($this->send_xml, $callback);
    }
    public function makeSendData(array $params)
    {
        $this->send_data = array_merge($this->send_data, $params);
        $this->send_data['appid'] = $this->config->app_id;
        $this->send_data['mch_id'] = $this->config->mch_id;
        $this->send_data['nonce_str'] = DataBase::makeNonceStr();
        $this->send_data['partner_trade_no'] = DataBase::buildBillno($this->config->mch_id);
        $this->send_data['sign'] = DataBase::wxMakeSign($this->send_data, $this->config->mch_key);
    }
    public function query(array $post_data, $callback = null)
    {
        $this->http->setUrl(ApiUrl::QUERY_COUPON_STOCK);
        $this->makeQueryData($post_data);
        $this->query_xml = DataBase::toXml($this->query_data);

        return $this->http->post($this->query_xml, $callback);
    }
    public function makeQueryData(array $params)
    {
        $this->query_data = array_merge($this->query_data, $params);
        $this->query_data['appid'] = $this->config->app_id;
        $this->query_data['mch_id'] = $this->config->mch_id;
        $this->query_data['nonce_str'] = DataBase::makeNonceStr();
        $this->query_data['sign'] = DataBase::wxMakeSign($this->query_data, $this->config->mch_key);
    }
}
