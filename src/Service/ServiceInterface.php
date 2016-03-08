<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/2
 * Time: 19:15.
 */

namespace CkWechat\Service;

use CkWechat\Core\Container as Container;

interface ServiceInterface
{
    public function register(Container $obj);
}
