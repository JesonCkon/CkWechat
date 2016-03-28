<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/28
 * Time: 13:57.
 */
namespace CkWechat\Service;

use CkWechat\Core\Container as Container;
use CkWechat\Media\Media as Media;

class MediaService implements ServiceInterface
{
    public function register(Container $obj)
    {
        $obj->media = function ($obj) {
        return new Media($obj);
      };
    }
}
