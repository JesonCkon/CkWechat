<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/8
 * Time: 14:38.
 */
namespace CkWechat\Service;

use CkWechat\Core\Container as Container;
use CkWechat\SendMessage\SendAll as SendAll;

class SendAllService implements ServiceInterface
{
    public function register(Container $obj)
    {
        $obj->sendAll = function ($obj) {
        return new SendAll($obj);
      };
    }
}
