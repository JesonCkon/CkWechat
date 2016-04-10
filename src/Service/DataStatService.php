<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/10
 * Time: 17:41
 */

namespace CkWechat\Service;
use CkWechat\Core\Container as Container;
use CkWechat\DataStat\User as DataStatUser;
use CkWechat\DataStat\News as DataStatNews;
use CkWechat\DataStat\Message as DataStatMessage;

class DataStatService implements ServiceInterface
{
    public function register(Container $obj)
    {
        $obj->dataStatUser = function ($obj) {
          return new DataStatUser($obj);
        };
        $obj->dataStatNews = function ($obj) {
          return new DataStatNews($obj);
        };
        $obj->dataStatMessage = function ($obj) {
          return new DataStatMessage($obj);
        };
    }
}
