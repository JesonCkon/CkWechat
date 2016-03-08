<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/8
 * Time: 16:26
 */

namespace CkWechat\Core;
use CkWechat\Core\Config as Config;

abstract class AbstractApi
{
    protected $http;
    protected $accessToken;
    public function getHttp()
    {
        if (is_null($this->http)) {
            $this->http = new Http();
        }
        return $this->http;
    }
}
?>
