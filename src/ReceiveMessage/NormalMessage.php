<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/21
 * Time: 17:19.
 */
namespace CkWechat\ReceiveMessage;

use CkWechat\Core\AbstractApi as AbstractApi;
use CkWechat\Core\DataBase as DataBase;

class NormalMessage extends AbstractApi
{
    use Event {
        Event::__construct as private __eventConstruct;
    }
    public $xml_data = '';
    public function __construct()
    {
        $args_tmp = func_get_args();
        parent::__construct($args_tmp[0]);
        $this->__eventConstruct();
    }
    public function valid()
    {
        $echostr = $this->checkSignature();
        if ($echostr != false) {
            DataBase::outString($echostr);
        }
    }
    public function text($keyword, $callback = null)
    {
        if ($this->message_type == 'text') {
            $this->post_data = $this->checkXmlByKey('Content', $keyword);
            $this->post_data and $this->call($callback);
        }

        return $this;
    }
    public function textReply($message, $callback = null)
    {
        if (!empty($this->post_data)) {
            $xml_data['ToUserName'] = $this->post_data['FromUserName'];
            $xml_data['FromUserName'] = $this->post_data['ToUserName'];
            $xml_data['CreateTime'] = time();
            $xml_data['MsgType'] = 'text';
            $xml_data['Content'] = $message;
            DataBase::outString($xml_data, 'wx_xml');
            $this->call($callback);
        }
    }
    public function image($callback = null)
    {
        if ($this->message_type == 'image') {
            $pic_url = $this->request->postParams('PicUrl');
            if (DataBase::getUrlCode($pic_url) == 200) {
                $this->post_data = $this->request->getPostData();
                $this->call($callback);
            }
        }

        return $this;
    }
    public function imageReply($media_id = '', $callback = null)
    {
        if (empty($media_id)) {
            return;
        }
        $xml_data['ToUserName'] = $this->post_data['FromUserName'];
        $xml_data['FromUserName'] = $this->post_data['ToUserName'];
        $xml_data['CreateTime'] = time();
        $xml_data['MsgType'] = 'image';
        $xml_data['Image']['MediaId'] = $media_id;
        $xml_string = DataBase::makeXmlStr($xml_data);
        DataBase::outString($xml_string, 'wx_xml');
        $this->call($callback);
    }

    public function voice($callback = null)
    {
        if ($this->message_type == 'voice') {
            $this->call($callback);
        }

        return $this;
    }
    public function voiceReply($media_id = '', $callback = null)
    {
        $xml_data['ToUserName'] = $this->post_data['FromUserName'];
        $xml_data['FromUserName'] = $this->post_data['ToUserName'];
        $xml_data['CreateTime'] = time();
        $xml_data['MsgType'] = 'voice';
        $xml_data['Voice']['MediaId'] = $media_id;
        $xml_string = DataBase::makeXmlStr($xml_data);
        DataBase::outString($xml_string, 'wx_xml');
        $this->call($callback);
    }

    public function video($callback = null)
    {
        if ($this->message_type == 'video') {
            $this->call($callback);
        }

        return $this;
    }
    public function videoReply($value = '')
    {
        $xml_data['ToUserName'] = $this->post_data['FromUserName'];
        $xml_data['FromUserName'] = $this->post_data['ToUserName'];
        $xml_data['CreateTime'] = time();
        $xml_data['MsgType'] = 'Video';
        $xml_data['Video']['MediaId'] = $media_id;
        $xml_string = DataBase::makeXmlStr($xml_data);
        DataBase::outString($xml_string, 'wx_xml');
        $this->call($callback);
    }
    public function shortvideo($callback = null)
    {
        if ($this->message_type == 'shortvideo') {
            $this->call($callback);
        }

        return $this;
    }
    public function musicReply($data = null, $callback = null)
    {
        $xml_string = DataBase::makeXmlStr($this->makeMusicXml($data));
        DataBase::outString($xml_string);
    }
    public function makeMusicXml($data = null)
    {
        $xml_data = array();
        $xml_data['Music']['Title'] = isset($data['Title']) ? $data['Title'] : '';
        $xml_data['Music']['Description'] = isset($data['Description']) ? $data['Description'] : '';
        $xml_data['Music']['MusicUrl'] = isset($data['MusicUrl']) ? $data['MusicUrl'] : '';
        $xml_data['Music']['HQMusicUrl'] = isset($data['HQMusicUrl']) ? $data['HQMusicUrl'] : '';
        $xml_data['Music']['ThumbMediaId'] = isset($data['ThumbMediaId']) ? $data['ThumbMediaId'] : '';

        return $xml_data;
    }
    public function location($callback = null)
    {
        if ($this->message_type == 'location') {
            return $this->call($callback);
        }
    }
    public function link($callback = null)
    {
        if ($this->message_type == 'link') {
            return $this->call($callback);
        }
    }
}
