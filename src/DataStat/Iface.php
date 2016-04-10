<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/10
 * Time: 17:45
 */

namespace CkWechat\DataStat;

use CkWechat\Core\AbstractApi as AbstractApi;
use CkWechat\Core\ApiUrl as ApiUrl;
use CkWechat\Core\DataBase as DataBase;

class Iface extends AbstractApi
{
    public function getInterfacesummary($begin_date = '', $end_date = '', $callback = null)
    {
        $this->setTokenUrl(ApiUrl::DATASTAT_GETINTERFACESUMMARY);
        $post_data = array();
        $post_data['begin_date'] = $begin_date;
        $post_data['end_date'] = $end_date;
        $ch = $this->http->post(DataBase::toWxJson($post_data));

        return array('result' => $ch->rawResponse);
    }
    public function getinterfacesummaryhour($begin_date = '', $end_date = '', $callback = null)
    {
        $this->setTokenUrl(ApiUrl::DATASTAT_GETINTERFACESUMMARYHOUR);
        $post_data = array();
        $post_data['begin_date'] = $begin_date;
        $post_data['end_date'] = $end_date;
        $ch = $this->http->post(DataBase::toWxJson($post_data));

        return array('result' => $ch->rawResponse);
    }
}
