<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/5
 * Time: 17:24.
 */
namespace CkWechat\ReceiveMessage;

use CkWechat\Core\AbstractApi as AbstractApi;

class ButtonMessage extends AbstractApi
{
    /*
     * 	多重继承与event事件，Reply消息回复
     */

    use Event,Reply,Push {
      Event::__construct as private __eventConstruct;
    }
    /**
     * [__construct 初始化].
     *
     * @method __construct
     */
    public function __construct()
    {
        $args_tmp = func_get_args();
        parent::__construct($args_tmp[0]);
        $this->__eventConstruct();
    }
    /**
     * 点击菜单拉取消息时的事件推送
     *
     * @method click
     *
     * @param string  $key      Eventkey 点击事件关键字
     * @param closure $callback 回调闭包函数
     *
     * @return object
     */
    public function click($key, $callback = null)
    {
        $this->post_data = null;
        if ($this->message_type == 'event' && $this->message_event == 'CLICK') {
            $this->post_data = $this->checkXmlByKey('EventKey', $key);
            $this->post_data and $this->call($callback);
        }

        return $this;
    }
    /**
     * 点击菜单跳转链接时的事件推送
     *
     * @method view
     *
     * @param string  $key      跳转链接
     * @param closure $callback 回调闭包函数
     *
     * @return object
     */
    public function view($key = '', $callback = null)
    {
        $this->post_data = null;
        if ($this->message_type == 'event' && $this->message_event == 'VIEW') {
            $this->post_data = $this->checkXmlByKey('EventKey', $key);
            $this->post_data and $this->call($callback);
        }

        return $this;
    }
}
