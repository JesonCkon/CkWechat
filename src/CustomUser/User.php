<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/9
 * Time: 22:12.
 */
namespace CkWechat\CustomUser;

use CkWechat\Core\AbstractApi as AbstractApi;
use CkWechat\Core\ApiUrl as ApiUrl;
use CkWechat\Core\DataBase as DataBase;

class User extends AbstractApi
{
    public function updateRemark($openid = '', $remark = '')
    {
        $this->setTokenUrl(ApiUrl::USER_UPDATEREMARK);
        $post_data = array();
        $post_data['openid'] = $openid;
        $post_data['remark'] = $remark;
        $ch = $this->http->post(DataBase::toWxJson($post_data));

        return array('result' => $ch->rawResponse);
    }
    public function getUserInfo($openid = '', $callback = null)
    {
        $url_data = array('openid' => $openid, 'lang' => zh_CN);
        $this->setTokenUrl(ApiUrl::USER_GET_INFO, $url_data);
        $ch = $this->http->get();
        $this->call($callback);

        return array('result' => $ch->rawResponse);
    }
    public function batchget()
    {
        $this->setTokenUrl(ApiUrl::USER_BATCHGET_INFO);
        $ch = $this->http->get();
        $this->call($callback);

        return array('result' => $ch->rawResponse);
    }
    public function get($next_openid = '')
    {
        $this->setTokenUrl(ApiUrl::USER_GET, array('next_openid' => $next_openid));
        $ch = $this->http->get();
        $this->call($callback);

        return array('result' => $ch->rawResponse);
    }
}
