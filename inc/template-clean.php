<?php

/**
 * 主题性能优化，去除无用功能
 */
new theme_clean;

class theme_clean
{

  public function __construct()
  {
    add_filter('show_admin_bar', '__return_false');
  }
}
