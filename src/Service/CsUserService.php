<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/9
 * Time: 21:09
 */

namespace CkWechat\Service;

use CkWechat\Core\Container as Container;
use CkWechat\CustomService\User as CsUser;

class CsUserService implements ServiceInterface
{
    public function register(Container $obj)
    {
        $obj->csUser = function ($obj) {
        return new CsUser($obj);
      };
    }
}
