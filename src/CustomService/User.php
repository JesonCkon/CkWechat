<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/9
 * Time: 20:49.
 */
namespace CkWechat\CustomService;

use CkWechat\Core\AbstractApi as AbstractApi;
use CkWechat\Core\ApiUrl as ApiUrl;
use CkWechat\Core\DataBase as DataBase;

class User extends AbstractApi
{
    public function add($kf_account = '', $nickname = '', $password = '')
    {
        $this->setTokenUrl(ApiUrl::SERVICE_USER_ADD);
        $post_data = array();
        $post_data['kf_account'] = $kf_account;
        $post_data['nickname'] = $nickname;
        $post_data['password'] = $password;
        $ch = $this->http->post(DataBase::toWxJson($post_data));

        return array('result' => $ch->rawResponse);
    }
    public function get()
    {
        $this->setTokenUrl(ApiUrl::SERVICE_USER_GET);
        $ch = $this->http->get();

        return array('result' => $ch->rawResponse);
    }
    public function getOnline()
    {
        $this->setTokenUrl(ApiUrl::SERVICE_USER_OL_GET);
        $ch = $this->http->get();

        return array('result' => $ch->rawResponse);
    }
    public function update($kf_account = '', $nickname = '', $password = '')
    {
        $this->setTokenUrl(ApiUrl::SERVICE_USER_UPDATE);
        $post_data = array();
        $post_data['kf_account'] = $kf_account;
        $post_data['nickname'] = $nickname;
        $post_data['password'] = $password;
        $ch = $this->http->post(DataBase::toWxJson($post_data));

        return array('result' => $ch->rawResponse);
    }
    public function uploadheadimg($kf_account = '', $path = '')
    {
        $kfaccount = array('kf_account' => $kf_account);
        $this->setTokenUrl(ApiUrl::SERVICE_USER_UPLOADHEADIMG, $kfaccount);
        $post_data = array();
        $post_data['media'] = '@'.$path;
        $ch = $this->http->post($post_data);

        return array('result' => $ch->rawResponse);
    }
    public function del($kf_account = '')
    {
        $kfaccount = array('kf_account' => $kf_account);
        $this->setTokenUrl(ApiUrl::SERVICE_USER_DEL, $kfaccount);

        return array('result' => $ch->rawResponse);
    }
}
