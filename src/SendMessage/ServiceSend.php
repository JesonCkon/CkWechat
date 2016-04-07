<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/7
 * Time: 15:25.
 */
namespace CkWechat\SendMessage;

use CkWechat\Core\AbstractApi as AbstractApi;
use CkWechat\Core\ApiUrl as ApiUrl;
use CkWechat\Core\DataBase as DataBase;

class ServiceSend extends AbstractApi
{
    /**
     * [text description].
     *
     * @method text
     *
     * @param string $openid   [description]
     * @param string $content  [description]
     * @param [type] $callback [description]
     *
     * @return [type] [description]
     */
    public function text($openid = '', $content = '', $callback = null)
    {
        $json_data = array();
        $json_data['touser'] = $openid;
        $json_data['msgtype'] = 'text';
        $json_data['text']['content'] = $content;
        $this->setTokenUrl(ApiUrl::SERVICE_SEND);
        $ch = null;
        $ch = $this->http->post(DataBase::toWxJson($json_data));
        $this->rawResponse = $ch->rawResponse;
        $this->call($callback);

        return $this->rawResponse;
    }

    public function image($openid = '', $media_id = '', $callback = null)
    {
        $json_data = array();
        $json_data['touser'] = $openid;
        $json_data['msgtype'] = 'image';
        $json_data['image']['media_id'] = $media_id;
        $this->setTokenUrl(ApiUrl::SERVICE_SEND);
        $ch = null;
        $ch = $this->http->post(DataBase::toWxJson($json_data));
        $this->rawResponse = $ch->rawResponse;
        $this->call($callback);

        return $this->rawResponse;
    }
    public function voice($openid = '', $media_id = '', $callback = null)
    {
        $json_data = array();
        $json_data['touser'] = $openid;
        $json_data['msgtype'] = 'voice';
        $json_data['voice']['media_id'] = $media_id;
        $this->setTokenUrl(ApiUrl::SERVICE_SEND);
        $ch = null;
        $ch = $this->http->post(DataBase::toWxJson($json_data));
        $this->rawResponse = $ch->rawResponse;
        $this->call($callback);

        return $this->rawResponse;
    }
    public function video($openid = '', $data = array(), $callback = null)
    {
        $json_data = array();
        $json_data['touser'] = $openid;
        $json_data['msgtype'] = 'video';
        $json_data['video']['media_id'] = $data['media_id'];
        $json_data['video']['thumb_media_id'] = $data['thumb_media_id'];
        $json_data['video']['title'] = $data['title'];
        $json_data['video']['description'] = $data['description'];
        $this->setTokenUrl(ApiUrl::SERVICE_SEND);
        $ch = null;
        $ch = $this->http->post(DataBase::toWxJson($json_data));
        $this->rawResponse = $ch->rawResponse;
        $this->call($callback);

        return $this->rawResponse;
    }
    public function music($openid = '', $data = array(), $callback = null)
    {
        $json_data = array();
        $json_data['touser'] = $openid;
        $json_data['msgtype'] = 'music';
        $json_data['music']['title'] = $data['title'];
        $json_data['music']['description'] = $data['description'];
        $json_data['music']['musicurl'] = $data['musicurl'];
        $json_data['music']['hqmusicurl'] = $data['hqmusicurl'];
        $json_data['music']['thumb_media_id'] = $data['thumb_media_id'];
        $this->setTokenUrl(ApiUrl::SERVICE_SEND);
        $ch = null;
        $ch = $this->http->post(DataBase::toWxJson($json_data));
        $this->rawResponse = $ch->rawResponse;
        $this->call($callback);

        return $this->rawResponse;
    }
}
