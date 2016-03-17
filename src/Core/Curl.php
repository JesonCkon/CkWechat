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
    public $completeFunction = null;
    public $post_data;

    public function __construct()
    {
        $this->setCurl();
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
    public function getOpt($option)
    {
        return $this->options[$option];
    }
    public function beforeSend($callback)
    {
        $this->beforeSendFunction = $callback;
    }
    public function complete($callback)
    {
        $this->completeFunction = $callback;
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

        $this->setHeader();
        $this->setProxy();

        $this->setOpt(CURLINFO_HEADER_OUT, true);
        $this->setOpt(CURLOPT_RETURNTRANSFER, true);

        $this->call($this->beforeSendFunction);
        $this->rawResponse = curl_exec($this->curl);
        $this->curlErrorCode = curl_errno($this->curl);
        $this->curlErrorMessage = curl_error($this->curl);
        $this->curlError = !($this->curlErrorCode === 0);
        $this->httpStatusCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
        $this->httpError = in_array(floor($this->httpStatusCode / 100), array(4, 5));
        $this->error = $this->curlError || $this->httpError;
        $this->errorCode = $this->error ? ($this->curlError ? $this->curlErrorCode : $this->httpStatusCode) : 0;
        $this->effectiveUrl = curl_getinfo($this->curl, CURLINFO_EFFECTIVE_URL);

        $this->call($this->completeFunction);

        return $this;
    }
    public function get($url, $params = array(), $callback = null)
    {
        $this->setUrl($url, $params);
        $this->beforeSend($callback);
        $this->run();
    }
    public function post($url, $data, $callback = null)
    {
        $this->post_data = $data;
        $this->setUrl($url);
        $this->setOpt(CURLOPT_CUSTOMREQUEST, 'POST');
        $this->setOpt(CURLOPT_POST, true);
        $this->setOpt(CURLOPT_POSTFIELDS, $data);
        $this->beforeSend($callback);
        $this->run();
    }
    public function close()
    {
        if (is_resource($this->curl)) {
            curl_close($this->curl);
            $this->curl = null;
        }
    }
}
