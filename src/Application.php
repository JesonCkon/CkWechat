<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/8
 * Time: 17:09.
 */

namespace CkWechat;

use CkWechat\Core\Container as Container;
use CkWechat\Core\Config as Config;

class Application extends Container
{
    public static $_instance;
    protected $config;
    private $service_list = array(
      Service\CustomMenuService::class,
    );
    private function __construct()
    {
        #TODO
        $this->setServices();
    }
    public static function initialization()
    {
        if (!isset(self::$_instance)) {
            $class_name = __CLASS__;
            self::$_instance = new $class_name();
        }

        return self::$_instance;
    }
    public function setConfig(array $config)
    {
        $this->config = new Config($config);
    }
    public function setServices()
    {
        foreach ($this->service_list as $service_name) {
            $this->register(new $service_name());
        }
    }
    public function register($service_obj)
    {
        $service_obj->register($this);

        return $this;
    }
}
