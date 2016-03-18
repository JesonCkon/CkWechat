<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/18
 * Time: 14:34
 */

namespace CkWechat\Service;
use CkWechat\Core\Container as Container;
use CkWechat\Foundation;
use CkWechat\WxBackIps;

class FoundationService implements ServiceInterface
{
    public function register(Container $obj)
    {
        $obj->accessToken = function ($obj) {
          return new Foundation\AccessToken($obj);
        };
        $obj->wxBackIps = function ($obj) {
          return new Foundation\WxBackIps($obj);
        };
    }
}
