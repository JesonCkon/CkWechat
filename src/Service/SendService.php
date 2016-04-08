<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/8
 * Time: 17:20
 */

namespace CkWechat\Service;

use CkWechat\Core\Container as Container;
use CkWechat\SendMessage\Send as Send;

class SendService implements ServiceInterface
{
    public function register(Container $obj)
    {
        $obj->send = function ($obj) {
        return new Send($obj);
      };
    }
}
