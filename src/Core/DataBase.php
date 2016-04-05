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
    public static function toWxJson($data, $options = JSON_UNESCAPED_UNICODE)
    {
        if (is_string($data)) {
            json_decode($data);
            if ((json_last_error() == JSON_ERROR_NONE) == false) {
                $data = json_encode($data, $options);
            } else {
                return false;
            }
        } elseif (is_array($data)) {
            $data = json_encode($data, $options);
        } else {
            return false;
        }

        return $data;
    }
    public static function checkJson($string = '')
    {
        $res = null;
        $res = json_decode($string);
        if (json_last_error() == JSON_ERROR_NONE) {
            return $res;
        } else {
            return false;
        }
    }
    public static function getJsonByKey($json_str,$key)
    {
        $json_data = self::checkJson();
        if ($json_data) {
          return $json[$key];
        }
        return false;
    }
    public static function toXml($data)
    {
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
    public static function makeXmlStr($data)
    {
        $str = '';
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (is_numeric($value)) {
                    $str .= '<'.$key.'>'.$value.'</'.$key.'>';
                } elseif (is_string($value)) {
                    $str .= '<'.$key.'><![CDATA['.$value.']]></'.$key.'>';
                } elseif (is_array($value)) {
                    $str .= '<'.$key.'>'.self::makeXmlStr($value).'</'.$key.'>';
                }
            }
        }

        return $str;
    }
    public static function xmlToArray($string = '')
    {
        libxml_use_internal_errors(true);
        $result = simplexml_load_string($string, 'SimpleXMLElement', LIBXML_NOCDATA);
        if (!$result) {
            return false;
        }
        $result = json_decode(json_encode($result), true);

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
    public static function makeNonceStr($length = 32)
    {
        $str = '';
        for ($i = 0; $i < $length; ++$i) {
            $str .= chr(mt_rand(33, 126));
        }

        return md5($str);
    }
    //商户订单号（每个订单号必须唯一） 组成：mch_id+yyyymmdd+10位一天内不能重复的数字。接口根据商户订单号支持重入，如出现超时可再调用。
    public static function buildBillno($mch_id)
    {
        return $mch_id.date('Ymd', time()).(microtime(true) * 1000);
    }
    public static function outString($data, $out_type = 'string')
    {
        if (is_string($data) && $out_type == 'string') {
            ob_clean();
            header('Content-Type: text/html; charset=utf-8');
            echo $data;
        } elseif ($out_type == 'wx_xml') {
            ob_clean();
            header('Content-Type: text/html; charset=utf-8');
            if (is_string($data)) {
                echo $data;
            } else {
                echo self::toXml($data);
            }
        }
    }
    public static function getUrlCode($url = '')
    {
        if (empty($url)) {
            return false;
        }
        $headers = get_headers($url);

        return (int) substr($headers[0], 9, 3);
    }
    public static function get_real_filename($headers)
    {
        foreach ($headers as $header) {
            if (strpos(strtolower($header), 'content-disposition') !== false) {
                $tmp_name = explode('=', $header);
                if ($tmp_name[1]) {
                    return trim($tmp_name[1], '";\'');
                }
            }
        }

        return false;
    }
}
