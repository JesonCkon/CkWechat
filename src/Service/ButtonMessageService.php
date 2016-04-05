<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/5
 * Time: 17:36
 */

namespace CkWechat\Service;
use CkWechat\Core\Container as Container;
use CkWechat\ReceiveMessage\ButtonMessage as ButtonMessage;

class ButtonMessageService implements ServiceInterface
{
  public function register(Container $obj)
  {
      $obj->buttonMessage = function ($obj) {
        return new ButtonMessage($obj);
      };
  }
}
