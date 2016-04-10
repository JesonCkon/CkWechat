<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/10
 * Time: 17:01
 */

namespace CkWechat\Service;
use CkWechat\Core\Container as Container;
use CkWechat\CustomUser\User as User;
use CkWechat\CustomUser\Group as Group;

class CustomUserService implements ServiceInterface
{
    public function register(Container $obj)
    {
        $obj->user = function ($obj) {
          return new User($obj);
        };
        $obj->group = function ($obj) {
          return new Group($obj);
        };
    }
}
