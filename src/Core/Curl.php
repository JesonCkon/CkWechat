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
    public $curl = null;

    public $headers = array();
    public $curl_proxy_host = '0.0.0.0';
    public $curl_proxy_port = 0;

    public $sslcert_path = '';
    public $sslkey_path = '';
    public $useCert = false;
    public $is_ssl = false;

    public $requestHeaders = null;
    public $responseHeaders = null;
    public $rawResponseHeaders = '';
    public $response = null;
    public $rawResponse = null;

    public $beforeSendFunction = null;

    public function __construct()
    {
        $this->setCurl();
        $this->setHeader();
        $this->setProxy();
        $this->setOpt(CURLINFO_HEADER_OUT, true);
        $this->setOpt(CURLOPT_RETURNTRANSFER, true);
    }
    public function setUrl($url, $data = array())
    {
        $this->baseUrl = $url;
        $this->url = $this->buildUrl($url, $data);
        $this->setOpt(CURLOPT_URL, $this->url);
    }
    private function buildUrl($url, $data = array())
    {
        return $url.(empty($data) ? '' : '?'.http_build_query($data));
    }
    public function setCurl()
    {
        $this->curl = curl_init();
    }
    public function setProxy()
    {
        if ($this->curl_proxy_host != '0.0.0.0' && $this->curl_proxy_port != 0) {
            $this->setOpt(CURLOPT_PROXY, $this->curl_proxy_host);
            $this->setOpt(CURLOPT_PROXYPORT, $this->curl_proxy_port);
        }
    }
    public function setSSL()
    {
        if ($this->is_ssl == true) {
            $this->setOpt(CURLOPT_SSL_VERIFYPEER, true);
            $this->setOpt(CURLOPT_SSL_VERIFYHOST, 2);
        } else {
            $this->setOpt(CURLOPT_SSL_VERIFYPEER, false);
            $this->setOpt(CURLOPT_SSL_VERIFYHOST, false);
        }
        if ($this->useCert == true) {
            $this->setOpt(CURLOPT_SSLCERTTYPE, 'PEM');
            $this->setOpt(CURLOPT_SSLCERT, $this->sslcert_path);
            $this->setOpt(CURLOPT_SSLKEYTYPE, 'PEM');
            $this->setOpt(CURLOPT_SSLKEY, $this->sslkey_path);
            $this->setOpt(CURLOPT_CAINFO, $this->cainfo_path);
        }
    }
    public function setHeader()
    {
        if (count($this->headers) >= 1) {
            $this->setOpt(CURLOPT_HTTPHEADER, $this->headers);
        } else {
            $this->setOpt(CURLOPT_HEADER, false);
        }
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
        $this->setSSL();
        $this->call($this->beforeSendFunction);
        $this->rawResponse = curl_exec($this->curl);
        $this->curlErrorCode = curl_errno($this->curl);
    }
    public function get($url, $params = array(), $callback = null)
    {
        $this->setUrl($url, $params);
        $this->beforeSend($callback);
        $this->run();
    }
    public function post($url, $data)
    {
        $this->setUrl($url);
        $this->setOpt(CURLOPT_CUSTOMREQUEST, 'POST');
        $this->setOpt(CURLOPT_POST, true);
        $this->setOpt(CURLOPT_POSTFIELDS, $data);
        $this->run();
    }
    public function close()
    {
        if (is_resource($this->curl)) {
            curl_close($this->curl);
        }
    }
    public function outJson()
    {
        if ($this->rawResponse) {
            $this->jsonData = json_decode($this->rawResponse, true);
        }

        return $this;
    }
    public function jsonGet($keyname = '')
    {
        return isset($this->jsonData[$keyname]) ? $this->jsonData[$keyname] : '';
    }
    /*
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
    }*/
}
