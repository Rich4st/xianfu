<?php
defined('ABSPATH') || exit;

if (!class_exists('CSF')) {
  return;
}

$prefix = _OPTIONS_PREFIX . '-page';

/**
 * 文章高级设置
 */
CSF::createMetabox($prefix, array(
  'title'     => '作品设置',
  'nav'       => 'inline',
  'post_type' => array('page'),
  'data_type' => 'unserialize',
  'context'   => 'normal', //`normal`, `side`, `advanced`
));

// 自定义SEO
CSF::createSection($prefix, array(
  'title'  => '添加作品信息',
  'fields' => array(

    [
      'id'       => 'portfolio',
      'type'     => 'group',
      'title'    => '作品信息',
      'fields'   => array(
        [
          'id'    => '_title',
          'type'  => 'text',
          'title' => '作品标题',
        ],
        [
          'id'    => '_desc',
          'type'  => 'textarea',
          'title' => '作品描述',
        ],
        [
          'id'    => '_img',
          'type'  => 'upload',
          'title' => '作品图片',
        ],
        [
          'id'    => '_url',
          'type'  => 'text',
          'title' => '作品链接',
        ],
      ),
    ],

  ),
));
