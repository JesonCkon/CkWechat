<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/10
 * Time: 16:30.
 */
namespace CkWechat\CustomUser;

use CkWechat\Core\AbstractApi as AbstractApi;
use CkWechat\Core\ApiUrl as ApiUrl;
use CkWechat\Core\DataBase as DataBase;

class Group extends AbstractApi
{
    public function add($name = '', $callback = null)
    {
        if (empty($name)) {
            return false;
        }
        $this->setTokenUrl(ApiUrl::GROUP_ADD);
        $ch = $this->http->get();
        $this->call($callback);

        return array('result' => $ch->rawResponse);
    }
    public function get($callback = null)
    {
        $this->setTokenUrl(ApiUrl::GROUP_GET);
        $ch = $this->http->get();
        $this->call($callback);

        return array('result' => $ch->rawResponse);
    }
    public function getid($openid = '')
    {
        if (empty($openid)) {
            return false;
        }
        $this->setTokenUrl(ApiUrl::GROUP_GETID);
        $post_data = array();
        $post_data['openid'] = $openid;
        $ch = $this->http->post(DataBase::toWxJson($post_data));
        $this->call($callback);

        return array('result' => $ch->rawResponse);
    }
    public function update($id = '', $name = '', $callback = null)
    {
        $this->setTokenUrl(ApiUrl::GROUP_UPDATE);
        $post_data = array();
        $post_data['group']['id'] = $id;
        $post_data['group']['name'] = $name;
        $ch = $this->http->post(DataBase::toWxJson($post_data));
        $this->call($callback);

        return array('result' => $ch->rawResponse);
    }
    public function membersUpdate($openid = '', $to_groupid = '', $callback = null)
    {
        $this->setTokenUrl(ApiUrl::GROUP_MEMBERS_UPDATE);
        $post_data = array();
        $post_data['openid'] = $openid;
        $post_data['to_groupid'] = $to_groupid;
        $ch = $this->http->post(DataBase::toWxJson($post_data));
        $this->call($callback);

        return array('result' => $ch->rawResponse);
    }
    public function membersBatchUpdate($openids = array(), $callback = null)
    {
        $this->setTokenUrl(ApiUrl::GROUP_MEMBERS_BATCHUPDATE);
        $post_data = array();
        $post_data['openid_list'] = $openids;
        $post_data['to_groupid'] = $to_groupid;
        $ch = $this->http->post(DataBase::toWxJson($post_data));
        $this->call($callback);

        return array('result' => $ch->rawResponse);
    }
    public function del($id = 0, $callback = null)
    {
        $this->setTokenUrl(ApiUrl::GROUP_DEL);
        $post_data = array();
        $post_data['group']['id'] = $id;
        $this->call($callback);

        return array('result' => $ch->rawResponse);
    }
}
