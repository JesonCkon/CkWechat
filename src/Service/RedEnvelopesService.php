<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/15
 * Time: 15:40
 */

namespace CkWechat\Service;
use CkWechat\Core\Container as Container;
use CkWechat\Pay\RedEnvelopes as RedEnvelopes;

class RedEnvelopesService implements ServiceInterface
{
  public function register(Container $obj)
  {
      $obj->redEnvelopes = function ($obj) {
        return new RedEnvelopes($obj);
      };
  }
}
