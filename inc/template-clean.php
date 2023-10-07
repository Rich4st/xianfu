<?php

/**
 * 主题性能优化，去除无用功能
 */
new theme_clean;

class theme_clean
{

  public function __construct()
  {
    // 关闭顶部导航栏
    add_filter('show_admin_bar', '__return_false');

    // 关闭古腾堡编辑器
    if (!_capalot('gutenberg_edit')) {
      add_filter('use_block_editor_for_post', '__return_false');
      remove_action('wp_enqueue_scripts', 'wp_common_block_scripts_and_styles');
    }

    // 禁用古腾堡小工具
    if (!_capalot('gutenberg_widgets', false)) {
      // Disables the block editor from managing widgets in the Gutenberg plugin.
      add_filter('gutenberg_use_widgets_block_editor', '__return_false');
      // Disables the block editor from managing widgets.
      add_filter('use_widgets_block_editor', '__return_false');
    }
  }
}
