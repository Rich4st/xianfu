<?php
defined('ABSPATH') || exit;

if (!class_exists('CSF')) {
  return;
}

$prefix = _OPTIONS_PREFIX . '-post';

/**
 * 文章高级设置
 */
CSF::createMetabox($prefix, array(
  'title'     => '文章高级配置(capalot)',
  'nav'       => 'inline',
  'post_type' => array('post'),
  'data_type' => 'unserialize',
  'context'   => 'normal', //`normal`, `side`, `advanced`
));

// 自定义SEO
CSF::createSection($prefix, array(
  'title'  => '自定义SEO信息',
  'fields' => array(
    array(
      'id'       => 'post_title',
      'type'     => 'text',
      'title'    => '自定义SEO标题',
      'subtitle' => '留空则不设置',
    ),

    array(
      'id'       => 'post_description',
      'type'     => 'textarea',
      'title'    => '自定义SEO描述',
      'subtitle' => '字数控制到80-180最佳,留空则不设置',
    ),

    array(
      'id'       => 'post_keywords',
      'type'     => 'text',
      'title'    => '自定义SEO关键词',
      'subtitle' => '关键词用英文逗号,隔开,留空则不设置',
    ),

  ),
));
