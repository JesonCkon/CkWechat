<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/15
 * Time: 15:56
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

    //user account
    const GETUSERS = 'https://api.weixin.qq.com/cgi-bin/user/get';
    const GETUSERINFO = 'https://api.weixin.qq.com/cgi-bin/user/info';
    const SETUSERMARK = 'https://api.weixin.qq.com/cgi-bin/user/info/updateremark';
    const UPDATEREMARK = 'https://api.weixin.qq.com/cgi-bin/user/info/updateremark';

    // user group
    const CREATEGROUPS = 'https://api.weixin.qq.com/cgi-bin/groups/create';
    const GETGROUPS = 'https://api.weixin.qq.com/cgi-bin/groups/get';
    const GETUSERGROUPS = 'https://api.weixin.qq.com/cgi-bin/groups/getid';
    const UPDATEGROUPS = 'https://api.weixin.qq.com/cgi-bin/groups/update';
    const UPDATEUSERGROUPS = 'https://api.weixin.qq.com/cgi-bin/groups/members/update';
    const BATCHUPDATEUSERSGROUPS = 'https://api.weixin.qq.com/cgi-bin/groups/members/batchupdate';
    const DELETEGROUPS = 'https://api.weixin.qq.com/cgi-bin/groups/delete';

    //custom service
    const MESSAGECUSTOMSEND = 'https://api.weixin.qq.com/cgi-bin/message/custom/send';
    const KFACCOUNTADD = 'https://api.weixin.qq.com/customservice/kfaccount/add';
    const GETKFACCOUNT = 'https://api.weixin.qq.com/cgi-bin/customservice/getkflist';
    const UPDATEKFACCOUNT = 'https://api.weixin.qq.com/customservice/kfaccount/update';
    const DELKFACCOUNT = 'https://api.weixin.qq.com/customservice/kfaccount/del';
    const UPKFACCOUNTIMG='http://api.weixin.qq.com/customservice/kfaccount/uploadheadimg';

    //商户api
    const REDENVELOPES_SEND = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack';
    const REDENVELOPES_QUERY = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/gethbinfo';
}
