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

class Media extends AbstractApi
{
    public function get($media_id, $path, $callback = null)
    {
        $download_url = $this->http->buildApiUrl(ApiUrl::MEDIA_GET, $get_data);
        $this->http->download($download_url, $callback);
    }
}
