<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/3/14
 * Time: 14:02.
 */
namespace CkWechat\Core;

class DataBase
{
    public static function toXml($data)
    {
        if (!is_array($data) || count($data) <= 0) {
            throw new \Exception('数组数据异常！');
        }

        $xml = '<xml>';
        foreach ($data as $key => $val) {
            if (is_numeric($val)) {
                $xml .= '<'.$key.'>'.$val.'</'.$key.'>';
            } else {
                $xml .= '<'.$key.'><![CDATA['.$val.']]></'.$key.'>';
            }
        }
        $xml .= '</xml>';

        return $xml;
    }
    public static function xmlToArray($string = '')
    {
        libxml_use_internal_errors(true);
        $result = simplexml_load_string($string, 'SimpleXMLElement', LIBXML_NOCDATA);
        if (!$result) {
            return false;
        }

        return $result;
    }
    public static function wxMakeSign($post_data, $key)
    {
        //签名步骤一：按字典序排序参数
        ksort($post_data);
        $string = self::toUrlParams($post_data);
        //签名步骤二：在string后加入KEY
        $string = $string.'&key='.$key;
        //签名步骤三：MD5加密
        $string = md5($string);
        //签名步骤四：所有字符转为大写
        $result = strtoupper($string);

        return $result;
    }
    public static function toUrlParams($post_data)
    {
        $buff = '';
        foreach ($post_data as $k => $v) {
            if ($k != 'sign' && $v != '' && !is_array($v)) {
                $buff .= $k.'='.$v.'&';
            }
        }

        $buff = trim($buff, '&');

        return $buff;
    }
    public static function makeNonceStr($length=32)
    {
          $str = '';
          for ($i = 0; $i < $length; $i++)
          {
              $str .= chr(mt_rand(33, 126));
          }
          return $str;
    }
}
