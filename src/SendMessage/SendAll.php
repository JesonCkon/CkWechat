<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/8
 * Time: 14:13.
 */
namespace CkWechat\SendMessage;

use CkWechat\Core\AbstractApi as AbstractApi;
use CkWechat\Core\ApiUrl as ApiUrl;
use CkWechat\Core\DataBase as DataBase;

class SendAll extends AbstractApi
{
    use BaseMessage;
    public function mpnews($media_id = '', $gid = 0, $callback = null)
    {
        $this->setTokenUrl(ApiUrl::MESSAGE_SEND_ALL);
        $json_data = array();
        $json_data['msgtype'] = 'mpnews';
        $json_data['mpnews']['media_id'] = $media_id;
        $json_data = $json_data + $this->makeGroup($gid);
        $ch = $this->http->post(DataBase::toWxJson($json_data));

        $this->rawResponse = $ch->rawResponse;
        $this->call($callback);

        return $this->rawResponse;
    }
    public function text($content = '', $gid = 0, $callback = null)
    {
        $this->setTokenUrl(ApiUrl::MESSAGE_SEND_ALL);
        $json_data = array();
        $json_data['msgtype'] = 'text';
        $json_data['text']['content'] = $content;
        $json_data = $json_data + $this->makeGroup($gid);
        $ch = $this->http->post(DataBase::toWxJson($json_data));

        $this->rawResponse = $ch->rawResponse;
        $this->call($callback);

        return $this->rawResponse;
    }
    public function voice($media_id = '', $gid = 0, $callback = null)
    {
        $this->setTokenUrl(ApiUrl::MESSAGE_SEND_ALL);
        $json_data = array();
        $json_data['msgtype'] = 'voice';
        $json_data['voice']['media_id'] = $media_id;
        $json_data = $json_data + $this->makeGroup($gid);
        $ch = $this->http->post(DataBase::toWxJson($json_data));

        $this->rawResponse = $ch->rawResponse;
        $this->call($callback);

        return $this->rawResponse;
    }
    public function image($media_id = '', $gid = 0, $callback = null)
    {
        $this->setTokenUrl(ApiUrl::MESSAGE_SEND_ALL);
        $json_data = array();
        $json_data['msgtype'] = 'image';
        $json_data['image']['media_id'] = $media_id;
        $json_data = $json_data + $this->makeGroup($gid);
        $ch = $this->http->post(DataBase::toWxJson($json_data));

        $this->rawResponse = $ch->rawResponse;
        $this->call($callback);

        return $this->rawResponse;
    }
    public function mpvideo($media_id = '', $gid = 0, $callback = null)
    {
        $this->setTokenUrl(ApiUrl::MESSAGE_SEND_ALL);
        $json_data = array();
        $json_data['msgtype'] = 'mpvideo';
        $json_data['mpvideo']['media_id'] = $media_id;
        $json_data = $json_data + $this->makeGroup($gid);
        $ch = $this->http->post(DataBase::toWxJson($json_data));

        $this->rawResponse = $ch->rawResponse;
        $this->call($callback);

        return $this->rawResponse;
    }
    public function wxcard($media_id = '', $gid = 0, $callback = null)
    {
        $this->setTokenUrl(ApiUrl::MESSAGE_SEND_ALL);
        $json_data = array();
        $json_data['msgtype'] = 'wxcard';
        $json_data['wxcard']['media_id'] = $media_id;
        $json_data = $json_data + $this->makeGroup($gid);
        $ch = $this->http->post(DataBase::toWxJson($json_data));

        $this->rawResponse = $ch->rawResponse;
        $this->call($callback);

        return $this->rawResponse;
    }

    /**
     * @method makeGroup
     *
     * @param int $gid 用户分组id
     *
     * @return array 返回一个filter 数组
     */
    private function makeGroup($gid = 0)
    {
        return array('filter' => array('is_to_all' => false, 'group_id' => $gid));
    }
}
