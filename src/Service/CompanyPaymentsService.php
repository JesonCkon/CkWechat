<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/17
 * Time: 17:30
 */

namespace CkWechat\Service;
use CkWechat\Core\Container as Container;
use CkWechat\Pay\CompanyPayments as CompanyPayments;

class CompanyPaymentsService implements ServiceInterface
{
  public function register(Container $obj)
  {
      $obj->companyPayments = function ($obj) {
        return new CompanyPayments($obj);
      };
  }
}
