<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/7
 * Time: 17:03
 */

namespace CkWechat\Service;
use CkWechat\Core\Container as Container;
use CkWechat\SendMessage\ServiceSend as ServiceSend;

class ServiceSendService implements ServiceInterface
{
  public function register(Container $obj)
  {
      $obj->serviceSend = function ($obj) {
        return new ServiceSend($obj);
      };
  }
}
