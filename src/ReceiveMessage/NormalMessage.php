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
    use Event;
    public function valid()
    {
        $echostr = $this->checkSignature();
        if ($echostr != false) {
            DataBase::outString($echostr);
        }
    }
    public function text($message, $callback = null)
    {
        $this->post_data = $this->checkXmlByKey('Content', $message);
        if ($this->post_data == false) {
            //TODO
        } else {
            if ($this->request->postParams('MsgType') == 'text') {
                # code...
            }
            $this->call($callback);
        }
    }
}
