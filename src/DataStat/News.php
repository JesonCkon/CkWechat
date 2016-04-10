<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/10
 * Time: 17:15.
 */
namespace CkWechat\DataStat;

use CkWechat\Core\AbstractApi as AbstractApi;
use CkWechat\Core\ApiUrl as ApiUrl;
use CkWechat\Core\DataBase as DataBase;

class News extends AbstractApi
{
    public function getArticlesummary($begin_date = '', $end_date = '', $callback = null)
    {
        $this->setTokenUrl(ApiUrl::DATASTAT_GETARTICLESUMMARY);
        $post_data = array();
        $post_data['begin_date'] = $begin_date;
        $post_data['end_date'] = $end_date;
        $ch = $this->http->post(DataBase::toWxJson($post_data));

        return array('result' => $ch->rawResponse);
    }

    public function getArticletotal($begin_date = '', $end_date = '', $callback = null)
    {
        $this->setTokenUrl(ApiUrl::DATASTAT_GETARTICLETOTAL);
        $post_data = array();
        $post_data['begin_date'] = $begin_date;
        $post_data['end_date'] = $end_date;
        $ch = $this->http->post(DataBase::toWxJson($post_data));

        return array('result' => $ch->rawResponse);
    }
    public function getUserread($begin_date = '', $end_date = '', $callback = null)
    {
        $this->setTokenUrl(ApiUrl::DATASTAT_GETUSERREAD);
        $post_data = array();
        $post_data['begin_date'] = $begin_date;
        $post_data['end_date'] = $end_date;
        $ch = $this->http->post(DataBase::toWxJson($post_data));

        return array('result' => $ch->rawResponse);
    }
    public function getUserreadhour($begin_date = '', $end_date = '', $callback = null)
    {
        $this->setTokenUrl(ApiUrl::DATASTAT_GETUSERREADHOUR);
        $post_data = array();
        $post_data['begin_date'] = $begin_date;
        $post_data['end_date'] = $end_date;
        $ch = $this->http->post(DataBase::toWxJson($post_data));

        return array('result' => $ch->rawResponse);
    }
    public function getUsershare($begin_date = '', $end_date = '', $callback = null)
    {
        $this->setTokenUrl(ApiUrl::DATASTAT_GETUSERSHARE);
        $post_data = array();
        $post_data['begin_date'] = $begin_date;
        $post_data['end_date'] = $end_date;
        $ch = $this->http->post(DataBase::toWxJson($post_data));

        return array('result' => $ch->rawResponse);
    }
    public function getUsersharehour($begin_date = '', $end_date = '', $callback = null)
    {
        $this->setTokenUrl(ApiUrl::DATASTAT_GETUSERSHAREHOUR);
        $post_data = array();
        $post_data['begin_date'] = $begin_date;
        $post_data['end_date'] = $end_date;
        $ch = $this->http->post(DataBase::toWxJson($post_data));

        return array('result' => $ch->rawResponse);
    }
}
