<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/18
 * Time: 14:57.
 */
namespace CkWechat\Plugins\Cache;

class FileCache implements CacheInterface
{
    protected $cache_path;
    protected $cache_time;
    protected $cache_file;
    public function __construct(array $config)
    {
        $this->cache_path = $config['cache_path'];
        $this->cache_time = $config['cache_time'];
        $this->init();
    }
    public function init()
    {
        if (!empty($this->cache_path) && !is_dir($this->cache_path)) {
            mkdir($this->cache_path, 0755);
        } elseif (empty($this->cache_path)) {
            $this->cache_path = '_wechat_cache';
            is_dir($this->cache_path) or mkdir($this->cache_path, 0755);
        }
    }
    public function set($key, $value)
    {
        if (empty($key) || empty($value)) {
            return false
        }
        $this->cache_file = $this->cache_path.DIRECTORY_SEPARATOR.$key;
        if (!is_writable(dirname($this->cache_file))) {
            #TODO
          echo '缓存文件写入失败';
        } else {
            $len = file_put_contents($this->cache_file, $value);
            if (strlen($value) == $len) {
                if ($this->checkTimeOut($key) == false) {
                    return false;
                }

                return true;
            }

            return false;
        }
    }
    public function get($key)
    {
        if (empty($key)) {
            return false;
        }

        $result = '';
        $this->cache_file = $this->cache_path.DIRECTORY_SEPARATOR.$key;
        if (!empty($key) && file_exists($this->cache_file)) {
            $result = file_get_contents($this->cache_file);
        } else {
            return false;
        }
    }
}
