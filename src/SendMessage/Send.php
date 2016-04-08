<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/8
 * Time: 17:16.
 */
namespace CkWechat\SendMessage;

use CkWechat\Core\AbstractApi as AbstractApi;
use CkWechat\Core\ApiUrl as ApiUrl;
use CkWechat\Core\DataBase as DataBase;

class Send extends AbstractApi
{
    use BaseMessage;
    public function mpnews($media_id = '', $users = array(), $callback = null)
    {
        $this->setTokenUrl(ApiUrl::MESSAGE_SEND_ALL);
        $json_data = array();
        $json_data['msgtype'] = 'mpnews';
        $json_data['mpnews']['media_id'] = $media_id;
        $json_data['touser'] = array_values($users);
        $ch = $this->http->post(DataBase::toWxJson($json_data));

        $this->rawResponse = $ch->rawResponse;
        $this->call($callback);

        return $this->rawResponse;
    }
    public function text($content = '', $users = array(), $callback = null)
    {
        $this->setTokenUrl(ApiUrl::MESSAGE_SEND_ALL);
        $json_data = array();
        $json_data['msgtype'] = 'text';
        $json_data['text']['content'] = $content;
        $json_data['touser'] = array_values($users);
        $ch = $this->http->post(DataBase::toWxJson($json_data));

        $this->rawResponse = $ch->rawResponse;
        $this->call($callback);

        return $this->rawResponse;
    }
    public function voice($media_id = '', $users = array(), $callback = null)
    {
        $this->setTokenUrl(ApiUrl::MESSAGE_SEND_ALL);
        $json_data = array();
        $json_data['msgtype'] = 'voice';
        $json_data['voice']['media_id'] = $media_id;
        $json_data['touser'] = array_values($users);
        $ch = $this->http->post(DataBase::toWxJson($json_data));

        $this->rawResponse = $ch->rawResponse;
        $this->call($callback);

        return $this->rawResponse;
    }
    public function image($media_id = '', $users = array(), $callback = null)
    {
        $this->setTokenUrl(ApiUrl::MESSAGE_SEND_ALL);
        $json_data = array();
        $json_data['msgtype'] = 'image';
        $json_data['image']['media_id'] = $media_id;
        $json_data['touser'] = array_values($users);
        $ch = $this->http->post(DataBase::toWxJson($json_data));

        $this->rawResponse = $ch->rawResponse;
        $this->call($callback);

        return $this->rawResponse;
    }
    public function mpvideo($media_id = '', $users = array(), $callback = null)
    {
        $this->setTokenUrl(ApiUrl::MESSAGE_SEND_ALL);
        $json_data = array();
        $json_data['msgtype'] = 'mpvideo';
        $json_data['mpvideo']['media_id'] = $media_id;
        $json_data['touser'] = array_values($users);
        $ch = $this->http->post(DataBase::toWxJson($json_data));

        $this->rawResponse = $ch->rawResponse;
        $this->call($callback);

        return $this->rawResponse;
    }
    public function wxcard($media_id = '', $users = array(), $callback = null)
    {
        $this->setTokenUrl(ApiUrl::MESSAGE_SEND_ALL);
        $json_data = array();
        $json_data['msgtype'] = 'wxcard';
        $json_data['wxcard']['media_id'] = $media_id;
        $json_data['touser'] = array_values($users);
        $ch = $this->http->post(DataBase::toWxJson($json_data));

        $this->rawResponse = $ch->rawResponse;
        $this->call($callback);

        return $this->rawResponse;
    }
    public function getStatus($msg_id='')
    {
      $this->setTokenUrl(ApiUrl::MESSAGE_GET);
      $json_data = array();
      $json_data['msg_id'] = $msg_id;
      $ch = $this->http->post(DataBase::toWxJson($json_data));

      $this->rawResponse = $ch->rawResponse;
      $this->call($callback);

      return $this->rawResponse;
    }
}
