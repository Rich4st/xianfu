<?php
defined('ABSPATH') || exit;

// vite hmr
function vite_dev_script()
{
  if (
    !defined('VITE_ENV') ||
    !defined('VITE_DEV_SERVER') ||
    constant('VITE_ENV') !== 'development'
  ) {
    return;
  }

  $entry_file = constant('VITE_DEV_SERVER') . 'vite.entry.js';

  echo '<script type="module" src="' . esc_attr($entry_file) . '"></script>';
}

add_action('wp_head', 'vite_dev_script');

function theme_setup()
{
  // 缩略图功能
  add_theme_support('post-thumbnails');
  // 开启友情链接功能
  add_filter('pre_option_link_manager_enabled', '__return_true');
  // 小工具选择性刷新
  add_theme_support('customize-selective-refresh-widgets');
  // 顶部菜单
  register_nav_menus(
    array(
      'main-menu' => '全站顶部菜单',
    )
  );
}
add_action('after_setup_theme', 'theme_setup');

function widget_init()
{

  register_sidebar(array(
    'id'            => 'home-module',
    'name'          => '首页模块',
    'description'   => '首页模块主内容区域',
    'before_widget' => '<div id="%1$s" class="home-widget %2$s">',
    'after_widget'  => '</div>',
  ));

  register_sidebar(array(
    'id'            => 'single-sidebar',
    'name'          => '文章侧边栏',
    'description'   => '文章模块侧边栏区域',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
  ));

  register_sidebar(array(
    'id'          => 'page-sidebar',
    'name'        => '其他页面侧边',
    'description' => '其他页面侧边栏区域',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
  ));

}
add_action('widgets_init', 'widget_init');

// core
require_once get_template_directory() . '/inc/capalot.php';

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

// 重写内置类
require_once get_template_directory() . '/inc/template-walker.php';

//SEO
require_once get_template_directory() . '/inc/template-seo.php';

