<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/10
 * Time: 17:07.
 */
namespace CkWechat\DataStat;

use CkWechat\Core\AbstractApi as AbstractApi;
use CkWechat\Core\ApiUrl as ApiUrl;
use CkWechat\Core\DataBase as DataBase;

class User extends AbstractApi
{
    public function getUsersummary($begin_date = '', $end_date = '', $callback = null)
    {
        $this->setTokenUrl(ApiUrl::DATASTAT_GETUSERSUMMARY);
        $post_data = array();
        $post_data['begin_date'] = $begin_date;
        $post_data['end_date'] = $end_date;
        $ch = $this->http->post(DataBase::toWxJson($post_data));

        return array('result' => $ch->rawResponse);
    }
    public function getUsercumulate($begin_date = '', $end_date = '', $callback = null)
    {
        $this->setTokenUrl(ApiUrl::DATASTAT_GETUSERCUMULATE);
        $post_data = array();
        $post_data['begin_date'] = $begin_date;
        $post_data['end_date'] = $end_date;
        $ch = $this->http->post(DataBase::toWxJson($post_data));

        return array('result' => $ch->rawResponse);
    }
}
