<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/8
 * Time: 18:04.
 */

namespace CkWechat\Service;
use CkWechat\Core\Container as Container;
use CkWechat\CustomMenu\Menu as Menu;

class CustomMenuService implements ServiceInterface
{
    public function register(Container $obj)
    {
        $obj->menu = function ($obj) {
          return new Menu($obj);
        };
    }
}
