<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/6
 * Time: 11:14.
 */
namespace CkWechat\Plugins\Cache;

#class RedisCache implements CacheInterface
#{

#}
/**
 * redis socket class.
 */
class ckRedis
{
    protected $host;
    protected $port;
    protected $sock;
    protected $timeout = 1;

    public function set($key, $value)
    {
        # code...
    }
    public function get($key)
    {
        # code...
    }
    public function checkTimeOut($key)
    {
        # code...
    }
    private function _redisGet($key)
    {
        if (empty($key)) {
            return;
        }
        $str = "GET {$key}\r\n";
        $this->_write($str);
    }
    public function _write($string)
    {
        if ($this->sock) {
            fwrite($this->sock, $string);
        }

        return false;
    }
    private function _read()
    {
        if ($s = fgets($this->sock)) {
            return $s;
        }
        $this->disconnect();
        //TODO
        //trigger_error("Cannot read from socket.", E_USER_ERROR);
    }
    public function _getValue()
    {

    }
    public function disconnect()
    {
        if ($this->sock) {
            fclose($this->sock);
        }
    }
    public function __destruct()
    {
        $this->disconnect();
    }
}

ini_set('auto_detect_line_endings', true);
$fp = fsockopen('127.0.0.1', 6379, $errno, $errstr);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
    $out = "LRANGE mylist 0 3\r\n";
    fwrite($fp, $out);
    echo $line = fgets($fp, 65535);
    echo $line = fgets($fp, 65535);
    fclose($fp);
}
