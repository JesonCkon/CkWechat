<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/17
 * Time: 16:27
 */

namespace CkWechat\Service;
use CkWechat\Core\Container as Container;
use CkWechat\Pay\CouponStock as CouponStock;

class CouponStockService implements ServiceInterface
{
  public function register(Container $obj)
  {
      $obj->couponStock = function ($obj) {
        return new CouponStock($obj);
      };
  }
}
