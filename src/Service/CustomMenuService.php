<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/8
 * Time: 18:04.
 */

namespace CkWechat\Service;


class CustomMenuService implements ServiceInterface
{
    public function register(Container $obj)
    {
        $obj->menu = function ($obj) {return new CustomMenu\Menu($obj);};
    }
}
