<?php
/**
 * Created by PhpStorm.
 * User: kontem
 * Date: 16/4/7
 * Time: 14:50.
 */
namespace CkWechat\ReceiveMessage;

trait Push
{
    /**
   * 扫码推事件的事件推送
   *
   * @method scancodePush
   *
   * @param string  $key
   * @param closure $callback
   */
  public function scancodePush($key = '', $callback = null)
  {
      echo "here";
      $this->post_data = null;
      if ($this->message_type == 'event' && $this->message_event == 'scancode_push') {
          $this->post_data = $this->checkXmlByKey('EventKey', $key);
          $this->post_data and $this->call($callback);
      }

      return $this;
  }
  /**
   * 扫码推事件且弹出“消息接收中”提示框的事件推送
   *
   * @method scancodeWaitmsg
   *
   * @param string  $key
   * @param closure $callback
   */
  public function scancodeWaitmsg($key = '', $callback = null)
  {
      $this->post_data = null;
      if ($this->message_type == 'event' && $this->message_event == 'scancode_waitmsg') {
          $this->post_data = $this->checkXmlByKey('EventKey', $key);
          $this->post_data and $this->call($callback);
      }

      return $this;
  }
  /**
   * 弹出系统拍照发图的事件推送
   *
   * @method picSysphoto
   *
   * @param  string      $key
   * @param  closure      $callback
   */
  public function picSysphoto($key = '', $callback = null)
  {
      $this->post_data = null;
      if ($this->message_type == 'event' && $this->message_event == 'pic_sysphoto') {
          $this->post_data = $this->checkXmlByKey('EventKey', $key);
          $this->post_data and $this->call($callback);
      }

      return $this;
  }
  /**
   * 弹出拍照或者相册发图的事件推送
   *
   * @method picPhotoAlbum
   *
   * @param  string        $value [description]
   *
   * @return closure        [description]
   */
  public function picPhotoAlbum($key = '', $callback = null)
  {
      $this->post_data = null;
      if ($this->message_type == 'event' && $this->message_event == 'pic_photo_or_album') {
          $this->post_data = $this->checkXmlByKey('EventKey', $key);
          $this->post_data and $this->call($callback);
      }

      return $this;
  }
  /**
   * 弹出微信相册发图器的事件推送
   *
   * @method picWeixin
   *
   * @param  string    $key      [description]
   * @param  closure    $callback [description]
   *
   * @return [type]    [description]
   */
  public function picWeixin($key = '', $callback = null)
  {
      $this->post_data = null;
      if ($this->message_type == 'event' && $this->message_event == 'pic_photo_or_album') {
          $this->post_data = $this->checkXmlByKey('EventKey', $key);
          $this->post_data and $this->call($callback);
      }

      return $this;
  }
  /**
   * 弹出地理位置选择器的事件推送
   * @method locationSelect
   * @param  string         $key
   * @param  closure         $callback
   */

  public function locationSelect($key = '', $callback = null)
  {
      $this->post_data = null;
      if ($this->message_type == 'event' && $this->message_event == 'location_select') {
          $this->post_data = $this->checkXmlByKey('EventKey', $key);
          $this->post_data and $this->call($callback);
      }

      return $this;
  }
}
