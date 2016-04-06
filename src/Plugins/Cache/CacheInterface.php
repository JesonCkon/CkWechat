<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/18
 * Time: 13:41.
 */
namespace CkWechat\Plugins\Cache;

interface CacheInterface
{
    public function get($key);
    public function set($key, $value);
    public function checkTimeOut($key);
}
