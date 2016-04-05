<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/5
 * Time: 17:24.
 */
namespace CkWechat\ReceiveMessage;

use CkWechat\Core\AbstractApi as AbstractApi;

class ButtonMessage extends AbstractApi
{
    use Event {
      Event::__construct as private __eventConstruct;
    }
    public $xml_data = '';
    public function __construct()
    {
        $args_tmp = func_get_args();
        parent::__construct($args_tmp[0]);
        $this->__eventConstruct();
    }
}
