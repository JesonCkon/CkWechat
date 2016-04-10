<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/10
 * Time: 17:35.
 */
namespace CkWechat\DataStat;

use CkWechat\Core\AbstractApi as AbstractApi;
use CkWechat\Core\ApiUrl as ApiUrl;
use CkWechat\Core\DataBase as DataBase;

class Message extends AbstractApi
{
    public function getUpstreammsg($begin_date = '', $end_date = '', $callback = null)
    {
        $this->setTokenUrl(ApiUrl::DATASTAT_GETUPSTREAMMSG);
        $post_data = array();
        $post_data['begin_date'] = $begin_date;
        $post_data['end_date'] = $end_date;
        $ch = $this->http->post(DataBase::toWxJson($post_data));

        return array('result' => $ch->rawResponse);
    }
    public function getUpstreammsghour($begin_date = '', $end_date = '', $callback = null)
    {
        $this->setTokenUrl(ApiUrl::DATASTAT_GETUPSTREAMMSGHOUR);
        $post_data = array();
        $post_data['begin_date'] = $begin_date;
        $post_data['end_date'] = $end_date;
        $ch = $this->http->post(DataBase::toWxJson($post_data));

        return array('result' => $ch->rawResponse);
    }
    public function getUpstreammsgweek($begin_date = '', $end_date = '', $callback = null)
    {
        $this->setTokenUrl(ApiUrl::DATASTAT_GETUPSTREAMMSGWEEK);
        $post_data = array();
        $post_data['begin_date'] = $begin_date;
        $post_data['end_date'] = $end_date;
        $ch = $this->http->post(DataBase::toWxJson($post_data));

        return array('result' => $ch->rawResponse);
    }
    public function getUpstreammsgmonth($begin_date = '', $end_date = '', $callback = null)
    {
        $this->setTokenUrl(ApiUrl::DATASTAT_GETUPSTREAMMSGMONTH);
        $post_data = array();
        $post_data['begin_date'] = $begin_date;
        $post_data['end_date'] = $end_date;
        $ch = $this->http->post(DataBase::toWxJson($post_data));

        return array('result' => $ch->rawResponse);
    }
    public function getUpstreammsgdist($begin_date = '', $end_date = '', $callback = null)
    {
        $this->setTokenUrl(ApiUrl::DATASTAT_GETUPSTREAMMSGDIST);
        $post_data = array();
        $post_data['begin_date'] = $begin_date;
        $post_data['end_date'] = $end_date;
        $ch = $this->http->post(DataBase::toWxJson($post_data));

        return array('result' => $ch->rawResponse);
    }
    public function getUpstreammsgdistweek($begin_date = '', $end_date = '', $callback = null)
    {
        $this->setTokenUrl(ApiUrl::DATASTAT_GETUPSTREAMMSGDISTWEEK);
        $post_data = array();
        $post_data['begin_date'] = $begin_date;
        $post_data['end_date'] = $end_date;
        $ch = $this->http->post(DataBase::toWxJson($post_data));

        return array('result' => $ch->rawResponse);
    }
    public function getUpstreammsgdistmonth($begin_date = '', $end_date = '', $callback = null)
    {
        $this->setTokenUrl(ApiUrl::DATASTAT_GETUPSTREAMMSGDISTMONTH);
        $post_data = array();
        $post_data['begin_date'] = $begin_date;
        $post_data['end_date'] = $end_date;
        $ch = $this->http->post(DataBase::toWxJson($post_data));

        return array('result' => $ch->rawResponse);
    }
}
