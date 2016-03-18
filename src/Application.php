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
use CkWechat\Plugins\Cache as CkCache;

/**
 * @property Foundation\AccessToken $accessToken
 */
class Application extends Container
{
    public $config;
    public $cache;
    public $access_token = '';
    private $service_list = array(
      Service\CustomMenuService::class,
      Service\RedEnvelopesService::class,
      Service\CouponStockService::class,
      Service\CompanyPaymentsService::class,
      Service\FoundationService::class,
    );
    public function __construct($config)
    {
        $this->setConfig($config);
        $this->setCache();
        $this->run();
        $this->access_token = $this->accessToken->get();
    }
    public function setConfig(array $config)
    {
        $this->config = new Config($config);

        return $this;
    }
    public function setCache()
    {
        if (!isset($this->config->cache_type)) {
            $cache_config = array();
            $cache_config['cache_path'] = $this->config->cache_path;
            $cache_config['cache_time'] = $this->config->cache_time;
            $this->cache = new CkCache\FileCache($cache_config);
            //default set file cache system
        } elseif ($this->config->cache_type == 'redis') {
            # code...
        }
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
    public function run()
    {
        $this->setServices();
    }
}
