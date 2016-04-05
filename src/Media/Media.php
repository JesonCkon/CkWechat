<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/28
 * Time: 13:46.
 */
namespace CkWechat\Media;

use CkWechat\Core\AbstractApi as AbstractApi;
use CkWechat\Core\ApiUrl as ApiUrl;
use CkWechat\Core\DataBase as DataBase;

class Media extends AbstractApi
{
    protected $file_path = '';
    protected $post_json = '';
    public function setPath($path = '')
    {
        $this->file_path = $path;
    }
    public function get($media_id, $save_path = null, $callback = null)
    {
        $get_data['access_token'] = $this->di->access_token;
        $get_data['media_id'] = $media_id;
        $download_url = $this->http->buildApiUrl(ApiUrl::MEDIA_GET, $get_data);
        if (empty($save_path)) {
            $save_path = $this->file_path.DataBase::get_real_filename(get_headers($download_url));
        }

        return $this->http->download($download_url, $save_path, $callback);
    }
    public function upload($file_path, $callback = null, $media_type = 'image')
    {
        $upload_url = $get_data = $ch = null;
        $get_data['access_token'] = $this->di->access_token;
        $get_data['type'] = $media_type;
        $upload_url = $this->http->buildApiUrl(ApiUrl::MEDIA_UPLOAD, $get_data);
        $this->http->setUrl($upload_url);
        $file_data = array('media' => '@'.$file_path);
        $ch = $this->http->post($file_data, $callback);

        return $ch->rawResponse;
    }
    public function addNews($articles, $callback = null)
    {
        $get_data['access_token'] = $this->di->access_token;
        $url = $this->http->buildApiUrl(ApiUrl::MEDIA_ADD_NEWS, $get_data);
        $this->http->setUrl($url);
        $this->post_json = null;
        $this->post_json = DataBase::toWxJson(array('articles' => $articles));
        $ch = $this->http->post($this->post_json, $callback);
        $media_id = DataBase::getJsonByKey($ch->rawResponse, 'media_id');

        return array('rawResponse' => $ch->rawResponse, 'media_id' => $media_id);
    }
    public function updateNews($media_id, $index, $articles, $callback = null)
    {
        $this->setTokenUrl(ApiUrl::MEDIA_UPDATE_NEWS);
        $this->post_json = null;
        $post_data = array();
        $post_data['media_id'] = $media_id;
        $post_data['index'] = $index;
        $post_data['articles'] = $articles;
        $this->post_json = DataBase::toWxJson($post_data);
        $ch = $this->http->post($this->post_json, $callback);

        return array('rawResponse' => $ch->rawResponse);
    }
    public function delNews($media_id = '', $callback = null)
    {
        $this->setTokenUrl(ApiUrl::MEDIA_DEL);
        $this->post_json = null;
        $this->post_json = DataBase::toWxJson(array('media_id' => $media_id));
        $ch = $this->http->post($this->post_json, $callback);

        return $ch->rawResponse;
    }
    public function uploadNewsImg($file_path, $callback = null)
    {
        $this->setTokenUrl(ApiUrl::MEDIA_ADD_NEWS_IMG);
        $file_data = array('media' => '@'.$file_path);
        $ch = $this->http->post($file_data, $callback);

        return $ch->rawResponse;
    }
    public function uploadMatrial($file_path, $callback = null, $media_type = 'image')
    {
        $upload_url = $get_data = $ch = null;
        $get_data['access_token'] = $this->di->access_token;
        $get_data['type'] = $media_type;
        $upload_url = $this->http->buildApiUrl(ApiUrl::MEDIA_ADD_MATERIAL, $get_data);
        $this->http->setUrl($upload_url);
        $file_data = array('media' => '@'.$file_path);
        $ch = $this->http->post($file_data, $callback);

        return $ch->rawResponse;
    }
    public function count($callback = null)
    {
        $this->http->setUrl(ApiUrl::MEDIA_COUNT);
        $this->get_data['access_token'] = $this->di->access_token;
        $ch = $this->http->get($this->get_data, $callback);
        $json_data = json_decode($ch->rawResponse, true);

        return $json_data;
    }
    public function getMatrialList($type = 'image', $offset = 0, $count = 10, $callback = null)
    {
        $this->get_data = array();
        $this->get_data['access_token'] = $this->di->access_token;
        $url = $this->http->buildApiUrl(ApiUrl::MEDIA_BATCHGET_MATERIAL, $this->get_data);
        $this->http->setUrl($url);

        $this->post_json = null;
        $post_data = array();
        $post_data['type'] = $type;
        $post_data['offset'] = intval($offset);
        $post_data['count'] = intval($count);
        $this->post_json = DataBase::toWxJson($post_data);
        $ch = $this->http->post($this->post_json, $callback);

        $json_data = json_decode($ch->rawResponse, true);

        return $json_data;
    }
}
