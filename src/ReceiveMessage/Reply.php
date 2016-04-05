<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/5
 * Time: 17:38.
 */
namespace CkWechat\ReceiveMessage;

use CkWechat\Core\DataBase as DataBase;

trait Reply
{
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
    public function videoReply($media_id = '', $callback = null)
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
    public function musicReply($data = null, $callback = null)
    {
        $xml_data = array();
        $xml_data['Music']['Title'] = isset($data['Title']) ? $data['Title'] : '';
        $xml_data['Music']['Description'] = isset($data['Description']) ? $data['Description'] : '';
        $xml_data['Music']['MusicUrl'] = isset($data['MusicUrl']) ? $data['MusicUrl'] : '';
        $xml_data['Music']['HQMusicUrl'] = isset($data['HQMusicUrl']) ? $data['HQMusicUrl'] : '';
        $xml_data['Music']['ThumbMediaId'] = isset($data['ThumbMediaId']) ? $data['ThumbMediaId'] : '';
        $xml_string = DataBase::makeXmlStr($xml_data);
        DataBase::outString($xml_string);
        $this->call($callback);
    }
}
