<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/23
 * Time: 18:04.
 */
namespace CkWechat\Foundation;

use CkWechat\Core\AbstractApi as AbstractApi;
use CkWechat\Core\ApiUrl as ApiUrl;
use CkWechat\Core\DataBase as DataBase;

class Qrcode extends AbstractApi
{
    protected $post_data = array();
    protected $post_json = '';
    public function qr_scene($scene_id = 0, $expire_seconds = 86400, $callback = null)
    {
        $expire_seconds = ($expire_seconds >= 604800) ? 604800 : $expire_seconds;
        if (is_numeric($scene_id) == false || strlen((string) $scene_id) > 32) {
            return false;
        }
        $this->http->setUrl(ApiUrl::QRCODE_CREATE, array('access_token' => $this->di->access_token));
        $this->post_data['action_name'] = 'QR_SCENE';
        $this->post_data['expire_seconds'] = $expire_seconds;
        $this->post_data['action_info'] = array('scene' => array('scene_id' => $scene_id));
        $this->post_json = DataBase::toWxJson($this->post_data);

        $ch = $this->http->post($this->post_json, $callback);
        $json_data = json_decode($ch->rawResponse, true);
        $json_data['qrcode_url'] = $this->showQrcode($json_data['ticket']);
        $json_data['qrcode_surl'] = $this->toShortUrl($json_data['qrcode_url']);

        return $json_data;
    }
    public function qr_limit_scene($scene, $callback = null)
    {
        if (is_int($scene) == true) {
            $scene = ($scene >= 100000) ? 100000 : $scene;
            $scene = ($scene < 1) ? 1 : $scene;
            $this->post_data['action_info'] = array('scene' => array('scene_id' => $scene));
            $this->post_data['action_name'] = 'QR_LIMIT_SCENE';
        }
        if (is_string($scene) == true) {
            if (strlen((string) $scene) > 64) {
                #TODO
            }
            $this->post_data['action_info'] = array('scene' => array('scene_str' => $scene));
            $this->post_data['action_name'] = 'QR_LIMIT_STR_SCENE';
        }
        $this->http->setUrl(ApiUrl::QRCODE_CREATE, array('access_token' => $this->di->access_token));
        $this->post_data['access_token'] = $this->di->access_token;
        $this->post_json = DataBase::toWxJson($this->post_data);

        $ch = $this->http->post($this->post_json, $callback);
        $json_data = json_decode($ch->rawResponse, true);
        $json_data['post_data'] = $this->post_json;
        $json_data['qrcode_url'] = $this->showQrcode($json_data['ticket']);
        $json_data['qrcode_surl'] = $this->toShortUrl($json_data['qrcode_url']);

        return $json_data;
    }
    public function toShortUrl($url, $callback = null)
    {
        $this->http->setUrl(ApiUrl::SHORTURL, array('access_token' => $this->di->access_token));
        $this->post_data = array();
        $this->post_data['action'] = 'long2short';
        $this->post_data['long_url'] = $url;
        $ch = $this->http->post(DataBase::toWxJson($this->post_data, JSON_UNESCAPED_SLASHES), $callback);
        $json_data = json_decode($ch->rawResponse, true);

        return $json_data['short_url'];
    }
    public function showQrcode($ticket)
    {
        return $this->http->buildApiUrl(ApiUrl::SHOWQRCODE, array('ticket' => $ticket));
    }
}
