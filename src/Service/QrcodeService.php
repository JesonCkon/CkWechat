<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/24
 * Time: 11:00
 */

namespace CkWechat\Service;
use CkWechat\Core\Container as Container;
use CkWechat\Foundation\Qrcode as Qrcode;

class QrcodeService implements ServiceInterface
{
  public function register(Container $obj)
  {
      $obj->qrcode = function ($obj) {
        return new Qrcode($obj);
      };
  }
}
