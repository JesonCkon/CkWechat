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
    }
    public function image($callback = null)
    {
        if ($this->message_type == 'image') {
            $pic_url = $this->request->postParams('PicUrl');
            if (DataBase::getUrlCode($pic_url) == 200) {
                $this->call($callback);
            }
        }
    }
    public function voice($callback = null)
    {
        if ($this->message_type == 'voice') {
            $media_id = $this->request->postParams('MediaId');
            if (DataBase::getUrlCode($pic_url) == 200) {
                $this->call($callback);
            }
        }
    }
}
