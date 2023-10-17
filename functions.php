<?php
defined('ABSPATH') || exit;

function theme_setup()
{
  // 缩略图功能
  add_theme_support('post-thumbnails');
  // 开启友情链接功能
  add_filter('pre_option_link_manager_enabled', '__return_true');
  // 小工具选择性刷新
  add_theme_support('customize-selective-refresh-widgets');
}
add_action('after_setup_theme', 'theme_setup');

function widget_init()
{

  register_sidebar(array(
    'name'          => '首页模块',
    'id'            => 'home-module',
    'description'   => '首页模块主内容区域',
    'before_widget' => '<div id="%1$s" class="home-widget %2$s">',
    'after_widget'  => '</div>',
  ));

  register_sidebar(array(
    'name'          => '文章侧边栏',
    'id'            => 'single-sidebar',
    'description'   => '文章模块侧边栏区域',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
  ));
}
add_action('widgets_init', 'widget_init');

// codestar framework
require_once get_template_directory() . '/inc/template-csf.php';

// 加载静态资源
require_once get_template_directory() . '/inc/template-assets.php';

// 主题性能优化
require_once get_template_directory() . '/inc/template-clean.php';

// 主题hooks
require_once get_template_directory() . '/inc/template-hooks.php';

// ajax
require_once get_template_directory() . '/inc/template-ajax.php';

