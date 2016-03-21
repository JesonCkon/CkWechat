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
        $signature = $result['signature'];
        $timestamp = $result['timestamp'];
        $nonce = $result['nonce'];
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
}
