<?php

defined('ABSPATH') || exit;

// CSF框架未加载，退出程序
if (!class_exists('CSF')) {
  return;
}

$prefix = _OPTIONS_PREFIX;
$template_dir = get_template_directory_uri();

/** 主题设置 */
CSF::createOptions($prefix, array(
  'menu_title' => '主题设置',
  'menu_slug' => 'capalot',
));

/**
 * 基本设置
 */
CSF::createSection($prefix, array(
  'title'  => '基本设置',
  'icon' => 'dashicons dashicons-admin-generic',
  'fields' => array(

    array(
      'id'      => 'site_logo',
      'type'    => 'upload',
      'title'   => '网站LOGO',
      'default' => _capalot('site_logo', get_template_directory_uri() . '/assets/img/logo.png'),
    ),

    array(
      'id'      => 'site_favicon',
      'type'    => 'upload',
      'title'   => '网站favicon图标',
      'default' => _capalot('site_favicon', get_template_directory_uri() . '/assets/img/favicon.png'),
    ),

  ),
));

/**
 * 网站优化
 */
CSF::createSection($prefix, array(
  'title'  => '网站优化',
  'icon' => 'dashicons dashicons-update',
  'fields' => array(
    array(
      'id'      => 'gutenberg_edit',
      'type'    => 'switcher',
      'title'   => '使用古滕堡编辑器',
      'desc'    => '',
      'default' => false,
    ),

    array(
      'id'      => 'gutenberg_widgets',
      'type'    => 'switcher',
      'title'   => '使用古滕堡小工具',
      'desc'    => '',
      'default' => false,
    ),


    array(
      'id'      => 'site_update_file_md5_rename',
      'type'    => 'switcher',
      'title'   => '上传文件MD5加密重命名',
      'desc'    => '建议开启，可以有效解决中文字符无法上传图片问题，防止付费图片被抓包等',
      'default' => false,
    ),

    array(
      'id'      => 'remove_wptexturize',
      'type'    => 'switcher',
      'title'   => '禁用wordpress文章内容输出转码转义功能',
      'desc'    => '禁用后在编辑器中输入代码乱码将原格式输出，不进行转义，适合有写代码内容的开启。',
      'default' => false,
    ),

    array(
      'id'      => 'show_admin_bar',
      'type'    => 'switcher',
      'title'   => '移除前端顶部管理栏',
      'desc'    => '',
      'default' => true,
    ),

    array(
      'id'      => 'remove_admin_bar_menu',
      'type'    => 'switcher',
      'title'   => '移除WP后台顶部LOGO菜单链接',
      'desc'    => '',
      'default' => true,
    ),

    array(
      'id'      => 'remove_admin_foote_wp',
      'type'    => 'switcher',
      'title'   => '移除wp后台底部版本信息',
      'desc'    => '',
      'default' => true,
    ),

    array(
      'id'      => 'remove_admin_menu',
      'type'    => 'switcher',
      'title'   => '移除WP后台仪表盘菜单',
      'desc'    => '',
      'default' => true,
    ),

    array(
      'id'      => 'remove_emoji',
      'type'    => 'switcher',
      'title'   => '移除WP自带emoji表情插件',
      'desc'    => '可以大幅度精简JS和CSS',
      'default' => true,
    ),

    array(
      'id'      => 'remove_wp_head_more',
      'type'    => 'switcher',
      'title'   => '精简优化网站前台head标签代码',
      'desc'    => '',
      'default' => true,
    ),

    array(
      'id'      => 'remove_wp_img_attributes',
      'type'    => 'switcher',
      'title'   => '精简优化网站图片代码',
      'desc'    => '移除wp自带编辑器插入图片时一堆不必要的html属性和元素',
      'default' => false,
    ),

    array(
      'id'      => 'remove_wp_rest_api',
      'type'    => 'switcher',
      'title'   => '关闭网站REST API接口',
      'desc'    => '如果你有使用小程序等功能，请不要优化此项',
      'default' => false,
    ),
    array(
      'id'      => 'remove_wp_xmlrpc',
      'type'    => 'switcher',
      'title'   => '关闭XML-RPC (pingback) 功能',
      'desc'    => 'XML-RPC 是 WordPress 用于第三方客户端，关闭后可以防止爆破攻击',
      'default' => false,
    ),

  ),
));
