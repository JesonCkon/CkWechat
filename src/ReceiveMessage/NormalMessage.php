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
    use Event,Reply,Push {
        Event::__construct as private __eventConstruct;
    }
    public $xml_data = '';
    /**
     * [__construct description]
     * @method __construct
     */

    public function __construct()
    {
        $args_tmp = func_get_args();
        parent::__construct($args_tmp[0]);
        $this->__eventConstruct();
    }
    /**
     * 微信检验
     * @method valid
     */

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
    public function voice($callback = null)
    {
        if ($this->message_type == 'voice') {
            $this->call($callback);
        }

        return $this;
    }
    public function video($callback = null)
    {
        if ($this->message_type == 'video') {
            $this->call($callback);
        }

        return $this;
    }
    public function shortvideo($callback = null)
    {
        if ($this->message_type == 'shortvideo') {
            $this->call($callback);
        }

        return $this;
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
