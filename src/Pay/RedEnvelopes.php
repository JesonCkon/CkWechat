<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/15
 * Time: 15:37.
 */
namespace CkWechat\Pay;

use CkWechat\Core\AbstractApi as AbstractApi;

class RedEnvelopes extends AbstractApi
{
    public function send($openid)
    {
        var_dump($this->config->mch_id);
        $billno='';
        $post_data = array(
          'nonce_str' => strtoupper(md5('test0001')),
          'mch_billno' => $billno,
          'mch_id' => ',',
          'wxappid' => 'wx581a16fa4192ca31',
          'send_name' => 'tttttt',
          're_openid' => 'oT2uXuKSPCx0BorhyTqDKwoJBavc',
          'total_amount' => '100',
          'total_num' => '1',
          'wishing' => 'ttttt',
          'client_ip' => '107.150.98.190',
          'act_name' => 'ttttt',
          'remark' => 'tttttt',
        );
    }

    public function makeSendData(array $params)
    {
        # code...
    }
    public function addMchIdByConfig()
    {
        return array('wxappid' => $this->config->app_id);
    }
    //商户订单号（每个订单号必须唯一） 组成：mch_id+yyyymmdd+10位一天内不能重复的数字。接口根据商户订单号支持重入，如出现超时可再调用。
    public function buildBillno()
    {
        return $this->config->mch_id.date('Ymd', time()).rand(1000000000, 9999999999);
    }
}
