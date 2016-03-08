<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/8
 * Time: 17:09.
 */

namespace CkWechat;

use CkWechat\Core\Container as Container;

class Application extends Container
{
    private $service_list = array(
      Service\UserService::class,
      Service\CustomService::class,
    );
    public static function initialization()
    {
        if (!isset(self::$_instance)) {
            $class_name = __CLASS__;
            self::$_instance = new $class_name();
        }

        return self::$_instance;
    }
    public function setServices()
    {
        foreach ($this->service_list as $service_name) {
            $this->register(new $service_name());
        }
    }
}
