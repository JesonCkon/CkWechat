<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/8
 * Time: 16:59
 */

namespace CkWechat\Core;
use CkWechat\Core\Curl as Curl;

class Http
{
  public $url;
  public function __construct($url,$params = array())
  {
      $this->url = self::buildApiUrl($url, $params);
  }
  public static function buildApiUrl($url, $params)
  {
      $url .= '?'.http_build_query($params);

      return $url;
  }
  public function get()
  {
    # code...
  }
  public function post($post_data='')
  {
    # code...
  }
}
