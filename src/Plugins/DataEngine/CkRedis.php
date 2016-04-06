<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/6
 * Time: 16:30.
 */
namespace CkWechat\Plugins\DataEngine;

class CkRedis
{
    const ED = "\r\n";
    protected $host;
    protected $port;
    protected $sock;
    protected $config;
    protected $timeout = 1;
    protected $read_length = 1024;

    public function __construct()
    {
        $args_count = func_num_args();
        $args = func_get_args();
        if ($args_count == 1 && is_array($args)) {
            $t = array();
            $t = $args[0];
            $this->host = isset($t['host']) ? (string) $t['host'] : null;
            $this->port = isset($t['port']) ? (string) $t['port'] : null;
            isset($t['timeout']) and $this->timeout = (string) $t['timeout'];
        } elseif ($args_count >= 2) {
            $this->host = isset($args[0]) ? (string) $args[0] : null;
            $this->port = isset($args[1]) ? (string) $args[1] : null;
            isset($args[2]) and $this->timeout = (string) $args[2];
        }
        $this->connect();
    }
    public function connect()
    {
        $this->sock = fsockopen($this->host, $this->port, $errno, $errstr, $this->timeout);
        if ($this->sock == false) {
            #TODO
          #echo "$errstr ($errno)<br />\n";
        }
    }
    public function _redisGet($key)
    {
        if (empty($key)) {
            return;
        }
        $str = "GET {$key}".self::ED;
        $this->_write($str);

        return $this->_getValue();
    }
    public function _redisSet($key, $value, $timeout = 0)
    {
        if (empty($key) || empty($value)) {
            return;
        }
        $str = "SET {$key} {$value}\r\n";
        if ($this->runCommand($str) == true) {
            if ($timeout > 0) {
                return $this->runCommand("EXPIRE {$key} {$timeout}\r\n");
            }

            return true;
        } else {
            # code... TODO
        }
    }
    public function _write($string)
    {
        if ($this->sock) {
            fwrite($this->sock, $string);
        }

        return false;
    }
    private function _read($length = 0)
    {
        $length = $length > 0 ? $length : $this->read_length;
        if ($s = fgets($this->sock, $length)) {
            return $s;
        }
        $this->disconnect();
      //TODO
      //trigger_error("Cannot read from socket.", E_USER_ERROR);
    }
    public function _getValue($length = 0)
    {
        $reply = null;
        $reply_len = 0;
        $temp_str = $this->_read($length);
        $reply = trim($temp_str);
        if (isset($reply[0]) && $reply[0] == '$') {
            $reply_len = substr($reply, 1);
            $reply = trim($this->_read($length));
            if ($reply_len == strlen($reply)) {
                return $reply;
            } else {
                #TODO
            }
        }
        if (isset($reply[0]) && $reply[0] == '+') {
            $reply = substr($reply, 1);
            if ($reply == 'OK') {
                return true;
            }
        }
        if (isset($reply[0]) && $reply[0] == ':') {
            $reply = substr($reply, 1);

            return $reply;
        }
    }
    public function runCommand($str, $length = 0)
    {
        $this->_write($str);

        return $this->_getValue($length);
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

/*test*/
$config = array();
$config['host'] = '127.0.0.1';
$config['port'] = 6379;
$config['timeout'] = 1500;
$app = new CkRedis($config);

#var_dump($app->_redisGet('ck'));
#var_dump($app->_redisSet('ck', '008867', 2));
#sleep(5);
var_dump($app->runCommand("TTL ck\r\n"));
#var_dump($app->_redisGet('ck'));
