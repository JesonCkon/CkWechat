<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/18
 * Time: 18:18.
 */
namespace CkWechat\ReceiveMessage;

use CkWechat\Core\Request as Request;

trait Event
{
    public function checkSignature()
    {
        $req = new Request();
        $result = $req->getParams(array('signature', 'timestamp', 'nonce', 'echostr'));
        $signature = isset($result['signature']) ? $result['signature'] : null;
        $timestamp = isset($result['timestamp']) ? $result['timestamp'] : null;
        $nonce = isset($result['nonce']) ? $result['nonce'] : null;
        $token = $this->config->token;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if ($tmpStr == $signature) {
            return isset($result['echostr']) ? $result['echostr'] : false;
        } else {
            return false;
        }
    }
    public function checkXmlByKey($key, $value)
    {
        $req = new Request();
        $key_val = $req->postParams($key);
        if ($key_val == $value) {
            return $req->getPostData();
        } else {
            return false;
        }
    }
}
