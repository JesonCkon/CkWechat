<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/21
 * Time: 17:21
 */

namespace CkWechat\Service;
use CkWechat\Core\Container as Container;
use CkWechat\ReceiveMessage\NormalMessage as NormalMessage;

class NormalMessageService implements ServiceInterface
{
  public function register(Container $obj)
  {
      $obj->normalMessage = function ($obj) {
        return new NormalMessage($obj);
      };
  }
}
