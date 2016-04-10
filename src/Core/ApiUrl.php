<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/15
 * Time: 15:56.
 */
namespace CkWechat\Core;

class ApiUrl
{
    //back server
    const ACCESSTOKEN = 'https://api.weixin.qq.com/cgi-bin/token';
    const BACKIPS = 'https://api.weixin.qq.com/cgi-bin/getcallbackip';

    //wechat menu
    const CREATEMENU = 'https://api.weixin.qq.com/cgi-bin/menu/create';
    const GETMENU = 'https://api.weixin.qq.com/cgi-bin/menu/get';
    const DELETEMENU = 'https://api.weixin.qq.com/cgi-bin/menu/delete';
    const GET_CURRENT_SELFMENU_INFO = 'https://api.weixin.qq.com/cgi-bin/get_current_selfmenu_info';

    //user account
    const USER_GET = 'https://api.weixin.qq.com/cgi-bin/user/get';
    const USER_GET_INFO = 'https://api.weixin.qq.com/cgi-bin/user/info';
    const USER_BATCHGET_INFO = 'https://api.weixin.qq.com/cgi-bin/user/info/batchget';
    const USER_UPDATEREMARK = 'https://api.weixin.qq.com/cgi-bin/user/info/updateremark';

    // user group
    const GROUP_ADD = 'https://api.weixin.qq.com/cgi-bin/groups/create';
    const GROUP_GET = 'https://api.weixin.qq.com/cgi-bin/groups/get';
    const GROUP_GETID = 'https://api.weixin.qq.com/cgi-bin/groups/getid';
    const GROUP_UPDATE = 'https://api.weixin.qq.com/cgi-bin/groups/update';
    const GROUP_MEMBERS_UPDATE = 'https://api.weixin.qq.com/cgi-bin/groups/members/update';
    const GROUP_MEMBERS_BATCHUPDATE = 'https://api.weixin.qq.com/cgi-bin/groups/members/batchupdate';
    const GROUP_DEL = 'https://api.weixin.qq.com/cgi-bin/groups/delete';

    //custom service
    const SERVICE_SEND = 'https://api.weixin.qq.com/cgi-bin/message/custom/send';
    const SERVICE_USER_ADD = 'https://api.weixin.qq.com/customservice/kfaccount/add';
    const SERVICE_USER_GET = 'https://api.weixin.qq.com/cgi-bin/customservice/getkflist';
    const SERVICE_USER_OL_GET = 'https://api.weixin.qq.com/cgi-bin/customservice/getonlinekflist';
    const SERVICE_USER_UPDATE = 'https://api.weixin.qq.com/customservice/kfaccount/update';
    const SERVICE_USER_DEL = 'https://api.weixin.qq.com/customservice/kfaccount/del';
    const SERVICE_USER_UPLOADHEADIMG = 'http://api.weixin.qq.com/customservice/kfaccount/uploadheadimg';

    //多媒体上传下载
    const MEDIA_GET = 'http://file.api.weixin.qq.com/cgi-bin/media/get';
    const MEDIA_UPLOAD = 'https://api.weixin.qq.com/cgi-bin/media/upload';
    const MEDIA_COUNT = 'https://api.weixin.qq.com/cgi-bin/material/get_materialcount';
    const MEDIA_ADD_NEWS = 'https://api.weixin.qq.com/cgi-bin/material/add_news';
    const MEDIA_UPDATE_NEWS = 'https://api.weixin.qq.com/cgi-bin/material/update_news';
    const MEDIA_DEL = 'https://api.weixin.qq.com/cgi-bin/material/del_material';
    const MEDIA_ADD_NEWS_IMG = 'https://api.weixin.qq.com/cgi-bin/media/uploadimg';
    const MEDIA_ADD_MATERIAL = 'https://api.weixin.qq.com/cgi-bin/material/add_material';
    const MEDIA_BATCHGET_MATERIAL = 'https://api.weixin.qq.com/cgi-bin/material/batchget_material';

    //群发消息
    const MESSAGE_MEDIA_NEWS_UPLOAD = 'https://api.weixin.qq.com/cgi-bin/media/uploadnews';
    const MESSAGE_MEDIA_VIDEO_UPLOAD = 'https://api.weixin.qq.com/cgi-bin/media/uploadvideo';
    const MESSAGE_SEND_ALL = 'https://api.weixin.qq.com/cgi-bin/message/mass/sendall';
    const MESSAGE_SEND_OPENID = 'https://api.weixin.qq.com/cgi-bin/message/mass/send';
    const MESSAGE_DELETE = 'https://api.weixin.qq.com/cgi-bin/message/mass/delete';
    const MESSAGE_PREVIEW = 'https://api.weixin.qq.com/cgi-bin/message/mass/preview';
    const MESSAGE_GET = 'https://api.weixin.qq.com/cgi-bin/message/mass/get';

    //二维码
    const QRCODE_CREATE = 'https://api.weixin.qq.com/cgi-bin/qrcode/create';
    const SHOWQRCODE = 'https://mp.weixin.qq.com/cgi-bin/showqrcode';
    const SHORTURL = 'https://api.weixin.qq.com/cgi-bin/shorturl';

    //商户api
    //现金红包
    const SENDREDPACK = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack';
    const GETHBINFO = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/gethbinfo';
    const SENDGROUPREDPACK = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendgroupredpack';
    //代金券
    const QUERY_COUPON_STOCK = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/query_coupon_stock';
    const SEND_COUPON = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/send_coupon';
    //企业付款
    const PROMOTION_TRANSFERS = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers';
}
