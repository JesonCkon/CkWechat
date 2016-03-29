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
    public function setPath($path='')
    {
        $this->file_path = $path;
    }
    public function get($media_id, $path = null, $callback = null)
    {
        $get_data['access_token'] = $this->di->access_token;
        $get_data['media_id'] = $media_id;
        $download_url = $this->http->buildApiUrl(ApiUrl::MEDIA_GET, $get_data);
        if (empty($path)) {
            $path = $this->file_path.DataBase::get_real_filename(get_headers($download_url));
        }
        $this->http->download($download_url, $path, $callback);
    }
}
