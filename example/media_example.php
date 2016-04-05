<?php

/*
$file_path = '/Users/kontem/workspace/github_project/CkWechat/example/test.png';

$app->media->upload($file_path);

$app->media->upload($file_path, function () {
    var_dump($this);
});
*/
//get media id swnMpvJAtroK_Na5SYxRMRsT81YMr9LHmlJwHrbZgNhcSZs7WoSBqUDGM1LA8z_G

/*
$id='swnMpvJAtroK_Na5SYxRMRsT81YMr9LHmlJwHrbZgNhcSZs7WoSBqUDGM1LA8z_G';
$save_path = '/Users/kontem/workspace/github_project/CkWechat/example/res.png';
$res = $app->media->get($id,$save_path);
var_dump($res);
*/

/*
$file_path = '/Users/kontem/workspace/github_project/CkWechat/example/test.png';

$file_data = $app->media->uploadMatrial($file_path);
//var_dump($file_data);
$url_info = json_decode($file_data,true);
var_dump($url_info);
exit;*/

/*
$data = array();

$data[0]['title'] = '永久素材上传测试';
$data[0]['thumb_media_id'] = '1VR-lO9dQ3g3dFENztI3Er7Y21SRamVZwOZaGC13_pk';
$data[0]['author'] = '超级管理员';
$data[0]['digest'] = '永久素材上传测试_简要';
$data[0]['digest'] = '永久素材上传测试_简要';
//是否显示封面，0为false，即不显示，1为true，即显示
$data[0]['show_cover_pic'] = 1;
$data[0]['content'] = '<h5>屌屌你好不好</h5>';
$data[0]['content_source_url'] = 'http://www.ycool.me/';

$res = $app->media->addNews($data,function ()
{
  //echo 3333;
});

var_dump($res);

/*
$res = $app->media->count();
var_dump($res);
*/
/*
$res = $app->media->delNews('1VR-lO9dQ3g3dFENztI3EjN780Dutdld12_nvFe6rSk');
var_dump($res);
$res = $app->media->delNews('1VR-lO9dQ3g3dFENztI3EjG2RgwOiNCpJuEKJ1g_gCY');
var_dump($res);
*/
/*
$type ='news';
$offset=0;
$count=20;
$res = $app->media->getMatrialList($type,$offset,$count);
var_dump($res);

*/

$media_id = '';
$index = 0;
$data = array();

$data[0]['title'] = '永久素材上传测试';
$data[0]['thumb_media_id'] = '1VR-lO9dQ3g3dFENztI3Er7Y21SRamVZwOZaGC13_pk';
$data[0]['author'] = '超级管理员';
$data[0]['digest'] = '永久素材上传测试_简要';
$data[0]['digest'] = '永久素材上传测试_简要';
//是否显示封面，0为false，即不显示，1为true，即显示
$data[0]['show_cover_pic'] = 1;
$data[0]['content'] = '<h5>屌屌你好不好</h5>';
$data[0]['content_source_url'] = 'http://www.ycool.me/';

$res = $app->media->updateNews($media_id, $index, $data, function () {
  //echo 3333;
});

var_dump($res);
