<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/8
 * Time: 17:02.
 */
namespace CkWechat\CustomMenu;

use CkWechat\Core\AbstractApi as AbstractApi;
use CkWechat\Core\ApiUrl as ApiUrl;
use CkWechat\Core\DataBase as DataBase;

class Menu extends AbstractApi
{
    public $button_data = array();
    public function addButton($menu_data)
    {
        if (!isset($menu_data['type']) || !isset($menu_data['name'])) {

        }
        $this->button_data[] = $menu_data;
    }
    public function getButton($callback = null)
    {
        $this->setTokenUrl(ApiUrl::GETMENU);
        $ch = $this->http->get(array(), $callback);
        //return json_decode($ch->rawResponse,true);
        return $ch->rawResponse;
    }
    public function commit($callback = null)
    {
        $this->setTokenUrl(ApiUrl::CREATEMENU);
        $post_data = array();
        $post_data['button'] = $this->button_data;
        $this->post_json = DataBase::toWxJson($post_data);
        $ch = $this->http->post($this->post_json, $callback);

        return $ch->rawResponse;
    }
}
