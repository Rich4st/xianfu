<?php

new CCK();

/**
 * Cpalot Cookie Kit
 *
 */
class CCK
{

  public function __construct()
  {
  }

  public static function get($key)
  {
    return $_COOKIE[$key];
  }

  public static function set($key, $value, $expire = 0)
  {
    setcookie($key, $value, $expire);
  }

  public static function delete($key)
  {
    setcookie($key, '', time() - 3600);
  }

  public static function clear()
  {
    foreach ($_COOKIE as $key => $value) {
      setcookie($key, '', time() - 3600);
    }
  }

  // 判断cookie是否存在
  public static function has($key)
  {
    return isset($_COOKIE[$key]);
  }
}
