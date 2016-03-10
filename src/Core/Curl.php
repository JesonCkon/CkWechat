<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/8
 * Time: 23:28.
 */

namespace CkWechat\Core;

class Curl
{
    public $curl_proxy_host = '';
    public $curl_proxy_port = '';
    public $sslcert_path = '';
    public $sslkey_path = '';
    public $beforeSendFunction = null;
    public $curl = null;

    public function get($url, $data = array())
    {
      $this->setUrl($url, $data);
    }
    public function setProxy()
    {
      if ($this->curl_proxy_host != '0.0.0.0' && $this->curl_proxy_port != 0) {
          $this->setOpt(CURLOPT_PROXY,$this->curl_proxy_host);
          $this->setOpt(CURLOPT_PROXYPORT,$this->curl_proxy_port);
      }
    }
    public function setCurl()
    {
        $this->curl = curl_init();
    }
    public function setUrl($url, $data = array())
    {
      $this->baseUrl = $url;
      $this->setOpt(CURLOPT_URL, $this->url);
    }
    public function setOpt($option, $value)
    {
        $required_options = array(
            CURLOPT_RETURNTRANSFER => 'CURLOPT_RETURNTRANSFER',
        );
        if (in_array($option, array_keys($required_options), true) && !($value === true)) {
            trigger_error($required_options[$option].' is a required option', E_USER_WARNING);
        }
        $this->options[$option] = $value;

        return curl_setopt($this->curl, $option, $value);
    }
    public function beforeSend($callback)
    {
        $this->beforeSendFunction = $callback;
    }
    public function call()
    {
        $args = func_get_args();
        $function = array_shift($args);
        if (is_callable($function)) {
            array_unshift($args, $this);
            call_user_func_array($function, $args);
        }
    }
    public function run()
    {
        $this->call($this->beforeSendFunction);
    }
    public function get($url, $params = array())
    {
        $this->run();
    }

    private static function postXmlCurl(string $xml, string $url, $useCert = false, $second = 30)
    {
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);

        //如果有配置代理这里就设置代理
        if ($this->curl_proxy_host != '0.0.0.0'
            && $this->curl_proxy_port != 0) {
            curl_setopt($ch, CURLOPT_PROXY, $this->curl_proxy_host);
            curl_setopt($ch, CURLOPT_PROXYPORT, $this->curl_proxy_port);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);//严格校验
        //设置header
        curl_setopt($ch, CURLOPT_HEADER, false);
        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if ($useCert == true) {
            //设置证书
            //使用证书：cert 与 key 分别属于两个.pem文件
            curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'PEM');
            curl_setopt($ch, CURLOPT_SSLCERT, $this->sslcert_path);
            curl_setopt($ch, CURLOPT_SSLKEYTYPE, 'PEM');
            curl_setopt($ch, CURLOPT_SSLKEY, $this->sslkey_path);
        }
        //post提交方式
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        //运行curl
        if ($_GET['debug'] == 1) {
            echo $url.'</br>';
            echo $xml.'</br>';
        }
        $data = curl_exec($ch);
        //返回结果
        if ($data) {
            curl_close($ch);

            return $data;
        } else {
            $error = curl_errno($ch);
            curl_close($ch);
            throw new \Exception("curl出错，错误码:$error");
        }
    }
}
