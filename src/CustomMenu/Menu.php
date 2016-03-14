<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/8
 * Time: 17:02.
 */

namespace CkWechat\CustomMenu;

class Menu
{
    public function add($menu_data)
    {
        #echo 333;
        #$params = array('access_token' => $this->access_token);
        #$http = new Core\Http();
        #fix wechat api rule post body is json string and JSON_UNESCAPED_UNICODE
        #return $this->http->post(ApiUrl::CREATEMENU, $params, $menu_data);
    }
}
