<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/8
 * Time: 17:27.
 */
namespace CkWechat\SendMessage;

trait BaseMessage
{
    public function del($message_id = '')
    {
        $this->setTokenUrl(ApiUrl::MESSAGE_DELETE);
        $json_data = array();
        $json_data['msg_id'] = $message_id;
        $ch = $this->http->post(DataBase::toWxJson($json_data));

        $this->rawResponse = $ch->rawResponse;
        $this->call($callback);

        return $this->rawResponse;
    }
    public function uploadNews($articles = array(), $callback = null)
    {
        $this->setTokenUrl(ApiUrl::MESSAGE_MEDIA_NEWS_UPLOAD);
        $json_data = array();
        $json_data['articles'] = $articles;
        $ch = $this->http->post(DataBase::toWxJson($json_data));

        $this->rawResponse = $ch->rawResponse;
        $this->call($callback);

        return $this->rawResponse;
    }
    public function uploadVideo($media_id = '', $title = '', $description = '', $callback = null)
    {
        $this->setTokenUrl(ApiUrl::MESSAGE_MEDIA_VIDEO_UPLOAD);
        $json_data = array();
        $json_data['media_id'] = $media_id;
        $json_data['title'] = $title;
        $json_data['description'] = $description;
        $ch = $this->http->post(DataBase::toWxJson($json_data));

        $this->rawResponse = $ch->rawResponse;
        $this->call($callback);

        return $this->rawResponse;
    }
    public function mediaPreview($media_id = '', $openid = '', $type = 'mpnews', $callback = null)
    {
        $this->setTokenUrl(ApiUrl::MESSAGE_PREVIEW);
        $json_data = array();
        $json_data['touser'] = $openid;
        $json_data['msgtype'] = $type;
        $json_data[$type]['media_id'] = $description;
        $ch = $this->http->post(DataBase::toWxJson($json_data));

        $this->rawResponse = $ch->rawResponse;
        $this->call($callback);

        return $this->rawResponse;
    }
    public function textPreview($media_id = '', $openid = '', $content = '', $callback = null)
    {
        $this->setTokenUrl(ApiUrl::MESSAGE_PREVIEW);
        $json_data = array();
        $json_data['msgtype'] = 'text';
        $json_data['touser'] = $openid;
        $json_data['text']['content'] = $content;
        $ch = $this->http->post(DataBase::toWxJson($json_data));

        $this->rawResponse = $ch->rawResponse;
        $this->call($callback);

        return $this->rawResponse;
    }
}
